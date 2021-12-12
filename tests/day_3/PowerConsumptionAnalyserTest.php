<?php

declare(strict_types=1);

namespace Tests\day_3;

use App\day_3\PowerConsumptionAnalyser;
use PHPUnit\Framework\TestCase;

class PowerConsumptionAnalyserTest extends TestCase
{
    private PowerConsumptionAnalyser $powerConsumptionAnalyser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->powerConsumptionAnalyser = new PowerConsumptionAnalyser();
    }

    public function testItDeterminesThePowerConsumptionFromABasicArrayInput(): void
    {
        $diagnostic = [
            '11',
            '01',
            '00',
        ];

        $this->assertSame(2, $this->powerConsumptionAnalyser->calculatePowerConsumption($diagnostic));
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
            0b11000110,
            $this->powerConsumptionAnalyser->calculatePowerConsumption($diagnostic)
        );
    }

    public function testItDeterminesThePowerConsumptionFromAFileInput(): void
    {
        $this->assertSame(
            0b1110101011001110111100,
            $this->powerConsumptionAnalyser->calculatePowerConsumptionFromFile('3.txt')
        );
    }
}
