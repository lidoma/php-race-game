<?php

declare(strict_types=1);

namespace Game\Support;

use Game\Exceptions\CouldNotLoadJsonFile;
use JsonException;

class Json
{
    public function __construct(protected string $content)
    {
    }

    /**
     * @throws \Game\Exceptions\CouldNotLoadJsonFile
     */
    public static function read(string $path): self
    {
        $content = @file_get_contents($path);

        if ($content === false) {
            throw CouldNotLoadJsonFile::unreadableFile($path);
        }

        return new static($content);
    }

    /**
     * @throws \Game\Exceptions\CouldNotLoadJsonFile
     */
    public function asArray(): array
    {
        try {
            return json_decode(json: $this->content, flags: JSON_THROW_ON_ERROR | JSON_OBJECT_AS_ARRAY);
        } catch (JsonException $exception) {
            throw CouldNotLoadJsonFile::unableToDecoded();
        }
    }

    /**
     * @throws \Game\Exceptions\CouldNotLoadJsonFile
     */
    public function asCollection(): Collection
    {
        return new Collection($this->asArray());
    }
}
