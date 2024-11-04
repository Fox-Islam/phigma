<?php

namespace Phox\Phigma\Models\Webhooks;

class Webhook
{
    public const ID_METHOD = 'getId';

    public function __construct(
        private string|null $id = null,
        private string|null $event_type = null,
        private string|null $team_id = null,
        private string|null $status = null,
        private string|null $client_id = null,
        private string|null $passcode = null,
        private string|null $endpoint = null,
        private string|null $description = null,
    ) {}

    public function getId(): string|null
    {
        return $this->id;
    }

    public function getEventType(): string|null
    {
        return $this->event_type;
    }

    public function getTeamId(): string|null
    {
        return $this->team_id;
    }

    public function getStatus(): string|null
    {
        return $this->status;
    }

    public function getClientId(): string|null
    {
        return $this->client_id;
    }

    public function getPasscode(): string|null
    {
        return $this->passcode;
    }

    public function getEndpoint(): string|null
    {
        return $this->endpoint;
    }

    public function getDescription(): string|null
    {
        return $this->description;
    }

    public function id(string $id): Webhook
    {
        $this->id = $id;
        return $this;
    }

    public function eventType(string $eventType): Webhook
    {
        $this->event_type = $eventType;
        return $this;
    }

    public function teamId(string $teamId): Webhook
    {
        $this->team_id = $teamId;
        return $this;
    }

    public function status(string $status): Webhook
    {
        $this->status = $status;
        return $this;
    }

    public function clientId(string $clientId): Webhook
    {
        $this->client_id = $clientId;
        return $this;
    }

    public function passcode(string $passcode): Webhook
    {
        $this->passcode = $passcode;
        return $this;
    }

    public function endpoint(string $endpoint): Webhook
    {
        $this->endpoint = $endpoint;
        return $this;
    }

    public function description(string $description): Webhook
    {
        $this->description = $description;
        return $this;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public static function create(array $data): Webhook
    {
        $webhook = new Webhook();

        if (isset($data['id'])) {
            $webhook->id($data['id']);
        }
        if (isset($data['event_type'])) {
            $webhook->eventType($data['event_type']);
        }
        if (isset($data['team_id'])) {
            $webhook->teamId($data['team_id']);
        }
        if (isset($data['status'])) {
            $webhook->status($data['status']);
        }
        if (isset($data['client_id'])) {
            $webhook->clientId($data['client_id']);
        }
        if (isset($data['passcode'])) {
            $webhook->passcode($data['passcode']);
        }
        if (isset($data['endpoint'])) {
            $webhook->endpoint($data['endpoint']);
        }
        if (isset($data['description'])) {
            $webhook->description($data['description']);
        }

        return $webhook;
    }
}