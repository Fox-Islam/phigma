<?php

namespace Phox\Phigma\Models\Projects;

use Carbon\Carbon;
use Phox\Phigma\Models\Collection;

class Branch
{
    public const ID_METHOD = 'getKey';

    public function __construct(
        private string|null $key = null,
        private string|null $name = null,
        private string|null $thumbnail_url = null,
        private string|null $last_modified = null,
        private string|null $link_access = null,
    ) {}

    public function getKey(): ?string
    {
        return $this->key;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getThumbnailUrl(): ?string
    {
        return $this->thumbnail_url;
    }

    public function getLastModified(): ?Carbon
    {
        if (! $this->last_modified) {
            return null;
        }

        return Carbon::parse($this->last_modified);
    }

    public function getLinkAccess(): ?string
    {
        return $this->link_access;
    }

    public function key(string $key): Branch
    {
        $this->key = $key;
        return $this;
    }

    public function name(string $name): Branch
    {
        $this->name = $name;
        return $this;
    }

    public function thumbnailUrl(string $thumbnailUrl): Branch
    {
        $this->thumbnail_url = $thumbnailUrl;
        return $this;
    }

    public function lastModified(string $lastModified): Branch
    {
        $this->last_modified = $lastModified;
        return $this;
    }

    public function linkAccess(string $linkAccess): Branch
    {
        $this->link_access = $linkAccess;
        return $this;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public static function create(array $data): Branch
    {
        $file = new Branch();
        if (isset($data['name'])) {
            $file->name($data['name']);
        }
        if (isset($data['key'])) {
            $file->key($data['key']);
        }
        if (isset($data['thumbnail_url'])) {
            $file->thumbnailUrl($data['thumbnail_url']);
        }
        if (isset($data['last_modified'])) {
            $file->lastModified($data['last_modified']);
        }
        if (isset($data['link_access'])) {
            $file->linkAccess($data['link_access']);
        }

        return $file;
    }
}