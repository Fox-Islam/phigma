<?php

namespace Phox\Phigma\Models\DevResources;

class DevResourceCreate
{
    public const string ID_METHOD = 'getName';

    public function __construct(
        private string|null $name = null,
        private string|null $url = null,
        private string|null $file_key = null,
        private string|null $node_id = null,
    ) {}

    public function getName(): string|null
    {
        return $this->name;
    }

    public function getUrl(): string|null
    {
        return $this->url;
    }

    public function getFileKey(): string|null
    {
        return $this->file_key;
    }

    public function getNodeId(): string|null
    {
        return $this->node_id;
    }

    public function name(string $name): DevResourceCreate
    {
        $this->name = $name;
        return $this;
    }

    public function url(string $url): DevResourceCreate
    {
        $this->url = $url;
        return $this;
    }

    public function fileKey(string $file_key): DevResourceCreate
    {
        $this->file_key = $file_key;
        return $this;
    }

    public function nodeId(string $node_id): DevResourceCreate
    {
        $this->node_id = $node_id;
        return $this;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public static function create(array $data): DevResourceCreate
    {
        $devResourceUpdate = new DevResourceCreate();
        if (isset($data['url'])) {
            $devResourceUpdate->url($data['url']);
        }
        if (isset($data['name'])) {
            $devResourceUpdate->name($data['name']);
        }
        if (isset($data['file_key'])) {
            $devResourceUpdate->fileKey($data['file_key']);
        }
        if (isset($data['node_id'])) {
            $devResourceUpdate->nodeId($data['node_id']);
        }

        return $devResourceUpdate;
    }
}