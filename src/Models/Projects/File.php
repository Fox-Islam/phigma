<?php

namespace Phox\Phigma\Models\Projects;

use Carbon\Carbon;
use Phox\Phigma\Models\Collection;

class File
{
    public const string ID_METHOD = 'getKey';

    public function __construct(
        private string|null $key = null,
        private string|null $name = null,
        private string|null $thumbnail_url = null,
        private string|null $last_modified = null,
        private array|null $branches = null,
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

    /**
     * @return Collection<Branch>
     */
    public function getBranches(): Collection
    {
        return Collection::create(Branch::class, $this->branches ?? []);
    }

    public function key(string $key): File
    {
        $this->key = $key;
        return $this;
    }

    public function name(string $name): File
    {
        $this->name = $name;
        return $this;
    }

    public function thumbnailUrl(string $thumbnailUrl): File
    {
        $this->thumbnail_url = $thumbnailUrl;
        return $this;
    }

    public function lastModified(string $lastModified): File
    {
        $this->last_modified = $lastModified;
        return $this;
    }

    public function branches(array $branches): File
    {
        $this->branches = $branches;
        return $this;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public static function create(array $data): File
    {
        $file = new File();
        if (isset($data['key'])) {
            $file->key($data['key']);
        }
        if (isset($data['name'])) {
            $file->name($data['name']);
        }
        if (isset($data['thumbnail_url'])) {
            $file->thumbnailUrl($data['thumbnail_url']);
        }
        if (isset($data['last_modified'])) {
            $file->lastModified($data['last_modified']);
        }
        if (isset($data['branches'])) {
            $file->branches($data['branches']);
        }

        return $file;
    }
}