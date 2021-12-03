<?php

namespace Tests\day_1;

use App\day_1\SonarSweep;
use PHPUnit\Framework\TestCase;

class SonarSweepTest extends TestCase
{
    private SonarSweep $sonarSweep;

    protected function setUp(): void
    {
        parent::setUp();

        $this->sonarSweep = new SonarSweep();
    }

    public function testItReturns0WhenTheValueNeverIncreasesFromArray(): void
    {
        $this->assertSame(0, $this->sonarSweep->getIncrementsFromArray([1, 1]));
    }

    public function testItReturns1WhenTheValueIncreasesOnlyOnce(): void
    {
        $this->assertSame(1, $this->sonarSweep->getIncrementsFromArray([1, 2]));
    }

    public function testItReturns2WhenTheValueIncreasesTwice(): void
    {
        $this->assertSame(2, $this->sonarSweep->getIncrementsFromArray([1, 2, 3]));
    }

    public function testItReturns2WhenTheValueIncreasesTwiceInRandomOrder(): void
    {
        $this->assertSame(2, $this->sonarSweep->getIncrementsFromArray([1, 3, 2, 3]));
    }

    public function testItThrowsAnExceptionWhenTheGivenFileIsInvalid(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->sonarSweep->getIncrementsFromFile('hello.txt');
    }

    public function testItCountsTheIncrementsFromReadingTheGivenFile(): void
    {
        $this->assertSame(1692, $this->sonarSweep->getIncrementsFromFile('1.txt'));
    }
}
