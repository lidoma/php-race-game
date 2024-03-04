<?php

declare(strict_types=1);

namespace Game\Converters;

use Game\Support\PositiveInteger;

interface Converter
{
    public function toBase(PositiveInteger $value): PositiveInteger;
}
