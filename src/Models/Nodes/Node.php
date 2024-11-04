<?php

namespace Phox\Phigma\Models\Nodes;

class Node
{
    public function __construct(
        private ?string $id = null,
        private ?string $name = null,
        private ?bool $visible = null,
        private ?string $type = null,
        private ?int $rotation = null,
        private ?array $pluginData = null,
        private ?array $sharedPluginData = null,
        private ?array $componentPropertyReferences = null,
        private ?array $boundVariables = null,
        private ?array $explicitVariableModes = null,
    ) {}

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getVisible(): ?bool
    {
        return $this->visible;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getRotation(): ?int
    {
        return $this->rotation;
    }

    public function getPluginData(): ?array
    {
        return $this->pluginData;
    }

    public function getSharedPluginData(): ?array
    {
        return $this->sharedPluginData;
    }

    public function getComponentPropertyReferences(): ?array
    {
        return $this->componentPropertyReferences;
    }

    public function getBoundVariables(): ?array
    {
        return $this->boundVariables;
    }

    public function getExplicitVariableModes(): ?array
    {
        return $this->explicitVariableModes;
    }

    public function id(string $id): Node
    {
        $this->id = $id;
        return $this;
    }

    public function name(string $name): Node
    {
        $this->name = $name;
        return $this;
    }

    public function visible(bool $visible): Node
    {
        $this->visible = $visible;
        return $this;
    }

    public function type(string $type): Node
    {
        $this->type = $type;
        return $this;
    }

    public function rotation(int $rotation): Node
    {
        $this->rotation = $rotation;
        return $this;
    }

    public function pluginData(array $pluginData): Node
    {
        $this->pluginData = $pluginData;
        return $this;
    }

    public function sharedPluginData(array $sharedPluginData): Node
    {
        $this->sharedPluginData = $sharedPluginData;
        return $this;
    }

    public function componentPropertyReferences(array $componenPropertyReferences): Node
    {
        $this->componentPropertyReferences = $componenPropertyReferences;
        return $this;
    }

    public function boundVariables(array $boundVariables): Node
    {
        $this->boundVariables = $boundVariables;
        return $this;
    }

    public function explicitVariableModes(array $explicitVariableModes): Node
    {
        $this->explicitVariableModes = $explicitVariableModes;
        return $this;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public static function create(array $data): Node
    {
        $node = new Node();

        if (isset($data['type'])) {
            switch ($data['type']) {
                case 'DOCUMENT':
                    $node = new Document();
                    break;
                case 'CANVAS':
                case 'FRAME':
                case 'GROUP':
                case 'SECTION':
                case 'VECTOR':
                case 'BOOLEAN_OPERATION':
                case 'STAR':
                case 'LINE':
                case 'ELLIPSE':
                case 'REGULAR_POLYGON':
                case 'RECTANGLE':
                case 'TABLE':
                case 'TABLE_CELL':
                case 'TEXT':
                case 'SLICE':
                case 'COMPONENT':
                case 'COMPONENT_SET':
                case 'INSTANCE':
                case 'STICKY':
                case 'SHAPE_WITH_TEXT':
                case 'CONNECTOR':
                case 'WASHI_TAPE':
                default:
                    $node->type($data['type']);
            }
        }

        if (isset($data['id'])) {
            $node->id($data['id']);
        }
        if (isset($data['name'])) {
            $node->name($data['name']);
        }
        if (isset($data['visible'])) {
            $node->visible($data['visible']);
        }
        if (isset($data['rotation'])) {
            $node->rotation($data['rotation']);
        }
        if (isset($data['pluginData'])) {
            $node->pluginData($data['pluginData']);
        }
        if (isset($data['sharedPluginData'])) {
            $node->sharedPluginData($data['sharedPluginData']);
        }
        if (isset($data['componentPropertyReferences'])) {
            $node->componentPropertyReferences($data['componentPropertyReferences']);
        }
        if (isset($data['boundVariables'])) {
            $node->boundVariables($data['boundVariables']);
        }
        if (isset($data['explicitVariableModes'])) {
            $node->explicitVariableModes($data['explicitVariableModes']);
        }

        return $node;
    }
}