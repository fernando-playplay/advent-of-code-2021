<?php

declare(strict_types=1);

namespace Tests\day_2;

use PHPUnit\Framework\TestCase;

/**
 * @deprecated
 */
class NavigationSystemTest extends TestCase
{
    private NavigationSystem $navigationSystem;

    protected function setUp(): void
    {
        parent::setUp();

        $this->navigationSystem = new NavigationSystem();
    }

    public function testItCanNavigate1PositionForward(): void
    {
        $this->assertSame(1, $this->navigationSystem->moveForward(1));
    }

    public function testItCanNavigate2PositionsForward(): void
    {
        $this->navigationSystem->moveForward(1);
        $finalPosition = $this->navigationSystem->moveForward(1);

        $this->assertSame(2, $finalPosition);
    }

    public function testItCanNavigate1PositionDown(): void
    {
        $this->assertSame(1, $this->navigationSystem->moveDown(1));
    }

    public function testItCanNavigate2PositionsDown(): void
    {
        $this->navigationSystem->moveDown(1);
        $finalPosition = $this->navigationSystem->moveDown(1);

        $this->assertSame(2, $finalPosition);
    }

    public function testItCanNavigate1PositionUp(): void
    {
        $this->assertSame(-1, $this->navigationSystem->moveUp(1));
    }

    public function testItCanNavigate2PositionsUp(): void
    {
        $this->navigationSystem->moveUp(1);
        $finalPosition = $this->navigationSystem->moveUp(1);

        $this->assertSame(-2, $finalPosition);
    }

    public function testItCanNavigate1PositionUpAnd1PositionDown(): void
    {
        $this->navigationSystem->moveUp(1);
        $finalPosition = $this->navigationSystem->moveDown(1);

        $this->assertSame(0, $finalPosition);
    }

    public function testItCanNavigate2PositionsUpAnd1PositionDown(): void
    {
        $this->navigationSystem->moveUp(2);
        $finalPosition = $this->navigationSystem->moveDown(1);

        $this->assertSame(-1, $finalPosition);
    }

    public function testItCanNavigate3PositionsDownAnd1PositionUp(): void
    {
        $this->navigationSystem->moveDown(3);
        $finalPosition = $this->navigationSystem->moveUp(1);

        $this->assertSame(2, $finalPosition);
    }

    public function testItCanNavigate2PositionsDown1PositionUpAnd1PositionForward(): void
    {
        $this->navigationSystem->moveDown(2);
        $finalDepth = $this->navigationSystem->moveUp(1);
        $positionForward = $this->navigationSystem->moveForward(1);

        $this->assertSame([1, 1], [$positionForward, $finalDepth]);
    }

    public function testItCanNavigate4PositionsDown2PositionsUpAnd3PositionsForward(): void
    {
        $this->navigationSystem->moveDown(4);
        $finalDepth = $this->navigationSystem->moveUp(2);
        $positionForward = $this->navigationSystem->moveForward(3);

        $this->assertSame([3, 2], [$positionForward, $finalDepth]);
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

        $this->assertSame(150, $this->navigationSystem->autopilot($steps));
    }

    public function testItCanNavigateASeriesOfPositionsFromAFile(): void
    {
        $this->assertSame(1938402, $this->navigationSystem->autopilotFromFile('2.txt'));
    }
}
