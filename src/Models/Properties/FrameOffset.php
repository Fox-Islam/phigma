<?php

namespace Phox\Phigma\Models\Properties;

class FrameOffset
{
    public function __construct(
        private string|null $node_id = null,
        private array|null $node_offset = null,
    ) {}

    public function getNodeId(): string|null
    {
        return $this->node_id;
    }

    public function getNodeOffset(): Vector|null
    {
        if (! $this->node_offset) {
            return null;
        }

        return Vector::create($this->node_offset);
    }

    public function nodeId(string $node_id): FrameOffset
    {
        $this->node_id = $node_id;
        return $this;
    }

    public function nodeOffset(array $node_offset): FrameOffset
    {
        $this->node_offset = $node_offset;
        return $this;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public static function create(array $data): FrameOffset
    {
        $frameOffset = new FrameOffset();
        if (isset($data['node_id'])) {
            $frameOffset->nodeId($data['node_id']);
        }
        if (isset($data['node_offset'])) {
            $frameOffset->nodeOffset($data['node_offset']);
        }

        return $frameOffset;
    }
}