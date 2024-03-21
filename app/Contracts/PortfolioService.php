<?php

namespace App\Contracts;

use App\Data\Portfolio\SavePortfolioData;
use App\Models\Portfolio;
use App\Models\User;

interface PortfolioService
{
    /**
     * Create a new portfolio.
     *
     * @param User $owner
     * @param SavePortfolioData $data
     *
     * @return Portfolio
     */
    public function create(User $owner, SavePortfolioData $data): Portfolio;

    /**
     * Update an existing portfolio.
     *
     * @param Portfolio $portfolio
     * @param SavePortfolioData $data
     *
     * @return Portfolio
     */
    public function update(Portfolio $portfolio, SavePortfolioData $data): Portfolio;

    /**
     * Delete an existing portfolio.
     *
     * @param Portfolio $portfolio
     *
     * @return void
     */
    public function delete(Portfolio $portfolio): void;
}
