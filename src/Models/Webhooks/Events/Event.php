<?php

namespace Phox\Phigma\Models\Webhooks\Events;

use Carbon\Carbon;
use Phox\Phigma\Models\Collection;
use Phox\Phigma\Models\User;
use Phox\Phigma\Models\Webhooks\CommentFragment;
use Phox\Phigma\Models\Webhooks\LibraryItemData;

class Event
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

    public function eventType(string $eventType): Event
    {
        $this->event_type = $eventType;
        return $this;
    }

    public function fileKey(string $fileKey): Event
    {
        $this->file_key = $fileKey;
        return $this;
    }

    public function fileName(string $fileName): Event
    {
        $this->file_name = $fileName;
        return $this;
    }

    public function passcode(string $passcode): Event
    {
        $this->passcode = $passcode;
        return $this;
    }

    public function webhookId(int $webhookId): Event
    {
        $this->webhook_id = $webhookId;
        return $this;
    }

    public function timestamp(string $timestamp): Event
    {
        $this->timestamp = $timestamp;
        return $this;
    }

    public function createdAt(string $createdAt): Event
    {
        $this->created_at = $createdAt;
        return $this;
    }

    public function triggeredBy(array $triggeredBy): Event
    {
        $this->triggered_by = $triggeredBy;
        return $this;
    }

    public function description(string $description): Event
    {
        $this->description = $description;
        return $this;
    }

    public function label(string $label): Event
    {
        $this->label = $label;
        return $this;
    }

    public function versionId(string $versionId): Event
    {
        $this->version_id = $versionId;
        return $this;
    }

    public function createdComponents(array $createdComponents): Event
    {
        $this->created_components = $createdComponents;
        return $this;
    }

    public function createdStyles(array $createdStyles): Event
    {
        $this->created_styles = $createdStyles;
        return $this;
    }

    public function createdVariables(array $createdVariables): Event
    {
        $this->created_variables = $createdVariables;
        return $this;
    }

    public function modifiedComponents(array $modifiedComponents): Event
    {
        $this->modified_components = $modifiedComponents;
        return $this;
    }

    public function modifiedStyles(array $modifiedStyles): Event
    {
        $this->modified_styles = $modifiedStyles;
        return $this;
    }

    public function modifiedVariables(array $modifiedVariables): Event
    {
        $this->modified_variables = $modifiedVariables;
        return $this;
    }

    public function deletedComponents(array $deletedComponents): Event
    {
        $this->deleted_components = $deletedComponents;
        return $this;
    }

    public function deletedStyles(array $deletedStyles): Event
    {
        $this->deleted_styles = $deletedStyles;
        return $this;
    }

    public function deletedVariables(array $deletedVariables): Event
    {
        $this->deleted_variables = $deletedVariables;
        return $this;
    }

    public function comment(array $comment): Event
    {
        $this->comment = $comment;
        return $this;
    }

    public function commentId(int $commentId): Event
    {
        $this->comment_id = $commentId;
        return $this;
    }
    public function mentions(array $mentions): Event
    {
        $this->mentions = $mentions;
        return $this;
    }

    public function orderId(int $orderId): Event
    {
        $this->order_id = $orderId;
        return $this;
    }
    public function parentId(int $parentId): Event
    {
        $this->parent_id = $parentId;
        return $this;
    }

    public function resolvedAt(string $resolvedAt): Event
    {
        $this->resolved_at = $resolvedAt;
        return $this;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public static function create(array $data): Event
    {
        $event = new Event();

        if (isset($data['event_type'])) {
            $event->eventType($data['event_type']);
        }
        if (isset($data['file_key'])) {
            $event->fileKey($data['file_key']);
        }
        if (isset($data['file_name'])) {
            $event->fileName($data['file_name']);
        }
        if (isset($data['passcode'])) {
            $event->passcode($data['passcode']);
        }
        if (isset($data['webhook_id'])) {
            $event->webhookId($data['webhook_id']);
        }
        if (isset($data['timestamp'])) {
            $event->timestamp($data['timestamp']);
        }
        if (isset($data['created_at'])) {
            $event->createdAt($data['created_at']);
        }
        if (isset($data['triggered_by'])) {
            $event->triggeredBy($data['triggered_by']);
        }
        if (isset($data['description'])) {
            $event->description($data['description']);
        }
        if (isset($data['label'])) {
            $event->label($data['label']);
        }
        if (isset($data['version_id'])) {
            $event->versionId($data['version_id']);
        }
        if (isset($data['created_components'])) {
            $event->createdComponents($data['created_components']);
        }
        if (isset($data['created_styles'])) {
            $event->createdStyles($data['created_styles']);
        }
        if (isset($data['created_variables'])) {
            $event->createdVariables($data['created_variables']);
        }
        if (isset($data['modified_components'])) {
            $event->modifiedComponents($data['modified_components']);
        }
        if (isset($data['modified_styles'])) {
            $event->modifiedStyles($data['modified_styles']);
        }
        if (isset($data['modified_variables'])) {
            $event->modifiedVariables($data['modified_variables']);
        }
        if (isset($data['deleted_components'])) {
            $event->deletedComponents($data['deleted_components']);
        }
        if (isset($data['deleted_styles'])) {
            $event->deletedStyles($data['deleted_styles']);
        }
        if (isset($data['deleted_variables'])) {
            $event->deletedVariables($data['deleted_variables']);
        }
        if (isset($data['comment'])) {
            $event->comment($data['comment']);
        }
        if (isset($data['comment_id'])) {
            $event->commentId($data['comment_id']);
        }
        if (isset($data['mentions'])) {
            $event->mentions($data['mentions']);
        }
        if (isset($data['order_id'])) {
            $event->orderId($data['order_id']);
        }
        if (isset($data['parent_id'])) {
            $event->parentId($data['parent_id']);
        }
        if (isset($data['resolved_at'])) {
            $event->resolvedAt($data['resolved_at']);
        }

        return $event;
    }
}