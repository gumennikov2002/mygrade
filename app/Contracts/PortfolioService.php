<?php

namespace App\Contracts;

use App\Data\LinkData;
use App\Data\PortfolioData;
use App\Data\ProjectData;
use App\Data\ServiceData;
use App\Models\Link;
use App\Models\Portfolio;
use App\Models\Project;
use App\Models\Service;
use App\Models\User;
use Illuminate\Pagination\AbstractPaginator;

interface PortfolioService
{
    /**
     * Create a new portfolio.
     *
     * @param User $user
     * @param PortfolioData $data
     *
     * @return Portfolio
     */
    public function newPortfolio(User $user, PortfolioData $data): Portfolio;

    /**
     * Update an existing portfolio.
     *
     * @param Portfolio $portfolio
     * @param PortfolioData $data
     *
     * @return Portfolio
     */
    public function updatePortfolio(Portfolio $portfolio, PortfolioData $data): Portfolio;

    /**
     * Delete an existing portfolio.
     *
     * @param Portfolio $portfolio
     *
     * @return void
     */
    public function deletePortfolio(Portfolio $portfolio): void;

    /**
     * Get paginated portfolios by owner(user).
     *
     * @param User $user
     * @param int $perPage
     * @param array<string, mixed> $filters
     * @param string $orderBy
     * @param string $orderDirection
     *
     * @return AbstractPaginator<Portfolio>
     */
    public function getPaginatedByUser(User $user, int $perPage = 20, array $filters = [], string $orderBy = 'id', string $orderDirection = 'desc'): AbstractPaginator;

    /**
     * Create new service
     *
     * @param ServiceData $data
     *
     * @return Service
     */
    public function newService(ServiceData $data): Service;

    /**
     * Update an existing service
     *
     * @param Service $service
     * @param ServiceData $data
     *
     * @return Service
     */
    public function updateService(Service $service, ServiceData $data): Service;

    /**
     * Delete service
     *
     * @param Service $service
     *
     * @return void
     */
    public function deleteService(Service $service): void;

    /**
     * Create new link
     *
     * @param LinkData $data
     *
     * @return Link
     */
    public function newLink(LinkData $data): Link;

    /**
     * Update an existing link
     *
     * @param Link $link
     * @param LinkData $data
     *
     * @return mixed
     */
    public function updateLink(Link $link, LinkData $data): Link;

    /**
     * Remove link
     *
     * @param Link $link
     *
     * @return void
     */
    public function deleteLink(Link $link): void;

    /**
     * Create new project
     *
     * @param ProjectData $data
     *
     * @return Project
     */
    public function newProject(ProjectData $data): Project;

    /**
     * Update an existing project
     *
     * @param Project $project
     * @param ProjectData $data
     *
     * @return Project
     */
    public function updateProject(Project $project, ProjectData $data): Project;

    /**
     * Delete project
     *
     * @param Project $project
     *
     * @return void
     */
    public function deleteProject(Project $project): void;
}
