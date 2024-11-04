<?php

namespace Phox\Phigma\Models\Webhooks;

use Carbon\Carbon;
use Phox\Phigma\Models\Collection;
use Phox\Phigma\Models\User;

class Payload
{
    public const string ID_METHOD = 'getWebhookId';

    public function __construct(
        private string|null $event_type = null,
        private string|null $file_key = null,
        private string|null $file_name = null,
        private string|null $passcode = null,
        private int|null $webhook_id = null,
        private string|null $timestamp = null,
        private string|null $created_at = null,
        private array|null $triggered_by = null,
        private string|null $description = null,
        private string|null $label = null,
        private string|null $version_id = null,
        private array|null $created_components = null,
        private array|null $created_styles = null,
        private array|null $created_variables = null,
        private array|null $modified_components = null,
        private array|null $modified_styles = null,
        private array|null $modified_variables = null,
        private array|null $deleted_components = null,
        private array|null $deleted_styles = null,
        private array|null $deleted_variables = null,
        private array|null $comment = null,
        private int|null $comment_id = null,
        private array|null $mentions = null,
        private int|null $order_id = null,
        private int|null $parent_id = null,
        private string|null $resolved_at = null,
    ) {}

    public function getEventType(): ?string
    {
        return $this->event_type;
    }

    public function getFileKey(): ?string
    {
        return $this->file_key;
    }

    public function getFileName(): ?string
    {
        return $this->file_name;
    }

    public function getPasscode(): ?string
    {
        return $this->passcode;
    }

    public function getWebhookId(): ?int
    {
        return $this->webhook_id;
    }

    public function getTimestamp(): ?Carbon
    {
        if (! $this->timestamp) {
            return null;
        }

        return Carbon::parse($this->timestamp);
    }

    public function getCreatedAt(): ?Carbon
    {
        if (! $this->created_at) {
            return null;
        }

        return Carbon::parse($this->created_at);
    }

    public function getTriggeredBy(): ?User
    {
        if (! $this->triggered_by) {
            return null;
        }

        return User::create($this->triggered_by);
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function getVersionId(): ?string
    {
        return $this->version_id;
    }

    /**
     * @return Collection<LibraryItemData>|null
     */
    public function getCreatedComponents(): ?Collection
    {
        if (! $this->created_components) {
            return null;
        }


        return Collection::create(LibraryItemData::class, $this->created_components);
    }

    /**
     * @return Collection<LibraryItemData>|null
     */
    public function getCreatedStyles(): ?Collection
    {
        if (! $this->created_styles) {
            return null;
        }

        return Collection::create(LibraryItemData::class, $this->created_styles);
    }

    /**
     * @return Collection<LibraryItemData>|null
     */
    public function getCreatedVariables(): ?Collection
    {
        if (! $this->created_variables) {
            return null;
        }

        return Collection::create(LibraryItemData::class, $this->created_variables);
    }

    /**
     * @return Collection<LibraryItemData>|null
     */
    public function getModifiedComponents(): ?Collection
    {
        if (! $this->modified_components) {
            return null;
        }

        return Collection::create(LibraryItemData::class, $this->modified_components);
    }

    /**
     * @return Collection<LibraryItemData>|null
     */
    public function getModifiedStyles(): ?Collection
    {
        if (! $this->modified_styles) {
            return null;
        }

        return Collection::create(LibraryItemData::class, $this->modified_styles);
    }

    /**
     * @return Collection<LibraryItemData>|null
     */
    public function getModifiedVariables(): ?Collection
    {
        if (! $this->modified_variables) {
            return null;
        }

        return Collection::create(LibraryItemData::class, $this->modified_variables);
    }

    /**
     * @return Collection<LibraryItemData>|null
     */
    public function getDeletedComponents(): ?Collection
    {
        if (! $this->deleted_components) {
            return null;
        }

        return Collection::create(LibraryItemData::class, $this->deleted_components);
    }

    /**
     * @return Collection<LibraryItemData>|null
     */
    public function getDeletedStyles(): ?Collection
    {
        if (! $this->deleted_styles) {
            return null;
        }

        return Collection::create(LibraryItemData::class, $this->deleted_styles);
    }

    /**
     * @return Collection<LibraryItemData>|null
     */
    public function getDeletedVariables(): ?Collection
    {
        if (! $this->deleted_variables) {
            return null;
        }

        return Collection::create(LibraryItemData::class, $this->deleted_variables);
    }

    /**
     * @return Collection<CommentFragment>|null
     */
    public function getComment(): ?Collection
    {
        if (! $this->comment) {
            return null;
        }

        return Collection::create(CommentFragment::class, $this->comment);
    }

    public function getCommentId(): ?int
    {
        return $this->comment_id;
    }

    /**
     * @return Collection<User>|null
     */
    public function getMentions(): ?Collection
    {
        if (! $this->mentions) {
            return null;
        }

        return Collection::create(User::class, $this->mentions);
    }

    public function getOrderId(): ?int
    {
        return $this->order_id;
    }

    public function getParentId(): ?int
    {
        return $this->parent_id;
    }

    public function getResolvedAt(): ?Carbon
    {
        if (! $this->resolved_at) {
            return null;
        }

        return Carbon::parse($this->resolved_at);
    }

    public function eventType(string $eventType): Payload
    {
        $this->event_type = $eventType;
        return $this;
    }

    public function fileKey(string $fileKey): Payload
    {
        $this->file_key = $fileKey;
        return $this;
    }

    public function fileName(string $fileName): Payload
    {
        $this->file_name = $fileName;
        return $this;
    }

    public function passcode(string $passcode): Payload
    {
        $this->passcode = $passcode;
        return $this;
    }

    public function webhookId(int $webhookId): Payload
    {
        $this->webhook_id = $webhookId;
        return $this;
    }

    public function timestamp(string $timestamp): Payload
    {
        $this->timestamp = $timestamp;
        return $this;
    }

    public function createdAt(string $createdAt): Payload
    {
        $this->created_at = $createdAt;
        return $this;
    }

    public function triggeredBy(array $triggeredBy): Payload
    {
        $this->triggered_by = $triggeredBy;
        return $this;
    }

    public function description(string $description): Payload
    {
        $this->description = $description;
        return $this;
    }

    public function label(string $label): Payload
    {
        $this->label = $label;
        return $this;
    }

    public function versionId(string $versionId): Payload
    {
        $this->version_id = $versionId;
        return $this;
    }

    public function createdComponents(array $createdComponents): Payload
    {
        $this->created_components = $createdComponents;
        return $this;
    }

    public function createdStyles(array $createdStyles): Payload
    {
        $this->created_styles = $createdStyles;
        return $this;
    }

    public function createdVariables(array $createdVariables): Payload
    {
        $this->created_variables = $createdVariables;
        return $this;
    }

    public function modifiedComponents(array $modifiedComponents): Payload
    {
        $this->modified_components = $modifiedComponents;
        return $this;
    }

    public function modifiedStyles(array $modifiedStyles): Payload
    {
        $this->modified_styles = $modifiedStyles;
        return $this;
    }

    public function modifiedVariables(array $modifiedVariables): Payload
    {
        $this->modified_variables = $modifiedVariables;
        return $this;
    }

    public function deletedComponents(array $deletedComponents): Payload
    {
        $this->deleted_components = $deletedComponents;
        return $this;
    }

    public function deletedStyles(array $deletedStyles): Payload
    {
        $this->deleted_styles = $deletedStyles;
        return $this;
    }

    public function deletedVariables(array $deletedVariables): Payload
    {
        $this->deleted_variables = $deletedVariables;
        return $this;
    }

    public function comment(array $comment): Payload
    {
        $this->comment = $comment;
        return $this;
    }

    public function commentId(int $commentId): Payload
    {
        $this->comment_id = $commentId;
        return $this;
    }
    public function mentions(array $mentions): Payload
    {
        $this->mentions = $mentions;
        return $this;
    }

    public function orderId(int $orderId): Payload
    {
        $this->order_id = $orderId;
        return $this;
    }
    public function parentId(int $parentId): Payload
    {
        $this->parent_id = $parentId;
        return $this;
    }

    public function resolvedAt(string $resolvedAt): Payload
    {
        $this->resolved_at = $resolvedAt;
        return $this;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public static function create(array $data): Payload
    {
        $payload = new Payload();

        if (isset($data['event_type'])) {
            $payload->eventType($data['event_type']);
        }
        if (isset($data['file_key'])) {
            $payload->fileKey($data['file_key']);
        }
        if (isset($data['file_name'])) {
            $payload->fileName($data['file_name']);
        }
        if (isset($data['passcode'])) {
            $payload->passcode($data['passcode']);
        }
        if (isset($data['webhook_id'])) {
            $payload->webhookId($data['webhook_id']);
        }
        if (isset($data['timestamp'])) {
            $payload->timestamp($data['timestamp']);
        }
        if (isset($data['created_at'])) {
            $payload->createdAt($data['created_at']);
        }
        if (isset($data['triggered_by'])) {
            $payload->triggeredBy($data['triggered_by']);
        }
        if (isset($data['description'])) {
            $payload->description($data['description']);
        }
        if (isset($data['label'])) {
            $payload->label($data['label']);
        }
        if (isset($data['version_id'])) {
            $payload->versionId($data['version_id']);
        }
        if (isset($data['created_components'])) {
            $payload->createdComponents($data['created_components']);
        }
        if (isset($data['created_styles'])) {
            $payload->createdStyles($data['created_styles']);
        }
        if (isset($data['created_variables'])) {
            $payload->createdVariables($data['created_variables']);
        }
        if (isset($data['modified_components'])) {
            $payload->modifiedComponents($data['modified_components']);
        }
        if (isset($data['modified_styles'])) {
            $payload->modifiedStyles($data['modified_styles']);
        }
        if (isset($data['modified_variables'])) {
            $payload->modifiedVariables($data['modified_variables']);
        }
        if (isset($data['deleted_components'])) {
            $payload->deletedComponents($data['deleted_components']);
        }
        if (isset($data['deleted_styles'])) {
            $payload->deletedStyles($data['deleted_styles']);
        }
        if (isset($data['deleted_variables'])) {
            $payload->deletedVariables($data['deleted_variables']);
        }
        if (isset($data['comment'])) {
            $payload->comment($data['comment']);
        }
        if (isset($data['comment_id'])) {
            $payload->commentId($data['comment_id']);
        }
        if (isset($data['mentions'])) {
            $payload->mentions($data['mentions']);
        }
        if (isset($data['order_id'])) {
            $payload->orderId($data['order_id']);
        }
        if (isset($data['parent_id'])) {
            $payload->parentId($data['parent_id']);
        }
        if (isset($data['resolved_at'])) {
            $payload->resolvedAt($data['resolved_at']);
        }

        return $payload;
    }
}