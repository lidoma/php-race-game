<?php

declare(strict_types=1);

namespace Game;

use cli\Table;
use cli\table\Ascii;
use Game\Support\PositiveInteger;
use function cli\line;

class Race
{
    public function __construct(
        public Racers $racers,
        public ?PositiveInteger $distanceInMeters = null
    ) {
        if (is_null($this->distanceInMeters)) {
            $this->distanceInMeters = new PositiveInteger(300);
        }
    }

    public function start(): self
    {
        $this->racers = $this->racers->race($this->distanceInMeters);

        return $this;
    }

    public function getWinner(): Racer
    {
        return $this->racers->sortBy(fn(Racer $racer) => $racer->recordTime)->first();
    }

    public function output(): self
    {
        $headers = ['Player', 'Car', 'Time (s)'];
        $rows = $this->racers->map(function (Racer $racer) {
            return [
                $racer->name,
                $racer->car->name,
                $racer->recordTime,
            ];
        })->toArray();

        $table = new Table();
        $table->setHeaders($headers);
        $table->setRows($rows);
        $table->setRenderer(new Ascii([15, 18, 18]));
        $table->display();
        line();

        line(sprintf('%s is the winner', $this->getWinner()->name));
        line();

        return $this;
    }
}
