<?php

namespace Phox\Phigma\Models\Nodes;

use Phox\Phigma\Models\Collection;

class Document extends Node
{
    public function __construct(
        ?string $id = null,
        ?string $name = null,
        ?bool $visible = null,
        ?int $rotation = null,
        ?array $pluginData = null,
        ?array $sharedPluginData = null,
        ?array $componentPropertyReferences = null,
        ?array $boundVariables = null,
        ?array $explicitVariableModes = null,
        private ?array $children = null,
    ) {
        parent::__construct(
            id: $id,
            name: $name,
            visible: $visible,
            type: 'DOCUMENT',
            rotation: $rotation,
            pluginData: $pluginData,
            sharedPluginData: $sharedPluginData,
            componentPropertyReferences: $componentPropertyReferences,
            boundVariables: $boundVariables,
            explicitVariableModes: $explicitVariableModes
        );
    }

    public function children(array $children): Document
    {
        $this->children = $children;
        return $this;
    }

    /**
     * @return Collection<Node>|null
     */
    public function getChildren(): ?Collection
    {
        if (! $this->children) {
            return null;
        }

        return Collection::create(Node::class, $this->children);
    }

    public static function create(array $data): Document
    {
        /**
         * @var Document $node
         */
        $node = parent::create($data);

        if (isset($data['children']) && method_exists($node, 'children')) {
            $node->children($data['children']);
        }

        return $node;
    }
}