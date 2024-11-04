<?php

namespace Phox\Phigma\Requests;

use GuzzleHttp\Exception\GuzzleException;
use JsonException;
use Phox\Phigma\Client;
use Phox\Phigma\Models\Collection;
use Phox\Phigma\Models\Webhooks\Webhook;
use Phox\Phigma\Models\Webhooks\WebhookRequest;

readonly class Webhooks
{
    public function __construct(
        private Client $client,
    ) {}

    /**
     * @link https://www.figma.com/developers/api#webhooks-v2-post-endpoint Figma API reference
     * @param string $eventType The type of event that will trigger this webhook to fire (see Phox\Phigma\Strings\WebhookEvents)
     * @param string $teamId Team id to receive updates about
     * @param string $endpoint The HTTP endpoint that will receive a POST request when the event triggers. Max length 2048 characters
     * @param string $passcode String that will be passed back to your webhook endpoint to verify that it is being called by Figma. Max length 100 characters
     * @param string|null $status State of the webhook, including any error state it may be in
     * @param string|null $description User provided description or name for the webhook. Max length 150 characters
     * @throws GuzzleException
     * @throws JsonException
     */
    public function createWebhook(
        string $eventType,
        string $teamId,
        string $endpoint,
        string $passcode,
        string $status = null,
        string $description = null,
    ): ?Webhook {
        $bodyParams = [
            'event_type' => $eventType,
            'team_id' => $teamId,
            'endpoint' => $endpoint,
            'passcode' => $passcode,
        ];

        if ($status) {
            $bodyParams['status'] = $status;
        }
        if ($description) {
            $bodyParams['description'] = $description;
        }

        $body = $this->client->post("https://api.figma.com/v2/webhooks", [
            'body' => json_encode($bodyParams, JSON_THROW_ON_ERROR),
        ]);

        if (empty($body)) {
            return null;
        }

        return Webhook::create($body);
    }

    /**
     * @link https://www.figma.com/developers/api#webhooks-v2-get-endpoint Figma API reference
     * @param string $webhookId The id of the webhook you want to query for
     * @throws GuzzleException
     */
    public function getWebhook(string $webhookId): ?Webhook
    {
        $body = $this->client->get("https://api.figma.com/v2/webhooks/$webhookId");
        if (empty($body)) {
            return null;
        }

        return Webhook::create($body);
    }

    /**
     * @link https://www.figma.com/developers/api#webhooks-v2-put-endpoint Figma API reference
     * @param string $webhookId The id of the webhook to update
     * @param string|null $eventType The type of event that will trigger this webhook to fire (see Phox\Phigma\Strings\WebhookEvents)
     * @param string|null $endpoint The HTTP endpoint that will receive a POST request when the event triggers. Max length 2048 characters
     * @param string|null $passcode String that will be passed back to your webhook endpoint to verify that it is being called by Figma. Max length 100 characters
     * @param string|null $status State of the webhook, including any error state it may be in
     * @param string|null $description User provided description or name for the webhook. Max length 150 characters
     * @throws GuzzleException
     * @throws JsonException
     */
    public function updateWebhook(
        string $webhookId,
        string $eventType = null,
        string $endpoint = null,
        string $passcode = null,
        string $status = null,
        string $description = null,
    ): ?Webhook {
        $bodyParams = [];

        if ($eventType) {
            $bodyParams['event_type'] = $eventType;
        }
        if ($endpoint) {
            $bodyParams['endpoint'] = $endpoint;
        }
        if ($passcode) {
            $bodyParams['passcode'] = $passcode;
        }
        if ($status) {
            $bodyParams['status'] = $status;
        }
        if ($description) {
            $bodyParams['description'] = $description;
        }

        $body = $this->client->post("https://api.figma.com/v2/webhooks/$webhookId", [
            'body' => json_encode($bodyParams, JSON_THROW_ON_ERROR),
        ]);

        if (empty($body)) {
            return null;
        }

        return Webhook::create($body);
    }

    /**
     * @link https://www.figma.com/developers/api#webhooks-v2-delete-endpoint Figma API reference
     * @param string $webhookId The id of the webhook you want to delete
     * @throws GuzzleException
     */
    public function deleteWebhook(string $webhookId): ?Webhook
    {
        $body = $this->client->delete("https://api.figma.com/v2/webhooks/$webhookId");
        if (empty($body)) {
            return null;
        }

        return Webhook::create($body);
    }

    /**
     * @link https://www.figma.com/developers/api#webhooks-v2-teams-endpoint Figma API reference
     * @param string $teamId The team id you want to query for
     * @return Collection<Webhook>
     * @throws GuzzleException
     */
    public function getTeamWebhooks(string $teamId): Collection
    {
        $body = $this->client->get("https://api.figma.com/v2/teams/$teamId/webhooks");

        return Collection::create(Webhook::class, $body['webhooks'] ?? []);
    }

    /**
     * @link https://www.figma.com/developers/api#webhooks-v2-requests-endpoint Figma API reference
     * @param string $webhookId The id of the webhook subscription you want to see events from
     * @return Collection<WebhookRequest>
     * @throws GuzzleException
     */
    public function getWebhookRequests(string $webhookId): Collection
    {
        $body = $this->client->get("https://api.figma.com/v2/webhooks/$webhookId/requests");

        return Collection::create(WebhookRequest::class, $body['requests'] ?? []);
    }
}