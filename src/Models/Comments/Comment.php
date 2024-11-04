<?php

namespace Phox\Phigma\Models\Comments;

use Carbon\Carbon;
use Phox\Phigma\Models\Collection;
use Phox\Phigma\Models\Properties\FrameOffset;
use Phox\Phigma\Models\Properties\FrameOffsetRegion;
use Phox\Phigma\Models\Properties\Region;
use Phox\Phigma\Models\Properties\Vector;
use Phox\Phigma\Models\User;

class Comment
{
    public const ID_METHOD = 'getId';

    public function __construct(
        private string|null $id = null,
        private array|null $client_meta = null,
        private string|null $file_key = null,
        private string|null $parent_id = null,
        private array|null $user = null,
        private string|null $created_at = null,
        private string|null $resolved_at = null,
        private int|null $order_id = null,
        private array|null $reactions = null,
    ) {}

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getClientMeta(): Vector|Region|FrameOffset|FrameOffsetRegion|null
    {
        if (empty($this->client_meta)) {
            return null;
        }

        $hasPosition = isset($this->client_meta['x'], $this->client_meta['y']);
        $hasDimensions = isset($this->client_meta['region_height'], $this->client_meta['region_width'], $this->client_meta['comment_pin_corner']);
        $hasOffset = isset($this->client_meta['node_id'], $this->client_meta['node_offset']);

        if ($hasPosition && $hasDimensions) {
            return Region::create($this->client_meta);

        }
        if ($hasPosition) {
            return Vector::create($this->client_meta);
        }

        if ($hasOffset && $hasDimensions) {
            return FrameOffsetRegion::create($this->client_meta);
        }

        if ($hasOffset) {
            return FrameOffset::create($this->client_meta);
        }

        return null;
    }

    public function getFileKey(): ?string
    {
        return $this->file_key;
    }

    public function getParentId(): ?string
    {
        return $this->parent_id;
    }

    public function getUser(): ?User
    {
        if (! $this->user) {
            return null;
        }

        return User::create($this->user);
    }

    public function getCreatedAt(): ?Carbon
    {
        if (! $this->created_at) {
            return null;
        }

        return Carbon::parse($this->created_at);
    }

    public function getResolvedAt(): ?Carbon
    {
        if (! $this->resolved_at) {
            return null;
        }

        return Carbon::parse($this->resolved_at);
    }

    public function getOrderId(): ?int
    {
        return $this->order_id;
    }

    /**
     * @return Collection<Reaction>|null
     */
    public function getReactions(): ?Collection
    {
        if (! $this->reactions) {
            return null;
        }

        return (new Collection(Reaction::class))->create($this->reactions);
    }

    public function id(string $id): Comment
    {
        $this->id = $id;
        return $this;
    }

    public function clientMeta(array $client_meta): Comment
    {
        $this->client_meta = $client_meta;
        return $this;
    }

    public function fileKey(string $fileKey): Comment
    {
        $this->file_key = $fileKey;
        return $this;
    }

    public function parentId(string $parentId): Comment
    {
        $this->parent_id = $parentId;
        return $this;
    }

    public function user(array $user): Comment
    {
        $this->user = $user;
        return $this;
    }

    public function createdAt(string $createdAt): Comment
    {
        $this->created_at = $createdAt;
        return $this;
    }

    public function resolvedAt(string $resolvedAt): Comment
    {
        $this->resolved_at = $resolvedAt;
        return $this;
    }

    public function orderId(int $orderId): Comment
    {
        $this->order_id = $orderId;
        return $this;
    }

    public function reactions(array $reactions): Comment
    {
        $this->reactions = $reactions;
        return $this;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public static function create(array $data): Comment
    {
        $comment = new Comment();

        if (isset($data['id'])) {
            $comment->id($data['id']);
        }
        if (isset($data['client_meta'])) {
            $comment->clientMeta($data['client_meta']);
        }
        if (isset($data['file_key'])) {
            $comment->fileKey($data['file_key']);
        }
        if (isset($data['parent_id'])) {
            $comment->parentId($data['parent_id']);
        }
        if (isset($data['user'])) {
            $comment->user($data['user']);
        }
        if (isset($data['created_at'])) {
            $comment->createdAt($data['created_at']);
        }
        if (isset($data['resolved_at'])) {
            $comment->resolvedAt($data['resolved_at']);
        }
        if (isset($data['order_id'])) {
            $comment->orderId($data['order_id']);
        }
        if (isset($data['reactions'])) {
            $comment->reactions($data['reactions']);
        }

        return $comment;
    }
}