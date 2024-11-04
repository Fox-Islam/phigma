<?php

namespace Phox\Phigma\Models\Nodes;

use Carbon\Carbon;

class File
{
    public function __construct(
        private ?array $document = null,
        private ?array $components = null,
        private ?array $componentSets = null,
        private ?int $schemaVersion = null,
        private ?array $styles = null,
        private ?string $name = null,
        private ?string $lastModified = null,
        private ?string $thumbnailUrl = null,
        private ?string $version = null,
        private ?string $role = null,
        private ?string $editorType = null,
        private ?string $linkAccess = null,
    ) {}

    public function getDocument(): ?Document
    {
        if (! $this->document) {
            return null;
        }

        return Document::create($this->document);
    }

    public function getComponents(): ?array
    {
        return $this->components;
    }

    public function getComponentSets(): ?array
    {
        return $this->componentSets;
    }

    public function getSchemaVersion(): ?int
    {
        return $this->schemaVersion;
    }

    public function getStyles(): ?array
    {
        return $this->styles;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getLastModified(): ?Carbon
    {
        if (! $this->lastModified) {
            return null;
        }

        return Carbon::parse($this->lastModified);
    }

    public function getThumbnailUrl(): ?string
    {
        return $this->thumbnailUrl;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function getEditorType(): ?string
    {
        return $this->editorType;
    }

    public function getLinkAccess(): ?string
    {
        return $this->linkAccess;
    }

    public function document(array $document): File
    {
        $this->document = $document;
        return $this;
    }

    public function components(array $components): File
    {
        $this->components = $components;
        return $this;
    }

    public function componentSets(array $componentSets): File
    {
        $this->componentSets = $componentSets;
        return $this;
    }

    public function schemaVersion(int $schemaVersion): File
    {
        $this->schemaVersion = $schemaVersion;
        return $this;
    }

    public function styles(array $styles): File
    {
        $this->styles = $styles;
        return $this;
    }

    public function name(string $name): File
    {
        $this->name = $name;
        return $this;
    }

    public function lastModified(string $lastModified): File
    {
        $this->lastModified = $lastModified;
        return $this;
    }

    public function thumbnailUrl(string $thumbnailUrl): File
    {
        $this->thumbnailUrl = $thumbnailUrl;
        return $this;
    }

    public function version(string $version): File
    {
        $this->version = $version;
        return $this;
    }

    public function role(string $role): File
    {
        $this->role = $role;
        return $this;
    }

    public function editorType(string $editorType): File
    {
        $this->editorType = $editorType;
        return $this;
    }

    public function linkAccess(string $linkAccess): File
    {
        $this->linkAccess = $linkAccess;
        return $this;
    }

    public static function create(array $data): File
    {
        $file = new File();

        if (isset($data['document'])) {
            $file->document = $data['document'];
        }
        if (isset($data['name'])) {
            $file->name($data['name']);
        }
        if (isset($data['lastModified'])) {
            $file->lastModified($data['lastModified']);
        }
        if (isset($data['thumbnailUrl'])) {
            $file->thumbnailUrl($data['thumbnailUrl']);
        }
        if (isset($data['version'])) {
            $file->version($data['version']);
        }
        if (isset($data['role'])) {
            $file->role($data['role']);
        }
        if (isset($data['editorType'])) {
            $file->editorType($data['editorType']);
        }
        if (isset($data['linkAccess'])) {
            $file->linkAccess($data['linkAccess']);
        }

        return $file;
    }
}