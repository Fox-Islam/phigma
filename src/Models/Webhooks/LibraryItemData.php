<?php

namespace Phox\Phigma\Models\Webhooks;

class LibraryItemData
{
    public const string ID_METHOD = 'getKey';

    public function __construct(
        private string|null $key = null,
        private string|null $name = null,
    ) {}

    public function getKey(): ?string
    {
        return $this->key;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function key(string $key): LibraryItemData
    {
        $this->key = $key;
        return $this;
    }

    public function name(string $name): LibraryItemData
    {
        $this->name = $name;
        return $this;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public static function create(array $data): LibraryItemData
    {
        $paymentStatus = new LibraryItemData();
        if (isset($data['key'])) {
            $paymentStatus->key($data['key']);
        }
        if (isset($data['name'])) {
            $paymentStatus->name($data['name']);
        }

        return $paymentStatus;
    }
}