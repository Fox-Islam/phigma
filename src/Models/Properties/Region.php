<?php

namespace Phox\Phigma\Models\Properties;

class Region
{
    public function __construct(
        private int|null $x = null,
        private int|null $y = null,
        private int|null $region_height = null,
        private int|null $region_width = null,
        private string|null $comment_pin_corner = null,
    ) {}

    public function getX(): ?int
    {
        return $this->x;
    }

    public function getY(): ?int
    {
        return $this->y;
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

    public function x(?int $x): Region
    {
        $this->x = $x;
        return $this;
    }

    public function y(?int $y): Region
    {
        $this->y = $y;
        return $this;
    }

    public function regionHeight(?int $regionHeight): Region
    {
        $this->region_height = $regionHeight;
        return $this;
    }

    public function regionWidth(?int $regionWidth): Region
    {
        $this->region_width = $regionWidth;
        return $this;
    }

    public function commentPinCorner(?string $commentPinCorner): Region
    {
        $this->comment_pin_corner = $commentPinCorner;
        return $this;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public static function create(array $data): Region
    {
        $region = new Region();
        if (isset($data['x'])) {
            $region->x($data['x']);
        }
        if (isset($data['y'])) {
            $region->y($data['y']);
        }
        if (isset($data['region_height'])) {
            $region->regionHeight($data['region_height']);
        }
        if (isset($data['region_width'])) {
            $region->regionWidth($data['region_width']);
        }
        if (isset($data['comment_pin_corner'])) {
            $region->commentPinCorner($data['comment_pin_corner']);
        }

        return $region;
    }
}