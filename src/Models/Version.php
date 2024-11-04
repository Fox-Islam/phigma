<?php

namespace Phox\Phigma\Models;

use Carbon\Carbon;

class Version
{
    public function __construct(
        private ?string $id = null,
        private ?string $description = null,
        private ?string $label = null,
        private ?string $created_at = null,
        private ?array $user = null,
    ) {}

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function getCreatedAt(): ?Carbon
    {
        if (! $this->created_at) {
            return null;
        }

        return Carbon::parse($this->created_at);
    }

    public function getUser(): ?User
    {
        if (! $this->user) {
            return null;
        }

        return User::create($this->user);
    }

    public function id(string $id): Version
    {
        $this->id = $id;
        return $this;
    }

    public function description(string $description): Version
    {
        $this->description = $description;
        return $this;
    }

    public function label(string $label): Version
    {
        $this->label = $label;
        return $this;
    }

    public function createdAt(string $createdAt): Version
    {
        $this->created_at = $createdAt;
        return $this;
    }

    public function user(array $user): Version
    {
        $this->user = $user;
        return $this;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public static function create(array $data): Version
    {
        $version = new Version();
        if (isset($data['id'])) {
            $version->id($data['id']);
        }
        if (isset($data['description'])) {
            $version->description($data['description']);
        }
        if (isset($data['label'])) {
            $version->label($data['label']);
        }
        if (isset($data['created_at'])) {
            $version->createdAt($data['created_at']);
        }
        if (isset($data['user'])) {
            $version->user($data['user']);
        }

        return $version;
    }
}