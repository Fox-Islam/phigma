<?php

namespace Phox\Phigma\Requests;

use GuzzleHttp\Exception\GuzzleException;
use Phox\Phigma\Client;
use Phox\Phigma\Models\User;

readonly class Users
{
    public function __construct(
        private Client $client,
    ) {}

    /**
     * @link https://www.figma.com/developers/api#users Figma API reference
     * @throws GuzzleException
     */
    public function getMe(): ?User
    {
        $body = $this->client->get('https://api.figma.com/v1/me');
        if (empty($body)) {
            return null;
        }

        return User::create($body);
    }
}