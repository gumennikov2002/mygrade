<?php

namespace App\Services;

use App\Data\ProjectCoverData;
use App\Data\ProjectData;
use App\Models\Project;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class PortfolioProjectManagementService
{
    public function create(ProjectData $data): Project
    {
        $project = Project::query()->create(
            $data->toArray()
        );

        if ($data->cover) {
            $project->addMediaFromRequest('cover')->toMediaCollection('cover');
        }

        return $project;
    }

    public function update(Project $project, ProjectData $data): Project
    {
        $project->update($data->toArray());

        return $project->refresh();
    }

    /**
     * @throws FileIsTooBig
     * @throws FileDoesNotExist
     */
    public function updateCover(Project $project, ProjectCoverData $data): void
    {
        $project->clearMediaCollection('cover');
        $project->addMediaFromRequest('cover')->toMediaCollection('cover');
    }

    public function delete(Project $project): void
    {
        $project->delete();
    }
}
