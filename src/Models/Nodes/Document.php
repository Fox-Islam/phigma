<?php

namespace Phox\Phigma\Models\Nodes;

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

    public function getChildren(): ?NodeCollection
    {
        if (! $this->children) {
            return null;
        }

        return NodeCollection::create($this->children);
    }

    /**
     * @param array $data
     * @return Document
     */
    public static function create(array $data): Node
    {
        $node = parent::create($data);

        if (isset($data['children']) && method_exists($node, 'children')) {
            $node->children($data['children']);
        }

        return $node;
    }
}