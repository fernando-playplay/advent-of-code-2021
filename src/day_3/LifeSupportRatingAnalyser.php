<?php

declare(strict_types=1);

namespace App\day_3;

/**
 * Rules of the game:
 * To complete our diagnostics, we need to calculate the life support rating (LSR) of the submarine!
 * - We need 2 new numbers: the oxygen generator rating and the CO2 scrubber rating, multiplying both we get the LSR
 * - Keep only numbers selected by the bit criteria for the type of rating value for which you are searching.
 *     Discard numbers which do not match the bit criteria.
 * - If you only have one number left, stop; this is the rating value for which you are searching.
 * - Otherwise, repeat the process, considering the next bit to the right.
 *
 * - To find the OGR: determine the most common value (0 or 1) in the current bit position,
 *      and keep only numbers with that bit in that position.
 *      If 0 and 1 are equally common, keep values with a 1 in the position being considered.
 * - To find CO2SR: determine the least common value (0 or 1) in the current bit position,
 *      and keep only numbers with that bit in that position.
 *      If 0 and 1 are equally common, keep values with a 0 in the position being considered.
 */
class LifeSupportRatingAnalyser
{
    private const OXYGEN_BIT_CRITERIA = 1;
    private const CO2_BIT_CRITERIA = 0;

    public function calculateLifeSupportRating(array $input): int
    {
        $ogr = $this->generateRating($input);
        $co2sr = $this->generateRating($input, self::CO2_BIT_CRITERIA);

        return $ogr * $co2sr;
    }

    public function calculateLifeSupportRatingFromFile(string $filename): int
    {
        $filename = __DIR__ . "/../data/$filename";
        $input = file($filename, FILE_IGNORE_NEW_LINES);

        return $this->calculateLifeSupportRating($input);
    }

    private function generateRating(
        array $input,
        int $bitCriteria = self::OXYGEN_BIT_CRITERIA
    ): int {
        $continue = true;
        $currentOffset = 0;
        $sumBits = [];
        $numberOfBits = strlen($input[0]);

        while ($continue) {
            $sumBits['0'] = 0;
            $sumBits['1'] = 0;
            $output = [];

            foreach ($input as $number) {
                $bit = substr($number, $currentOffset, 1);
                $sumBits[$bit]++;
            }

            $bitToKeep = $this->determineBitToKeep($bitCriteria, $sumBits);
            foreach ($input as $number) {
                $bit = substr($number, $currentOffset, 1);
                if ($bit === $bitToKeep) {
                    $output[] = $number;
                }
            }

            $input = $output;
            $currentOffset++;
            if ($currentOffset === $numberOfBits || count($output) === 1) {
                $continue = false;
            }
        }

        return bindec($input[0]);
    }

    private function determineBitToKeep(int $bitCriteria, array $sum): string
    {
        if ($bitCriteria === self::OXYGEN_BIT_CRITERIA) {
            if ($sum['0'] <= $sum['1']) {
                return '1';
            }
        } elseif ($sum['0'] > $sum['1']) {
            return '1';
        }

        return '0';
    }
}










