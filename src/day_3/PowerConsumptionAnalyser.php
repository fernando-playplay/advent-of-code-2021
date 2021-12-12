<?php

declare(strict_types=1);

namespace App\day_3;

/**
 * Rules of the game:
 * The submarine is making odd noises, we have to check the power diagnostics, but they're written in binary!
 * - From the binary numbers, we have to generate 2 new binary numbers:
 * - gamma rate = each bit in the gamma rate is the most common bit in the corresponding position
 * - epsilon rate = is the least common bit in the corresponding position
 * - The power consumption is the result of multiplying the decimal values of the gamma and epsilon rates.
 */
class PowerConsumptionAnalyser
{
    public function calculatePowerConsumption(array $input): int
    {
        [$gammaRate, $epsilonRate] = $this->generateGamaAndEpsilonRates($input);

        return $gammaRate * $epsilonRate;
    }

    public function calculatePowerConsumptionFromFile(string $filename): int
    {
        [$gammaRate, $epsilonRate] = $this->generateGamaAndEpsilonRatesFromFile($filename);

        return $gammaRate * $epsilonRate;
    }

    private function generateGamaAndEpsilonRatesFromFile(string $filename): array
    {
        $filename = __DIR__ . "/../data/$filename";
        $input = file($filename, FILE_IGNORE_NEW_LINES);

        return $this->generateGamaAndEpsilonRates($input);
    }

    private function generateGamaAndEpsilonRates(array $input): array
    {
        $gammaRate = '';
        $epsilonRate = '';
        $numberOfBits = strlen($input[0]);
        $numberOfElements = count($input);

        $commonValues = [];
        for ($x = 0; $x < $numberOfBits; $x++) {
            $commonValues[$x] = 0;

            for ($y = 0; $y < $numberOfElements; $y++) {
                $commonValues[$x] += $input[$y][$x];
            }

            $gammaRate .= $commonValues[$x] > ($numberOfElements / 2) ? '1' : '0';
            $epsilonRate .= $commonValues[$x] < ($numberOfElements / 2) ? '1' : '0';
        }

        return [
            bindec($gammaRate),
            bindec($epsilonRate)
        ];
    }
}
