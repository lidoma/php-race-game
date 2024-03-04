<?php

declare(strict_types=1);

namespace Game\Exceptions;

use Exception;

class CouldNotPrepareCar extends Exception
{
    public static function notSupportedUnit(string $unit): self
    {
        return new static(sprintf('The %s speed unit is not supported.', $unit));
    }
}
