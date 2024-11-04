<?php

namespace Phox\Phigma\Requests;

use GuzzleHttp\Exception\GuzzleException;
use Phox\Phigma\Client;
use Phox\Phigma\Models\Version;

readonly class Versions
{
    public function __construct(
        private Client $client,
    ) {}

    /**
     * @link https://www.figma.com/developers/api#version-history Figma API reference
     * @param string $key A file key or branch key to get version history from.
     * @throws GuzzleException
     */
    public function getVersions(string $key): ?array
    {
        $body = $this->client->get("https://api.figma.com/v1/files/{$key}/versions");
        if (empty($body)) {
            return null;
        }

        $versions = [];
        foreach ($body['versions'] as $version) {
            $versions[] = Version::create($version);
        }
        $body['versions'] = $versions;

        return $body;
    }
}