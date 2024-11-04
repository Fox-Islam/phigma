<?php

namespace Phox\Phigma\Requests;

use GuzzleHttp\Exception\GuzzleException;
use Phox\Phigma\Client;
use Phox\Phigma\Models\Collection;
use Phox\Phigma\Models\Projects\File;
use Phox\Phigma\Models\Projects\Project;

readonly class Projects
{
    public function __construct(
        private Client $client,
    ) {}

    /**
     * @link https://www.figma.com/developers/api#get-team-projects-endpoint Figma API reference
     * @param string $id ID of the team to list projects from
     * @return Collection<Project>
     * @throws GuzzleException
     */
    public function getTeamProjects(string $id): Collection
    {
        $body = $this->client->get("https://api.figma.com/v1/teams/{$id}/projects");
        $collection = new Collection(Project::class);
        if (empty($body) || ! isset($body['projects'])) {
            return $collection;
        }

        return $collection->createItemsFromArray($body['projects']);
    }

    /**
     * @link https://www.figma.com/developers/api#get-project-files-endpoint Figma API reference
     * @param string $id ID of the project to list files from
     * @param bool|null $branchData Returns branch metadata in the response for each main file with a branch inside the project. Default: false
     * @return Collection<File>
     * @throws GuzzleException
     */
    public function getProjectFiles(string $id, ?bool $branchData = null): Collection
    {
        $body = $this->client->get("https://api.figma.com/v1/projects/{$id}/files", [
            'query' => [
                'branch_data' => $branchData,
            ]
        ]);
        $collection = new Collection(File::class);
        if (empty($body) || ! isset($body['files'])) {
            return $collection;
        }

        return $collection->createItemsFromArray($body['files']);
    }
}