<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\DTO;

use App\Application\DTO\BetPlaceDTO;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class BetPlaceDtoTest extends TestCase
{
    private ValidatorInterface $validator;

    protected function setUp(): void
    {
        $this->validator = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
    }

    public function testValidDTO(): void
    {
        $dto = new BetPlaceDTO(
            '12345',
            'client123',
            'transaction123',
            100,
            'SINGLE',
            'INSTANT',
            'YES',
            'YES',
            1.5,
            2.0,
            'UNSETTLED',
            null,
            null,
            null,
            null,
            1620356831,
            1620355831
        );

        $violations = $this->validator->validate($dto);

        $this->assertCount(0, $violations);
    }

    public function testInvalidDTO(): void
    {
        $dto = new BetPlaceDTO(
            '1234a',
            '',
            'transaction123',
            -100,
            'SINGL',
            'INSTANTT',
            'YESS',
            'NOPE',
            -1.5,
            -2.0,
            'INVALID',
            'prematchFinCategoryName',
            'prematchGameStyleCategoryName',
            'liveFinCategoryName',
            'liveGameStyleCategoryName',
            -1620356831,
            -1620355831
        );

        $violations = $this->validator->validate($dto);

        $this->assertCount(11, $violations);
    }
}
