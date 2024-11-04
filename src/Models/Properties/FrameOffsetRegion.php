<?php

namespace Phox\Phigma\Models\Properties;

class FrameOffsetRegion
{
    public function __construct(
        private string|null $node_id = null,
        private array|null $node_offset = null,
        private int|null $region_height = null,
        private int|null $region_width = null,
        private string|null $comment_pin_corner = null,
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

    public function getRegionHeight(): ?int
    {
        return $this->region_height;
    }

    public function getRegionWidth(): ?int
    {
        return $this->region_width;
    }

    public function getCommentPinCorner(): ?string
    {
        return $this->comment_pin_corner;
    }

    public function nodeId(string $node_id): FrameOffsetRegion
    {
        $this->node_id = $node_id;
        return $this;
    }

    public function nodeOffset(array $node_offset): FrameOffsetRegion
    {
        $this->node_offset = $node_offset;
        return $this;
    }

    public function regionHeight(?int $regionHeight): FrameOffsetRegion
    {
        $this->region_height = $regionHeight;
        return $this;
    }

    public function regionWidth(?int $regionWidth): FrameOffsetRegion
    {
        $this->region_width = $regionWidth;
        return $this;
    }

    public function commentPinCorner(?string $commentPinCorner): FrameOffsetRegion
    {
        $this->comment_pin_corner = $commentPinCorner;
        return $this;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public static function create(array $data): FrameOffsetRegion
    {
        $frameOffsetRegion = new FrameOffsetRegion();
        if (isset($data['node_id'])) {
            $frameOffsetRegion->nodeId($data['node_id']);
        }
        if (isset($data['node_offset'])) {
            $frameOffsetRegion->nodeOffset($data['node_offset']);
        }
        if (isset($data['region_height'])) {
            $frameOffsetRegion->regionHeight($data['region_height']);
        }
        if (isset($data['region_width'])) {
            $frameOffsetRegion->regionWidth($data['region_width']);
        }
        if (isset($data['comment_pin_corner'])) {
            $frameOffsetRegion->commentPinCorner($data['comment_pin_corner']);
        }

        return $frameOffsetRegion;
    }
}