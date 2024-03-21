<?php

namespace App\Services;

use App\Contracts\PortfolioService;
use App\Data\Portfolio\SavePortfolioData;
use App\Models\Portfolio;
use App\Models\User;

class AppPortfolioService implements PortfolioService
{

    /**
     * Create a new portfolio.
     *
     * @param User $owner
     * @param SavePortfolioData $data *
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
}
