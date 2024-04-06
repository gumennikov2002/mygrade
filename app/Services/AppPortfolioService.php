<?php

namespace App\Services;

use App\Contracts\PortfolioService;
use App\Data\LinkData;
use App\Data\PortfolioData;
use App\Data\ProjectData;
use App\Data\ServiceData;
use App\Enums\PortfolioStatusFilter;
use App\Models\Link;
use App\Models\Portfolio;
use App\Models\Project;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\AbstractPaginator;

class AppPortfolioService implements PortfolioService
{

    /**
     * Create a new portfolio.
     *
     * @param User $user
     * @param PortfolioData $data
     *
     * @return Portfolio
     */
    public function newPortfolio(User $user, PortfolioData $data): Portfolio
    {
        return $user->portfolios()->create($data->toArray());
    }

    /**
     * Update an existing portfolio.
     *
     * @param Portfolio $portfolio
     * @param PortfolioData $data
     *
     * @return Portfolio
     */
    public function updatePortfolio(Portfolio $portfolio, PortfolioData $data): Portfolio
    {
        $portfolio->update($data->toArray());

        return $portfolio->fresh();
    }

    /**
     * Delete an existing portfolio.
     *
     * @param Portfolio $portfolio
     *
     * @return void
     */
    public function deletePortfolio(Portfolio $portfolio): void
    {
        $portfolio->delete();
    }

    /**
     * Get paginated portfolios by owner(user).
     *
     * @param User $user
     * @param int $perPage
     * @param array $filters
     * @param string $orderBy
     * @param string $orderDirection
     *
     * @return AbstractPaginator
     */
    public function getPaginatedByUser(
        User $user,
        int $perPage = 20,
        array $filters = [],
        string $orderBy = 'id',
        string $orderDirection = 'desc'
    ): AbstractPaginator
    {
        $portfolios = $user->portfolios()
            ->when(isset($filters['search']), function (Builder $query) use ($filters) {
                $query->filterSearch($filters['search'], ['title', 'description']);
            })
            ->when(isset($filters['status']), function (Builder $query) use ($filters) {
                $status = PortfolioStatusFilter::from($filters['status']);
                $query->filterStatus($status);
            })
            ->orderBy($orderBy, $orderDirection)
            ->paginate($perPage)
            ->withQueryString();

        return PortfolioData::collect($portfolios);
    }

    /**
     * Create new service
     *
     * @param ServiceData $data
     *
     * @return Service
     */
    public function newService(ServiceData $data): Service
    {
        return Service::query()->create($data->toArray());
    }

    /**
     * Update an existing service
     *
     * @param Service $service
     * @param ServiceData $data
     *
     * @return Service
     */
    public function updateService(Service $service, ServiceData $data): Service
    {
        $service->update($data->toArray());

        return $service->fresh();
    }

    /**
     * Delete service
     *
     * @param Service $service
     *
     * @return void
     */
    public function deleteService(Service $service): void
    {
        $service->delete();
    }

    /**
     * Create new link
     *
     * @param LinkData $data
     *
     * @return Link
     */
    public function newLink(LinkData $data): Link
    {
        return Link::query()->create($data->toArray());
    }

    /**
     * Update an existing link
     *
     * @param Link $link
     * @param LinkData $data
     *
     * @return mixed
     */
    public function updateLink(Link $link, LinkData $data): Link
    {
        $link->update($data->toArray());

        return $link->fresh();
    }

    /**
     * Remove link
     *
     * @param Link $link
     *
     * @return void
     */
    public function deleteLink(Link $link): void
    {
        $link->delete();
    }

    /**
     * Create new project
     *
     * @param ProjectData $data
     *
     * @return Project
     */
    public function newProject(ProjectData $data): Project
    {
        return Project::query()->create($data->toArray());
    }

    /**
     * Update an existing project
     *
     * @param Project $project
     * @param ProjectData $data
     *
     * @return Project
     */
    public function updateProject(Project $project, ProjectData $data): Project
    {
        $project->update($data->toArray());

        return $project->refresh();
    }

    /**
     * Delete project
     *
     * @param Project $project
     *
     * @return void
     */
    public function deleteProject(Project $project): void
    {
        $project->delete();
    }
}
