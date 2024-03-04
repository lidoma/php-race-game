<?php

declare(strict_types=1);

namespace Game;

use Game\Converters\Converter;
use Game\Converters\KilometrePerHour;
use Game\Converters\Knots;
use Game\Converters\Kts;
use Game\Exceptions\CouldNotPrepareCar;
use Game\Support\Collection;

class Unit
{
    private string $symbol;

    private const MAP = [
        'km/h' => KilometrePerHour::class,
        'knots' => Knots::class,
        'kts' => Kts::class,
    ];

    /**
     * @throws \Game\Exceptions\CouldNotPrepareCar
     */
    public function __construct(string $symbol)
    {
        $this->symbol = strtolower($symbol);

        if (! array_key_exists($this->symbol, self::MAP)) {
            throw CouldNotPrepareCar::notSupportedUnit($symbol);
        }
    }

    public function getConverter(): Converter
    {
        $converter = (new Collection(self::MAP))->get($this->symbol);

        return new $converter;
    }
}
