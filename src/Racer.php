<?php

declare(strict_types=1);

namespace Game;

use Game\Support\PositiveInteger;

class Racer
{
    public ?float $recordTime = null;

    public function __construct(
        public string $name,
        public ?Car $car = null,
    ) {
    }

    public function calculateRecordTime(PositiveInteger $distanceInMeters): float
    {
        return $this->recordTime = $this->car->calculateTravelTime($distanceInMeters);
    }
}
