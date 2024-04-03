<?php

namespace App\Contracts;

use App\Models\Portfolio;
use App\Models\User;

interface PublicPortfolioService
{
    /**
     * Get portfolio by user and slug
     *
     * @param User $owner
     * @param string $slug
     *
     * @return Portfolio|null
     */
    public function get(User $owner, string $slug): ?Portfolio;
}
