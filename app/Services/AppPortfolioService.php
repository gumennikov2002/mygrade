<?php

namespace App\Services;

use App\Contracts\PortfolioService;
use App\Data\Portfolio\PortfolioData;
use App\Data\Portfolio\SavePortfolioData;
use App\Enums\PortfolioStatusFilter;
use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\AbstractPaginator;

class AppPortfolioService implements PortfolioService
{

    /**
     * Create a new portfolio.
     *
     * @param User $owner
     * @param SavePortfolioData $data
     *
     * @return Portfolio
     */
    public function create(User $owner, SavePortfolioData $data): Portfolio
    {
        return $owner->portfolios()
            ->create($data->toArray());
    }

    /**
     * Update an existing portfolio.
     *
     * @param Portfolio $portfolio
     * @param SavePortfolioData $data
     *
     * @return Portfolio
     */
    public function update(Portfolio $portfolio, SavePortfolioData $data): Portfolio
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
    public function delete(Portfolio $portfolio): void
    {
        $portfolio->delete();
    }

    /**
     * Get paginated portfolios by owner(user).
     *
     * @param User $owner
     * @param int $perPage
     * @param array $filters
     * @param string $orderBy
     * @param string $orderDirection
     *
     * @return AbstractPaginator
     */
    public function getPaginatedByUser(
        User $owner,
        int $perPage = 20,
        array $filters = [],
        string $orderBy = 'id',
        string $orderDirection = 'desc'
    ): AbstractPaginator
    {
        $portfolios = $owner->portfolios()
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
}
