<?php

declare(strict_types=1);

namespace App\day_2;

/**
 * Rules of the game:
 * - The submarine can take a series of commands with a direction and a number of positions to move.
 * - The submarine starts at a depth and horizontal position of 0
 * - Moving "forward" increases the horizontal position
 * - Moving "down" increases the depth position
 * - Moving "up" decreases the depth position
 * - When moving multiple steps at a time, the final position is the multiplication of both values.
 */
class NavigationSystem
{
    private const DIRECTION_FORWARD = 'forward';
    private const DIRECTION_DOWN = 'down';
    private const DIRECTION_UP = 'up';

    private int $horizontalPosition;
    private int $depth;

    public function __construct()
    {
        $this->horizontalPosition = 0;
        $this->depth = 0;
    }

    public function moveForward(int $positions): int
    {
        $this->horizontalPosition += $positions;

        return $this->horizontalPosition;
    }

    public function moveDown(int $positions): int
    {
        $this->depth += $positions;

        return $this->depth;
    }

    public function moveUp(int $positions): int
    {
        $this->depth -= $positions;

        return $this->depth;
    }

    public function autopilot(array $steps): int
    {
        $steps = array_map(static function (string $step) {
            $stepElements = explode(' ', $step);
            return [
                'direction' => $stepElements[0],
                'positions' => (int) $stepElements[1]
            ];
        }, $steps);

        foreach ($steps as $step) {
            switch ($step['direction']) {
                case self::DIRECTION_FORWARD:
                    $this->moveForward($step['positions']);
                    break;
                case self::DIRECTION_DOWN:
                    $this->moveDown($step['positions']);
                    break;
                case self::DIRECTION_UP:
                    $this->moveUp($step['positions']);
                    break;
            }
        }

        return $this->horizontalPosition * $this->depth;
    }

    public function autopilotFromFile(string $filename): int
    {
        $filename = __DIR__ . "/../data/$filename";
        $steps = file($filename, FILE_IGNORE_NEW_LINES);

        return $this->autopilot($steps);
    }
}
