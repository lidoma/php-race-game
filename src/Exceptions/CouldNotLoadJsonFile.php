<?php

declare(strict_types=1);

namespace Game\Exceptions;

use Exception;

class CouldNotLoadJsonFile extends Exception
{
    public static function unreadableFile(string $path): self
    {
        return new static(sprintf('The %s file is unreadable.', $path));
    }

    public static function unableToDecoded(): self
    {
        return new static('The JSON cannot be decoded');
    }
}
