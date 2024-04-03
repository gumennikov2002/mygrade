<?php

namespace App\Traits\Filters;

use App\Enums\PortfolioStatusFilter;
use App\Traits\Filters\Common\SearchFilter;
use Illuminate\Database\Eloquent\Builder;

trait PortfolioFilters
{
    use SearchFilter;

    public function scopeFilterStatus(Builder $query, PortfolioStatusFilter $status): void
    {
        if ($status === PortfolioStatusFilter::ALL) {
            return;
        }

        $query->where('is_active', $status === PortfolioStatusFilter::ACTIVE);
    }
}
