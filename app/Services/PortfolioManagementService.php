<?php

namespace App\Services;

use App\Data\PortfolioData;
use App\Enums\PortfolioStatusFilter;
use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\AbstractPaginator;

class PortfolioManagementService
{

    public function create(User $user, PortfolioData $data): Portfolio
    {
        return $user->portfolios()->create($data->toArray());
    }

    public function update(Portfolio $portfolio, PortfolioData $data): Portfolio
    {
        $portfolio->update($data->toArray());

        return $portfolio->fresh();
    }

    public function delete(Portfolio $portfolio): void
    {
        $portfolio->delete();
    }

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
            ->with(['services', 'projects', 'links'])
            ->orderBy($orderBy, $orderDirection)
            ->paginate($perPage)
            ->withQueryString();

        return PortfolioData::collect($portfolios);
    }
}
