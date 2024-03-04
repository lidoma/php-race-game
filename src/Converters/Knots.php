<?php

declare(strict_types=1);

namespace Game\Converters;

use Game\Support\PositiveInteger;

class Knots implements Converter
{
    public function toBase(PositiveInteger $value): PositiveInteger
    {
        return new PositiveInteger($value->getValue() * 0.514444);
    }
}
