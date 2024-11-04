<?php

namespace Phox\Phigma\Models\Projects;

class Project
{
    public const ID_METHOD = 'getId';

    public function __construct(
        private ?int $id = null,
        private ?string $name = null,
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function id(int $id): Project
    {
        $this->id = $id;
        return $this;
    }

    public function name(string $name): Project
    {
        $this->name = $name;
        return $this;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public static function create(array $data): Project
    {
        $project = new Project();
        if (isset($data['id'])) {
            $project->id($data['id']);
        }
        if (isset($data['name'])) {
            $project->name($data['name']);
        }

        return $project;
    }
}