<?php

namespace Phox\Phigma\Models\Nodes;

use Phox\Phigma\Models\Collection;

class NodeCollection extends Collection
{
    public function __construct(
        private array $items = [],
    ) {
        parent::__construct(Node::class, $items);
    }

    public function removeNode(Node $nodeToRemove): NodeCollection
    {
        $nodeId = $nodeToRemove->getId();
        if (! $nodeId) {
            return $this;
        }

        foreach ($this->items as $index => $node) {
            if ($node->getId() === $nodeId) {
                unset($this->items[$index]);
                return $this;
            }
        }

        return $this;
    }

    /**
     * @param array $data
     * @return NodeCollection
     */
    public static function create(array $data): NodeCollection
    {
        $nodeCollection = new NodeCollection();
        foreach ($data as $nodeData) {
            $nodeCollection->addItem(Node::create($nodeData));
        }

        return $nodeCollection;
    }
}