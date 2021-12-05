<?php

declare(strict_types=1);

namespace Tests\day_1;

use App\day_1\SimpleSonar;
use PHPUnit\Framework\TestCase;

class SimpleSonarTest extends TestCase
{
    private SimpleSonar $sonarSweep;

    protected function setUp(): void
    {
        parent::setUp();

        $this->sonarSweep = new SimpleSonar();
    }

    public function testItReturns0WhenTheValueNeverIncreasesFromArray(): void
    {
        $this->assertSame(0, $this->sonarSweep->scanIncrementsFromArray([1, 1]));
    }

    public function testItReturns1WhenTheValueIncreasesOnlyOnce(): void
    {
        $this->assertSame(1, $this->sonarSweep->scanIncrementsFromArray([1, 2]));
    }

    public function testItReturns2WhenTheValueIncreasesTwice(): void
    {
        $this->assertSame(2, $this->sonarSweep->scanIncrementsFromArray([1, 2, 3]));
    }

    public function testItReturns2WhenTheValueIncreasesTwiceInRandomOrder(): void
    {
        $this->assertSame(2, $this->sonarSweep->scanIncrementsFromArray([1, 3, 2, 3]));
    }

    public function testItThrowsAnExceptionWhenTheGivenFileIsInvalid(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->sonarSweep->scanIncrementsFromFile('hello.txt');
    }

    public function testItCountsTheIncrementsFromReadingTheGivenFile(): void
    {
        $this->assertSame(1692, $this->sonarSweep->scanIncrementsFromFile('1.txt'));
    }
}
