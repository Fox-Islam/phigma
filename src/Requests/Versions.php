<?php

namespace Phox\Phigma\Requests;

use GuzzleHttp\Exception\GuzzleException;
use Phox\Phigma\Client;
use Phox\Phigma\Models\Collection;
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
     * @return Collection<Version>
     */
    public function getVersions(string $key): Collection
    {
        $body = $this->client->get("https://api.figma.com/v1/files/{$key}/versions");
        $collection = new Collection(Version::class);
        if (empty($body) || ! isset($body['versions'])) {
            return $collection;
        }

        return $collection->createItemsFromArray($body['versions']);
    }
}