<?php

declare(strict_types=1);

namespace App\day_2;

/**
 * Rules of the game:
 * - The submarine can take a series of commands with a direction and a number of positions to move.
 * - The submarine starts at a depth and horizontal position of 0, and another value "aim" at 0 as well.
 *
 * - Moving "up" decreases the aim
 * - Moving "down" increases the aim
 * - Moving "forward" increases the horizontal position and increases the depth by the aim multiplied by X
 * - When moving multiple steps at a time, the final position is the multiplication of both values.
 */
class EnhancedNavigationSystem extends NavigationSystem
{
    private int $aim;

    public function __construct()
    {
        parent::__construct();

        $this->aim = 0;
    }

    public function getDepth(): int
    {
        return $this->depth;
    }

    public function moveForward(int $positions): int
    {
        $this->horizontalPosition += $positions;
        $this->depth += $this->aim * $positions;

        return $this->horizontalPosition;
    }

    public function moveDown(int $positions): int
    {
        $this->aim += $positions;

        return $this->depth;
    }

    public function moveUp(int $positions): int
    {
        $this->aim -= $positions;

        return $this->depth;
    }
}
