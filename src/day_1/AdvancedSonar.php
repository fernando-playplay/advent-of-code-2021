<?php

declare(strict_types=1);

namespace App\day_1;

/**
 * Rules of the game:
 * - Read every line in the file
 * - Each line is an integer value
 * - Count the number of times a group of 3 values has increased
 *      relative to the precedent group of 3 values
 */
class AdvancedSonar
{
    public function scanIncrementsFromArray(array $values): int
    {
        $numberOfIncrements = 0;
        $valuesLength = count($values);

        $previousSum = INF;
        for ($idx = 0; $idx < $valuesLength; $idx++) {
            if (!isset($values[$idx + 2])) {
                break;
            }

            $currentSum = $values[$idx] + $values[$idx + 1] + $values[$idx + 2];

            if ($previousSum < $currentSum) {
                $numberOfIncrements++;
            }

            $previousSum = $currentSum;
        }

        return $numberOfIncrements;
    }

    public function scanIncrementsFromFile(string $filename): int
    {
        $filename = __DIR__ . "/../data/$filename";
        if (!file_exists($filename)) {
            throw new \InvalidArgumentException('The given file is invalid');
        }

        $values = file($filename, FILE_IGNORE_NEW_LINES);

        return $this->scanIncrementsFromArray($values);
    }
}
