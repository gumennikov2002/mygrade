<?php

namespace App\Http\Controllers;

use App\Contracts\PortfolioService;
use App\Data\ProjectData;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct(
        protected PortfolioService $service
    ) {}

    public function store(Request $request): RedirectResponse
    {
        $project = $this->service->newProject(
            ProjectData::from($request)
        );

        return redirect()->route('portfolios.edit', [
            'portfolio' => $project->portfolioId
        ]);
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $this->service->updateProject(
            $project,
            ProjectData::from($request)
        );

        return redirect()->route('portfolios.edit', [
            'portfolio' => $project->portfolioId
        ]);
    }

    public function destroy(Project $project): void
    {
        $this->service->deleteProject($project);
    }
}
