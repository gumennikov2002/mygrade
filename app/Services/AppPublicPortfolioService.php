<?php

namespace App\Services;

use App\Contracts\PublicPortfolioService;
use App\Enums\PortfolioStatusFilter;
use App\Models\Portfolio;
use App\Models\User;

class AppPublicPortfolioService implements PublicPortfolioService
{

    /**
     * Get portfolio by user and slug
     *
     * @param User $owner
     * @param string $slug
     *
     * @return Portfolio|null
     */
    public function get(User $owner, string $slug): ?Portfolio
    {
        return $owner->portfolios()
            ->filterStatus(PortfolioStatusFilter::ACTIVE)
            ->firstWhere('slug', $slug);
    }
}
