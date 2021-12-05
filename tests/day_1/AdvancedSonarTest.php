<?php

declare(strict_types=1);

namespace Tests\day_1;

use App\day_1\AdvancedSonar;
use PHPUnit\Framework\TestCase;

class AdvancedSonarTest extends TestCase
{
    private AdvancedSonar $advancedSonarSweep;

    protected function setUp(): void
    {
        parent::setUp();

        $this->advancedSonarSweep = new AdvancedSonar();
    }

    public function testItReturns0WhenTheValuesNeverIncrementsOnArray(): void
    {
        $this->assertSame(0, $this->advancedSonarSweep->scanIncrementsFromArray([0, 0, 0, 0]));
    }

    public function testItReturns5WhenTheValuesIncrement5TimesOnArray(): void
    {
        $this->assertSame(5, $this->advancedSonarSweep->scanIncrementsFromArray([
            607, 618, 618, 617, 647, 716, 769, 792
        ]));
    }

    public function testItThrowsAnExceptionWhenTheGivenFileIsInvalid(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->advancedSonarSweep->scanIncrementsFromFile('hello.txt');
    }

    public function testItCountsTheIncrementsFromReadingTheGivenFile(): void
    {
        $this->assertSame(1724, $this->advancedSonarSweep->scanIncrementsFromFile('1.txt'));
    }
}
