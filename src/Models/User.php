<?php

namespace Phox\Phigma\Models;

class User
{
    public const string ID_METHOD = 'getId';

    public function __construct(
        private ?string $id = null,
        private ?string $handle = null,
        private ?string $imgUrl = null,
        private ?string $email = null,
    ) {}

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getHandle(): ?string
    {
        return $this->handle;
    }

    /**
     * Alias for getHandle
     */
    public function getUsername(): ?string
    {
        return $this->getHandle();
    }

    /**
     * Alias for getHandle
     */
    public function getName(): ?string
    {
        return $this->getHandle();
    }

    public function getImgUrl(): ?string
    {
        return $this->imgUrl;
    }

    /**
     * Alias for getImgUrl
     */
    public function getProfilePicture(): ?string
    {
        return $this->getImgUrl();
    }

    /**
     * Alias for getImgUrl
     */
    public function getAvatar(): ?string
    {
        return $this->getImgUrl();
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function id(string $id): User
    {
        $this->id = $id;
        return $this;
    }

    public function handle(string $handle): User
    {
        $this->handle = $handle;
        return $this;
    }

    public function imgUrl(string $imgUrl): User
    {
        $this->imgUrl = $imgUrl;
        return $this;
    }

    public function email(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public static function create(array $data): User
    {
        $user = new User();
        if (isset($data['id'])) {
            $user->id($data['id']);
        }
        if (isset($data['handle'])) {
            $user->handle($data['handle']);
        }
        if (isset($data['imgUrl'])) {
            $user->imgUrl($data['imgUrl']);
        }
        if (isset($data['email'])) {
            $user->email($data['email']);
        }

        return $user;
    }
}