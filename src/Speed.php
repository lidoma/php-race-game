<?php

declare(strict_types=1);

namespace Game;

use Game\Support\PositiveInteger;

class Speed
{
    public function __construct(public PositiveInteger $value, public Unit $unit)
    {
    }

    public function toBase(): PositiveInteger
    {
        return $this->unit->getConverter()->toBase($this->value);
    }
}
