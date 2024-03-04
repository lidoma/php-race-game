<?php

declare(strict_types=1);

namespace Game;

use Game\Exceptions\CouldNotStartRace;
use Game\Support\Collection;
use Game\Support\PositiveInteger;
use function cli\line;
use function cli\menu;

/**
 * @mixin \Game\Support\Collection
 */
class Racers
{
    public function __construct(protected Collection $racers)
    {
    }

    /**
     * @throws \Game\Exceptions\CouldNotStartRace
     */
    public static function make(int $numberOfParticipants = 2): self
    {
        if ($numberOfParticipants < 2) {
            throw CouldNotStartRace::tooFewParticipants();
        }

        return new static(self::times($numberOfParticipants));
    }

    public static function times(int $number): Collection
    {
        return (new Collection(range(1, $number)))
            ->map(function ($time) {
                return new Racer(name: sprintf('Player %d', $time));
            });
    }

    public function promptToChooseACar(Collection $cars): self
    {
        $this->racers->map(function (Racer $racer) use ($cars) {
            $choice = menu(
                items: $cars->map(fn(Car $car) => $car->name)->toArray(),
                title: sprintf('%s, choose your car', $racer->name)
            );
            line();

            $racer->car = $cars->get(key: $choice);

            return $racer;
        });

        return $this;
    }

    public function race(PositiveInteger $distance): self
    {
        $result = $this->racers
            ->each(function (Racer $racer) use ($distance) {
                $racer->calculateRecordTime($distance);
            });

        return new static($result);
    }

    /**
     * Dynamically proxy method calls into the racers' collection.
     *
     * @param  string  $method
     * @param  array  $parameters
     *
     * @return mixed
     */
    public function __call(string $method, array $parameters)
    {
        return $this->racers->{$method}(...$parameters);
    }
}
