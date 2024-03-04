<?php

declare(strict_types=1);

namespace Game\Exceptions;

use Exception;

class CouldNotStartRace extends Exception
{
    public static function tooFewParticipants(): self
    {
        return new static('The number of participants should be greater than one');
    }
}
