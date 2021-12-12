<?php

declare(strict_types=1);

namespace Tests\day_3;

use App\day_3\LifeSupportRatingAnalyser;
use PHPUnit\Framework\TestCase;

class LifeSupportRatingAnalyserTest extends TestCase
{
    private LifeSupportRatingAnalyser $lifeSupportRatingAnalyser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->lifeSupportRatingAnalyser = new LifeSupportRatingAnalyser();
    }

    public function testItDeterminesThePowerConsumptionFromABasicArrayInput(): void
    {
        $diagnostic = [
            '11',
            '01',
            '00',
        ];

        $this->assertSame(3, $this->lifeSupportRatingAnalyser->calculateLifeSupportRating($diagnostic));
    }

    public function testItDeterminesThePowerConsumptionFromAMoreComplexArrayInput(): void
    {
        $diagnostic = [
            '00100',
            '11110',
            '10110',
            '10111',
            '10101',
            '01111',
            '00111',
            '11100',
            '10000',
            '11001',
            '00010',
            '01010',
        ];

        $this->assertSame(
            230,
            $this->lifeSupportRatingAnalyser->calculateLifeSupportRating($diagnostic)
        );
    }

    public function testItDeterminesThePowerConsumptionFromAFileInput(): void
    {
        $this->assertSame(
            4105235,
            $this->lifeSupportRatingAnalyser->calculateLifeSupportRatingFromFile('3.txt')
        );
    }
}
