<?php

declare(strict_types=1);

namespace App\Infrastructure\Service;

use App\Application\Exception\ApiException;
use ArrayObject;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ExceptionFormatter
{
    private const PROD_ENV = 'prod';

    public function __construct(
        private readonly ParameterBagInterface $bag
    ) {
    }

    public function format(ExceptionEvent $event): JsonResponse
    {
        $e = $event->getThrowable();
        $response = new ArrayObject();
        $response->setFlags(ArrayObject::ARRAY_AS_PROPS);

        $errorObject = match ($e::class) {
            BadRequestHttpException::class => $this->getErrorObject(
                Response::HTTP_BAD_REQUEST,
                'BAD_REQUEST',
                $e->getMessage()
            ),

            NotFoundHttpException::class => $this->getErrorObject(
                Response::HTTP_NOT_FOUND,
                'NOT_FOUND',
                $e->getMessage()
            ),

            MethodNotAllowedHttpException::class => $this->getErrorObject(
                Response::HTTP_METHOD_NOT_ALLOWED,
                'NOT_ALLOWED',
                $e->getMessage()
            ),

            ApiException::class => $this->getErrorObject(
                $e->getStatusCode(),
                "INTERNAL_API_EXCEPTION",
                $e->getContent(),
                json_decode($e->getContent(), true, 512, JSON_THROW_ON_ERROR)
            ),

            default => $this->getErrorObject(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                'INTERNAL_SERVER_ERROR',
                $e->getMessage()
            )
        };

        if ($this->bag->get('kernel.environment') !== self::PROD_ENV) {
            $response->debug = $e->getTraceAsString();
        }

        return new JsonResponse($errorObject->getArrayCopy(), $errorObject->statusCode);
    }

    private function getErrorObject(
        int $statusCode,
        string $errorCode,
        string $message,
        ?array $append = null
    ): ArrayObject {
        $errorObject = new ArrayObject();
        $errorObject->setFlags(ArrayObject::ARRAY_AS_PROPS);

        $errorObject->statusCode = $statusCode;
        $errorObject->errorCode = $errorCode;
        $errorObject->errorMessage = $message;

        if ($append !== null || $append !== []) {
            $errorObject->append($append);
        }

        return $errorObject;
    }
}
