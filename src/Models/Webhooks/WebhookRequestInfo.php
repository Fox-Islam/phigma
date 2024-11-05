<?php

namespace Phox\Phigma\Models\Webhooks;

use Carbon\Carbon;
use Phox\Phigma\Models\Webhooks\Events\Event;

class WebhookRequestInfo
{
    public function __construct(
        private string|null $endpoint = null,
        private array|null $payload = null,
        private string|null $sent_at = null,
    ) {}

    public function getEndpoint(): ?string
    {
        return $this->endpoint;
    }

    public function getPayload(): ?Event
    {
        if (! $this->payload) {
            return null;
        }
        return Event::create($this->payload);
    }

    public function getSentAt(): ?Carbon
    {
        if (! $this->sent_at) {
            return null;
        }

        return Carbon::parse($this->sent_at);
    }

    public function endpoint(string $endpoint): WebhookRequestInfo
    {
        $this->endpoint = $endpoint;
        return $this;
    }

    public function payload(array $payload): WebhookRequestInfo
    {
        $this->payload = $payload;
        return $this;
    }

    public function sentAt(string $sentAt): WebhookRequestInfo
    {
        $this->sent_at = $sentAt;
        return $this;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public static function create(array $data): WebhookRequestInfo
    {
        $webhookRequestInfo = new WebhookRequestInfo();
        if (isset($data['endpoint'])) {
            $webhookRequestInfo->endpoint($data['endpoint']);
        }
        if (isset($data['payload'])) {
            $webhookRequestInfo->payload($data['payload']);
        }
        if (isset($data['sent_at'])) {
            $webhookRequestInfo->sentAt($data['sent_at']);
        }

        return $webhookRequestInfo;
    }
}