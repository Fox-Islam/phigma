<?php

namespace Phox\Phigma\Models;

/**
 * @template T
 */
class Collection
{
    public const string ID_METHOD = 'getKey';
    /**
     * @var array<string|int, T>
     */
    private array $itemHashMap = [];

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

        $identifierMethodName = $this->class::ID_METHOD;
        $this->itemHashMap[$item->$identifierMethodName()] = $item;

        return $this;
    }

    /**
     * @return Collection<T>
     */
    public function removeItem(mixed $itemToRemove, string $identifierMethodName = null): Collection
    {
        if (! $identifierMethodName) {
            $identifierMethodName = $this->class::ID_METHOD;
        }

        $itemIdentifier = $itemToRemove->$identifierMethodName();
        if (! $itemIdentifier) {
            return $this;
        }

        foreach ($this->items as $index => $item) {
            if ($item->$identifierMethodName() === $itemIdentifier) {
                unset($this->items[$index], $this->itemHashMap[$itemIdentifier]);
                return $this;
            }
        }

        return $this;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function isEmpty(): bool
    {
        return empty($this->items);
    }

    public function getKey(): string
    {
        $itemKeys = [];
        foreach ($this->items as $item) {
            $identifierMethodName = $this->class::ID_METHOD;
            $itemKeys[] = $item->$identifierMethodName();
        }

        $itemKeys = implode('-', $itemKeys);
        return "{$this->class}-{$itemKeys}";
    }

    /**
     * @return T|null
     */
    public function find(string|int $identifier)
    {
        return $this->itemHashMap[$identifier] ?? null;
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
     * @param class-string<T> $class
     * @return Collection<T>
     */
    public static function create(string $class, array $data): Collection
    {
        $collection = new Collection($class);
        foreach ($data as $itemData) {
            $collection->addItem($class::create($itemData));
        }

        return $collection;
    }
}