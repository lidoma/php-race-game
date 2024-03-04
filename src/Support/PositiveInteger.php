<?php

declare(strict_types=1);

namespace Game\Support;

use InvalidArgumentException;

class PositiveInteger
{
    public function __construct(private float|int $value)
    {
        if ($value <= 0) {
            throw new InvalidArgumentException(
                sprintf('The given value (%s) is an invalid positive integer type.', $value)
            );
        }
    }

    public function getValue(): float|int
    {
        return $this->value;
    }
}
