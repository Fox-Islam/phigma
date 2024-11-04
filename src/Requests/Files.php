<?php

namespace Phox\Phigma\Requests;

use GuzzleHttp\Exception\GuzzleException;
use Phox\Phigma\Client;
use Phox\Phigma\Models\Nodes\File;

readonly class Files
{
    public function __construct(
        private Client $client,
    ) {}

    /**
     * @link https://www.figma.com/developers/api#get-files-endpoint Figma API reference
     * @param string $key
     * @param string|null $version Specific version ID to get. Omitting this will get the current version of the file
     * @param string[]|null $ids List of nodes to fetch. If specified, only a subset of the document will be returned corresponding to the nodes listed, their children, and everything between the root node and the listed nodes
     * @param int|null $depth Depth of document tree to traverse. Omitting this returns all nodes
     * @param string|null $geometry Set to "paths" to export vector data
     * @param string[]|null $pluginData List of plugin IDs and/or the string "shared". Any data present in the document written by those plugins will be included in the result in the `pluginData` and `sharedPluginData` properties
     * @param bool|null $branchData If true, returns branch metadata for the requested file
     * @return File|null
     * @throws GuzzleException
     */
    public function getFile(
        string $key,
        string $version = null,
        array $ids = null,
        int $depth = null,
        string $geometry = null,
        array $pluginData = null,
        bool $branchData = null,
    ): ?File {
        $parameters = [];
        if ($version) {
            $parameters['version'] = $version;
        }
        if ($ids) {
            $parameters['ids'] = implode(',', $ids);
        }
        if ($depth) {
            $parameters['depth'] = $depth;
        }
        if ($geometry) {
            $parameters['geometry'] = $geometry;
        }
        if ($pluginData) {
            $parameters['plugin_data'] = implode(',', $pluginData);
        }
        if ($branchData) {
            $parameters['branch_data'] = $branchData;
        }

        $body = $this->client->get("https://api.figma.com/v1/files/{$key}", [
            'query' => $parameters,
        ]);

        if (empty($body)) {
            return null;
        }

        return File::create($body);
    }
}