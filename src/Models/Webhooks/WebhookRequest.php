<?php

namespace Phox\Phigma\Models\Webhooks;

use Carbon\Carbon;

class WebhookRequest
{
    public const string ID_METHOD = 'getWebhookId';

    public function __construct(
        private string|null $webhook_id = null,
        private array|null $request_info = null,
        private array|null $response_info = null,
        private string|null $error_msg = null,
    ) {}

    public function getWebhookid(): ?string
    {
        return $this->webhook_id;
    }

    public function getRequestinfo(): ?WebhookRequestInfo
    {
        if (! $this->request_info) {
            return null;
        }

        return WebhookRequestInfo::create($this->request_info);
    }

    public function getResponseinfo(): ?WebhookResponseInfo
    {
        if (! $this->response_info) {
            return null;
        }

        return WebhookResponseInfo::create($this->response_info);
    }

    public function getErrorMessage(): ?string
    {
        return $this->error_msg;
    }

    public function webhookId(string $webhookId): WebhookRequest
    {
        $this->webhook_id = $webhookId;
        return $this;
    }

    public function requestInfo(array $requestInfo): WebhookRequest
    {
        $this->request_info = $requestInfo;
        return $this;
    }

    public function responseInfo(array $responseInfo): WebhookRequest
    {
        $this->response_info = $responseInfo;
        return $this;
    }

    public function errorMessage(string $errorMessage): WebhookRequest
    {
        $this->error_msg = $errorMessage;
        return $this;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public static function create(array $data): WebhookRequest
    {
        $webhookRequest = new WebhookRequest();
        if (isset($data['webhook_id'])) {
            $webhookRequest->webhookId($data['webhook_id']);
        }
        if (isset($data['request_info'])) {
            $webhookRequest->requestInfo($data['request_info']);
        }
        if (isset($data['response_info'])) {
            $webhookRequest->responseInfo($data['response_info']);
        }
        if (isset($data['error_msg'])) {
            $webhookRequest->errorMessage($data['error_msg']);
        }

        return $webhookRequest;
    }

}