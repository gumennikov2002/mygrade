<?php

namespace App\Http\Controllers;

use App\Data\ProjectCoverData;
use App\Data\ProjectData;
use App\Models\Portfolio;
use App\Models\Project;
use App\Services\PortfolioProjectManagementService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response as InertiaResponse;
use Spatie\LaravelData\Exceptions\InvalidDataClass;

class ProjectController extends Controller
{
    public function __construct(
        protected PortfolioProjectManagementService $service
    ) {}

    /**
     * @throws InvalidDataClass
     */
    public function create(Portfolio $portfolio): InertiaResponse
    {
        return inertia('Project/ProjectItem', [
            'portfolio' => $portfolio->getData(),
        ]);
    }

    public function store(Portfolio $portfolio, Request $request): RedirectResponse
    {
        $project = $this->service->create(
            ProjectData::from($request)
        );

        return redirect()->route('portfolios.edit', [
            'portfolio' => $project->portfolioId
        ]);
    }

    /**
     * @throws InvalidDataClass
     */
    public function edit(Portfolio $portfolio, Project $project): InertiaResponse
    {
        return inertia('Project/ProjectItem', [
            'portfolio' => $portfolio->getData(),
            'project'   => $project->getData(),
        ]);
    }

    public function update(Request $request, Portfolio $portfolio, Project $project): RedirectResponse
    {
        $this->service->update(
            $project,
            ProjectData::from($request)
        );

        return redirect()->route('portfolios.edit', [
            'portfolio' => $project->portfolioId
        ]);
    }

    public function updateCover(Request $request, Portfolio $portfolio, Project $project): RedirectResponse
    {
        $this->service->updateCover(
            $project,
            ProjectCoverData::from($request)
        );

        return redirect()->route('portfolios.edit', [
            'portfolio' => $project->portfolioId
        ]);
    }

    public function destroy(Portfolio $portfolio, Project $project): void
    {
        $this->service->delete($project);
    }
}
