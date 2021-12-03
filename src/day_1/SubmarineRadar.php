<?php

declare(strict_types=1);

namespace App\day_1;

class SubmarineRadar
{
    private const MESSAGE = 'Captain! We have detected this many increments: ';
    private SimpleSonar $simpleSonar;
    private AdvancedSonar $advancedSonar;

    public function __construct()
    {
        $this->simpleSonar = new SimpleSonar();
        $this->advancedSonar = new AdvancedSonar();
    }

    public function scanSurfaceWithSimpleSonar(): string
    {
        return self::MESSAGE . $this->simpleSonar->scanIncrementsFromFile('1.txt');
    }

    public function scanSurfaceWithAdvancedSonar(): string
    {
        return self::MESSAGE . $this->advancedSonar->scanIncrementsFromFile('1.txt');
    }
}
