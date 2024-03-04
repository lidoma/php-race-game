<?php

declare(strict_types=1);

namespace Game\Support;

class Config
{
    private const CONFIG_FILE_PATH = __DIR__.'/../../config.php';

    private static ?self $instance = null;

    private function __construct(protected Collection $configs)
    {
    }

    public static function getInstance(): self
    {
        if (! is_null(self::$instance)) {
            return self::$instance;
        }

        self::$instance = new static(self::load());

        return self::$instance;
    }

    private static function load(): Collection
    {
        return new Collection(require self::CONFIG_FILE_PATH);
    }

    public static function get($key, $default = null)
    {
        return self::getInstance()->configs->get($key, $default);
    }
}
