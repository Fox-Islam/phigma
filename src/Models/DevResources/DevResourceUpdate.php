<?php

namespace Phox\Phigma\Models\DevResources;

class DevResourceUpdate
{
    public function __construct(
        private string|null $id = null,
        private string|null $name = null,
        private string|null $url = null,
    ) {}

    public function getId(): string|null
    {
        return $this->id;
    }

    public function getName(): string|null
    {
        return $this->name;
    }

    public function getUrl(): string|null
    {
        return $this->url;
    }

    public function id(string $id): DevResourceUpdate
    {
        $this->id = $id;
        return $this;
    }

    public function name(string $name): DevResourceUpdate
    {
        $this->name = $name;
        return $this;
    }

    public function url(string $url): DevResourceUpdate
    {
        $this->url = $url;
        return $this;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public static function create(array $data): DevResourceUpdate
    {
        $devResourceUpdate = new DevResourceUpdate();
        if (isset($data['id'])) {
            $devResourceUpdate->id($data['id']);
        }
        if (isset($data['name'])) {
            $devResourceUpdate->name($data['name']);
        }
        if (isset($data['url'])) {
            $devResourceUpdate->url($data['url']);
        }

        return $devResourceUpdate;
    }
}