<?php

namespace Phox\Phigma\Models;

/**
 * @template T
 */
class Collection
{
    /**
     * @param class-string<T> $class
     */
    public function __construct(
        private readonly string $class,
        private array $items = [],
    ) {}

    /**
     * @return array<T>|null
     */
    public function getItems(): ?array
    {
        return $this->items;
    }

    /**
     * @return T|null
     */
    public function getItem(int $index)
    {
        return $this->items[$index];
    }

    /**
     * @return Collection<T>
     */
    public function items(array $items): Collection
    {
        foreach ($items as $item) {
            $this->addItem($item);
        }

        return $this;
    }

    /**
     * @return Collection<T>
     */
    public function addItem(mixed $item): Collection
    {
        if (! $item instanceof $this->class) {
            return $this;
        }

        $this->items[] = $item;
        return $this;
    }

    /**
     * @return Collection<T>
     */
    public function removeItem(mixed $itemToRemove, string $identifierMethodName): Collection
    {
        $itemIdentifier = $itemToRemove->$identifierMethodName();
        if (! $itemIdentifier) {
            return $this;
        }

        foreach ($this->items as $index => $item) {
            if ($item->$identifierMethodName() === $itemIdentifier) {
                unset($this->items[$index]);
                return $this;
            }
        }

        return $this;
    }

    public function toArray(): array
    {
        if (! $this->getItems()) {
            return [];
        }

        $items = [];
        foreach ($this->getItems() as $item) {
            $items[] = $item->toArray();
        }

        return $items;
    }

    /**
     * @return Collection<T>
     */
    public function createItemsFromArray(array $data): Collection
    {
        $collection = new Collection($this->class);
        foreach ($data as $itemData) {
            $collection->addItem($this->class::create($itemData));
        }

        return $collection;
    }
}