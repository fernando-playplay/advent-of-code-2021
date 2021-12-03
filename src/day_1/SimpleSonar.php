<?php

declare(strict_types=1);

namespace App\day_1;

/**
 * Rules of the game:
 * - Read every line in the file
 * - Each line is an integer value
 * - Count the number of times a value has increased relative to the precedent value
 */
class SimpleSonar
{
    public function scanIncrementsFromArray(array $values): int
    {
        $numberOfIncrements = 0;
        $valuesLength = count($values);

        $previousValue = $values[0];
        for ($idx = 1; $idx < $valuesLength; $idx++) {
            if ($previousValue < $values[$idx]) {
                $numberOfIncrements++;
            }

            $previousValue = $values[$idx];
        }

        return $numberOfIncrements;
    }

    public function scanIncrementsFromFile(string $filename): int
    {
        $handle = @fopen(__DIR__ . "/../data/$filename", 'r');
        if (!$handle) {
            throw new \InvalidArgumentException('The given file is invalid');
        }

        $numberOfIncrements = 0;
        $previousValue = INF;

        while (($buffer = fgets($handle, 4096)) !== false) {
            $currentValue = (int) $buffer;
            if ($previousValue < $currentValue) {
                $numberOfIncrements++;
            }

            $previousValue = (int) $buffer;
        }

        fclose($handle);

        return $numberOfIncrements;
    }
}
