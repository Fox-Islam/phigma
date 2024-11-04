<?php

namespace Phox\Phigma\Models\Webhooks;

use Carbon\Carbon;

class WebhookResponseInfo
{
    public function __construct(
        private string|null $status = null,
        private string|null $received_at = null,
    ) {}

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getReceivedAt(): ?Carbon
    {
        if (! $this->received_at) {
            return null;
        }

        return Carbon::parse($this->received_at);
    }

    public function status(string $status): WebhookResponseInfo
    {
        $this->status = $status;
        return $this;
    }

    public function receivedAt(string $receivedAt): WebhookResponseInfo
    {
        $this->received_at = $receivedAt;
        return $this;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public static function create(array $data): WebhookResponseInfo
    {
        $webhookResponseInfo = new WebhookResponseInfo();
        if (isset($data['status'])) {
            $webhookResponseInfo->status($data['status']);
        }
        if (isset($data['received_at'])) {
            $webhookResponseInfo->receivedAt($data['received_at']);
        }

        return $webhookResponseInfo;
    }
}