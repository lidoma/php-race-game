<?php

declare(strict_types=1);

namespace Game\Converters;

use Game\Support\PositiveInteger;

class KilometrePerHour implements Converter
{
    public function toBase(PositiveInteger $value): PositiveInteger
    {
        return new PositiveInteger($value->getValue() * 0.277777778);
    }
}
