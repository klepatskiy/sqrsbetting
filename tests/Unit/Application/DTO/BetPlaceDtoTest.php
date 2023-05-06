<?php

declare(strict_types=1);

namespace App\Tests\Application\DTO;

use App\Application\DTO\BetPlaceDTO;
use App\Application\DTO\BetPlaceMoneyDTO;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validation;

class BetPlaceDtoTest extends TestCase
{
    public function testValidBetPlaceDTO(): void
    {
        $betPlaceDTO = new BetPlaceDTO(
            '512346',
            '8237451',
            '1834',
            500.0,
            'SINGLE',
            'INSTANT',
            'UP',
            'NO',
            1.35,
            1.35,
            'WIN',
            null,
            null,
            null,
            null,
            1636388354090,
            1636388350139,
            1636388350155,
            new BetPlaceMoneyDTO(
                'EUR',
                500.0,
                675.0,
                675.0,
                675.0
            ),
            'CASH_OUT',
            'ENG',
            'LIVE',
            2,
            null,
            null
        );

        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();

        $violations = $validator->validate($betPlaceDTO);

        $this->assertCount(0, $violations);
    }

    public function testInvalidBetPlaceDTO(): void
    {
        $betPlaceDTO = new BetPlaceDTO(
            '512346',
            '8237451',
            '1834',
            -500.0,
            'MULTIPLE', // invalid bet type
            'INSTANT',
            'UP',
            'NO',
            1.35,
            1.35,
            'WIN',
            null,
            null,
            null,
            null,
            1636388354090,
            1636388350139,
            1636388350155,
            new BetPlaceMoneyDTO(
                'EUR',
                500.0,
                675.0,
                675.0,
                675.0
            ),
            'CASH_OUT',
            'ENG',
            'LIVE',
            2,
            null,
            null
        );

        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();

        $violations = $validator->validate($betPlaceDTO);

        $this->assertCount(2, $violations);

        $this->assertContainsOnlyInstancesOf(ConstraintViolationInterface::class, $violations);

        $this->assertEquals('This value should be either positive or zero.', $violations[0]->getMessage());
        $this->assertEquals('Invalid bet type', $violations[1]->getMessage());
    }
}
