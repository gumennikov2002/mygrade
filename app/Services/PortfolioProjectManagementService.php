<?php

namespace App\Services;

use App\Data\ProjectData;
use App\Models\Project;

class PortfolioProjectManagementService
{
    public function create(ProjectData $data): Project
    {
        $project = Project::query()->create(
            $data->toArray()
        );

        $project->addMediaFromRequest('cover')->toMediaCollection('cover');

        return $project;
    }

    public function update(Project $project, ProjectData $data): Project
    {
        $project->update($data->toArray());

        return $project->refresh();
    }

    public function delete(Project $project): void
    {
        $project->delete();
    }
}
