<?php

declare(strict_types=1);

namespace Game\Support;

class Collection
{
    protected array $items = [];

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function map(callable $callback): self
    {
        $keys = array_keys($this->items);

        $items = array_map($callback, $this->items, $keys);

        return new static(array_combine($keys, $items));
    }

    public function each(callable $callback): self
    {
        foreach ($this->items as $key => $item) {
            if ($callback($item, $key) === false) {
                break;
            }
        }

        return $this;
    }

    public function get($key, $default = null)
    {
        if ($this->offsetExists($key)) {
            return $this->items[$key];
        }

        return $default;
    }

    public function offsetExists($key): bool
    {
        return array_key_exists($key, $this->items);
    }

    public function sortBy(callable $callback, $descending = false): self
    {
        $results = [];

        foreach ($this->items as $key => $value) {
            $results[$key] = $callback($value, $key);
        }

        $descending ? arsort($results) : asort($results);

        foreach (array_keys($results) as $key) {
            $results[$key] = $this->items[$key];
        }

        return new static($results);
    }

    public function first($default = null)
    {
        if (empty($this->items)) {
            return $default;
        }

        foreach ($this->items as $item) {
            return $item;
        }

        return $default;
    }

    public function toArray(): array
    {
        return $this->items;
    }
}
