<?php

namespace Phox\Phigma\Requests;

use GuzzleHttp\Exception\GuzzleException;
use Phox\Phigma\Client;
use Phox\Phigma\Models\Nodes\File;
use Phox\Phigma\Models\Project;

readonly class Projects
{
    public function __construct(
        private Client $client,
    ) {}

    /**
     * @link https://www.figma.com/developers/api#get-team-projects-endpoint Figma API reference
     * @param string $id ID of the team to list projects from
     * @throws GuzzleException
     */
    public function getTeamProjects(string $id): ?array
    {
        $body = $this->client->get("https://api.figma.com/v1/teams/{$id}/projects");

        $projects = [];
        foreach ($body['projects'] as $project) {
            $projects[] = Project::create($project);
        }
        $body['projects'] = $projects;

        return $body;
    }

    /**
     * @link https://www.figma.com/developers/api#get-project-files-endpoint Figma API reference
     * @param string $id ID of the project to list files from
     * @param bool|null $branchData Returns branch metadata in the response for each main file with a branch inside the project. Default: false
     * @throws GuzzleException
     */
    public function getProjectFiles(string $id, ?bool $branchData = null): ?array
    {
        $body = $this->client->get("https://api.figma.com/v1/projects/{$id}/files", [
            'query' => [
                'branch_data' => $branchData,
            ]
        ]);
        if (empty($body)) {
            return null;
        }

        $files = [];
        foreach ($body['files'] as $file) {
            $files[] = File::create($file);
        }
        $body['files'] = $files;

        return $body;
    }
}