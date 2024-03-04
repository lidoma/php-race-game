<?php

declare(strict_types=1);

namespace Game;

use Game\Support\PositiveInteger;

class Car
{
    protected Speed $speed;

    public function __construct(public string $name, PositiveInteger $maxSpeed, Unit $unit)
    {
        $this->speed = new Speed($maxSpeed, $unit);
    }

    /**
     * @throws \Game\Exceptions\CouldNotPrepareCar
     */
    public static function fromArray(array $attributes): self
    {
        return new static(
            name: $attributes['name'],
            maxSpeed: new PositiveInteger(value: $attributes['maxSpeed']),
            unit: new Unit(symbol: $attributes['unit'])
        );
    }

    public function calculateTravelTime(PositiveInteger $distanceInMeters): float
    {
        return round($distanceInMeters->getValue() / $this->speed->toBase()->getValue(), 2);
    }
}
