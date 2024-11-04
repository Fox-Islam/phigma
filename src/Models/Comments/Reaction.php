<?php

namespace Phox\Phigma\Models\Comments;

use Carbon\Carbon;
use Phox\Phigma\Models\User;

class Reaction
{
    public const ID_METHOD = 'getEmoji';

    public function __construct(
        private array|null $user = null,
        private string|null $emoji = null,
        private string|null $created_at = null,
    ) {}

    public function getUser(): ?User
    {
        if (! $this->user) {
            return null;
        }

        return User::create($this->user);
    }

    public function getEmoji(): ?string
    {
        return $this->emoji;
    }

    public function getCreatedAt(): ?Carbon
    {
        if (! $this->created_at) {
            return null;
        }

        return Carbon::parse($this->created_at);
    }

    public function user(array $user): Reaction
    {
        $this->user = $user;
        return $this;
    }

    public function emoji(string $emoji): Reaction
    {
        $this->emoji = $emoji;
        return $this;
    }

    public function createdAt(string $createdAt): Reaction
    {
        $this->created_at = $createdAt;
        return $this;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public static function create(array $data): Reaction
    {
        $reaction = new Reaction();
        if (isset($data['user'])) {
            $reaction->user($data['user']);
        }
        if (isset($data['emoji'])) {
            $reaction->emoji($data['emoji']);
        }
        if (isset($data['created_at'])) {
            $reaction->createdAt($data['created_at']);
        }

        return $reaction;
    }
}