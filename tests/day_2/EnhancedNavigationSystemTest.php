<?php

declare(strict_types=1);

namespace Tests\day_2;

use PHPUnit\Framework\TestCase;

class EnhancedNavigationSystemTest extends TestCase
{
    private EnhancedNavigationSystem $navigationSystem;

    public function setUp(): void
    {
        parent::setUp();

        $this->navigationSystem = new EnhancedNavigationSystem();
    }

    public function testFirstNavigationForwardDoesntChangeTheAim(): void
    {
        $this->navigationSystem->moveForward(1);

        $this->assertSame(0, $this->navigationSystem->getDepth());
    }

    public function testNavigatingForwardDownAndForwardIncreasesTheDepth(): void
    {
        $this->navigationSystem->moveForward(5);
        $this->navigationSystem->moveDown(5);
        $finalHorizontalPosition = $this->navigationSystem->moveForward(8);

        $this->assertSame(13, $finalHorizontalPosition);
        $this->assertSame(40, $this->navigationSystem->getDepth());
    }

    public function testNavigatingForwardUpAndForwardDecreasesTheDepth(): void
    {
        $this->navigationSystem->moveForward(5);
        $this->navigationSystem->moveUp(5);
        $finalHorizontalPosition = $this->navigationSystem->moveForward(8);

        $this->assertSame(13, $finalHorizontalPosition);
        $this->assertSame(-40, $this->navigationSystem->getDepth());
    }

    public function testItCanNavigateASeriesOfPositionsFromAnArray(): void
    {
        $steps = [
            'forward 5',
            'down 5',
            'forward 8',
            'up 3',
            'down 8',
            'forward 2',
        ];

        $this->assertSame(900, $this->navigationSystem->autopilot($steps));
    }

    public function testItCanNavigateASeriesOfPositionsFromAFile(): void
    {
        $this->assertSame(1947878632, $this->navigationSystem->autopilotFromFile('2.txt'));
    }
}
