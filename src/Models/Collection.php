<?php

namespace Phox\Phigma\Models;

class Collection
{
    public function __construct(
        private string $class,
        private array $items = [],
    ) {}

    public function getItems(): ?array
    {
        return $this->items;
    }

    public function items(array $items): Collection
    {
        foreach ($items as $item) {
            $this->addItem($item);
        }

        return $this;
    }

    public function addItem(mixed $item): Collection
    {
        if (! $item instanceof $this->class) {
            return $this;
        }

        $this->items[] = $item;
        return $this;
    }

    public function removeItem(mixed $itemToRemove): Collection
    {
        return $this;
    }

    public function toArray(): array
    {
        $items = [];
        foreach ($this->items as $item) {
            $items[] = $item->toArray();
        }

        return $items;
    }

    public static function create(array $data): Collection|null
    {
        return null;
    }
}