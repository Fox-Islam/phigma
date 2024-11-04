<?php

namespace Phox\Phigma\Models\Nodes;

use Phox\Phigma\Models\Collection;

/**
 * @extends Collection<Node>
 */
class NodeCollection extends Collection
{
    public function __construct(
        private array $items = [],
    ) {
        parent::__construct(Node::class, $items);
    }

    /**
     * @return Collection<Node>
     */
    public function removeNode(mixed $itemToRemove): Collection
    {
        return $this->removeItem($itemToRemove, 'getId');
    }

    /**
     * @return Collection<Node>
     */
    public static function create(array $data): Collection
    {
        $collection = new Collection(Node::class);
        $collection->createItemsFromArray($data);

        return $collection;
    }
}