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

    /**
     * @link https://www.figma.com/developers/api#get-images-endpoint Figma API reference
     * @param string $key
     * @param string[] $ids List of nodes to render
     * @param float|null $scale The image scaling factor betwen between 0.01 and 4
     * @param string|null $format The image format (jpg, png, svg, or pdf)
     * @param string|null $version Specific version ID to get. Omitting this will get the current version of the file
     * @param bool|null $svgOutlineText If true, text elements are rendered as outlines or <text> elements
     * @param bool|null $svgIncludeId If true, includes id attributes for all SVG elements, adds the layer name to the id attribute of an svg element
     * @param bool|null $svgIncludeNodeId If true, includes node id attributes for all SVG elements, adds the node id to a data-node-id attribute of an svg element
     * @param bool|null $svgSimplifyStroke If true, simplifies inside/outside strokes and uses stroke attribute if possible instead of <mask>
     * @param bool|null $contentsOnly If true, content that overlaps the node will be excluded from rendering
     * @param bool|null $useAbsoluteBounds If true, uses the full dimensions of the node regardless of whether or not it is cropped or the space around it is empty
     * @return array|null
     * @throws GuzzleException
     */
    public function getImage(
        string $key,
        array $ids,
        float $scale = null,
        string $format = null,
        string $version = null,
        bool $svgOutlineText = null,
        bool $svgIncludeId = null,
        bool $svgIncludeNodeId = null,
        bool $svgSimplifyStroke = null,
        bool $contentsOnly = null,
        bool $useAbsoluteBounds = null,
    ): ?array {
        $parameters = [
            'ids' => implode(',', $ids),
        ];

        if ($scale) {
            $parameters['scale'] = $scale;
        }
        if ($format) {
            $parameters['format'] = $format;
        }
        if ($version) {
            $parameters['version'] = $version;
        }
        if ($svgOutlineText) {
            $parameters['svg_outline_text'] = $svgOutlineText;
        }
        if ($svgIncludeId) {
            $parameters['svg_include_id'] = $svgIncludeId;
        }
        if ($svgIncludeNodeId) {
            $parameters['svg_include_node_id'] = $svgIncludeNodeId;
        }
        if ($svgSimplifyStroke) {
            $parameters['svg_simplify_stroke'] = $svgSimplifyStroke;
        }
        if ($contentsOnly) {
            $parameters['contents_only'] = $contentsOnly;
        }
        if ($useAbsoluteBounds) {
            $parameters['use_absolute_bounds'] = $useAbsoluteBounds;
        }

        $body = $this->client->get("https://api.figma.com/v1/images/{$key}", [
            'query' => $parameters,
        ]);

        if (empty($body)) {
            return null;
        }

        return $body;
    }
}