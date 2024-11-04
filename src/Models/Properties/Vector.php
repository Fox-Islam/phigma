<?php

namespace Phox\Phigma\Models\Properties;

class Vector
{
    public function __construct(
        private int|null $x = null,
        private int|null $y = null,
    ) {}

    public function getX(): ?int
    {
        return $this->x;
    }

    public function getY(): ?int
    {
        return $this->y;
    }

    public function x(?int $x): Vector
    {
        $this->x = $x;
        return $this;
    }

    public function y(?int $y): Vector
    {
        $this->y = $y;
        return $this;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public static function create(array $data): Vector
    {
        $vector = new Vector();
        if (isset($data['x'])) {
            $vector->x($data['x']);
        }
        if (isset($data['y'])) {
            $vector->y($data['y']);
        }

        return $vector;
    }
}