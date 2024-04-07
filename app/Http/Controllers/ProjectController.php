<?php

namespace App\Http\Controllers;

use App\Data\ProjectData;
use App\Models\Project;
use App\Services\PortfolioProjectManagementService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct(
        protected PortfolioProjectManagementService $service
    ) {}

    public function store(Request $request): RedirectResponse
    {
        $project = $this->service->create(
            ProjectData::from($request)
        );

        return redirect()->route('portfolios.edit', [
            'portfolio' => $project->portfolioId
        ]);
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $this->service->update(
            $project,
            ProjectData::from($request)
        );

        return redirect()->route('portfolios.edit', [
            'portfolio' => $project->portfolioId
        ]);
    }

    public function destroy(Project $project): void
    {
        $this->service->delete($project);
    }
}
