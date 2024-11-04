<?php

namespace Phox\Phigma\Requests;

use GuzzleHttp\Exception\GuzzleException;
use JsonException;
use Phox\Phigma\Client;
use Phox\Phigma\Models\Collection;
use Phox\Phigma\Models\DevResources\DevResource;
use Phox\Phigma\Models\DevResources\DevResourceCreate;
use Phox\Phigma\Models\DevResources\DevResourceUpdate;

readonly class DevResources
{
    public function __construct(
        private readonly Client $client,
    ) {}

    /**
     * @link https://www.figma.com/developers/api#get-dev-resources-endpoint Figma API reference
     * @param string $fileKey A "main branch" file key to get dev resources from
     * @param string[]|null $nodeIds List of node ids to filter by in the document
     * @return Collection<DevResource>
     * @throws GuzzleException
     */
    public function getDevResources(string $fileKey, array $nodeIds = null): Collection
    {
        $queryParams = [];
        if (! empty($nodeIds)) {
            $queryParams['node_ids'] = implode(',', $nodeIds);
        }

        $body = $this->client->get("https://api.figma.com/v1/files/{$fileKey}/dev_resources", [
            'query' => $queryParams,
        ]);
        $collection = new Collection(DevResource::class);
        if (empty($body) || ! isset($body['dev_resources'])) {
            return $collection;
        }

        return $collection->create($body['dev_resources']);
    }

    /**
     * @link https://www.figma.com/developers/api#post-dev-resources-endpoint Figma API reference
     * @param Collection<DevResourceCreate> $devResources A collection of dev resources to create
     * @throws GuzzleException
     * @throws JsonException
     */
    public function createDevResources(
        Collection $devResources,
    ): array {
        $bodyParams = [
            'dev_resources' => $devResources->toArray(),
        ];

        $body = $this->client->post("https://api.figma.com/v1/dev_resources", [
            'body' => json_encode($bodyParams, JSON_THROW_ON_ERROR),
        ]);

        if (empty($body)) {
            return [];
        }

        $body['links_created'] = (new Collection(DevResource::class))->create($body['links_created']);
        return $body;
    }

    /**
     * @link https://www.figma.com/developers/api#put-dev-resources-endpoint Figma API reference
     * @param Collection<DevResourceUpdate> $devResources A collection of dev resources to update
     * @throws GuzzleException
     * @throws JsonException
     */
    public function updateDevResources(
        Collection $devResources,
    ): array {
        $bodyParams = [
            'dev_resources' => $devResources->toArray(),
        ];

        $body = $this->client->put("https://api.figma.com/v1/dev_resources", [
            'body' => json_encode($bodyParams, JSON_THROW_ON_ERROR),
        ]);

        if (empty($body)) {
            return [];
        }

        return $body;
    }

    /**
     * @link https://www.figma.com/developers/api#get-dev-resources-endpoint Figma API reference
     * @param string $fileKey File key to delete the dev resource from
     * @param string $devResourceId The dev resource id to delete
     * @throws GuzzleException
     */
    public function deleteDevResource(string $fileKey, string $devResourceId): array
    {
        return $this->client->delete("https://api.figma.com/v1/files/{$fileKey}/dev_resources/{$devResourceId}");
    }
}