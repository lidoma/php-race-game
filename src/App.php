<?php

declare(strict_types=1);

namespace Game;

use Game\Support\Collection;
use Game\Support\Config;
use Game\Support\Json;

class App
{
    /**
     * @throws \Game\Exceptions\CouldNotLoadJsonFile
     */
    public static function prepareCars(): Collection
    {
        return Json::read(Config::get('cars_dataset_path', ''))
            ->asCollection()
            ->map(fn(array $attributes) => Car::fromArray($attributes));
    }

    /**
     * @throws \Game\Exceptions\CouldNotStartRace
     */
    public static function warmUpRacers(Collection $cars): Racers
    {
        return Racers::make(Config::get('number_of_participants', 2))->promptToChooseACar($cars);
    }

    public static function startEngines(Racers $racers): Race
    {
        $race = new Race($racers);

        return $race->start();
    }
}
