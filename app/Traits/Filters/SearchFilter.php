<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait SearchFilter
{
    public function scopeFilterSearch(Builder $query, string $search, array $columns): void
    {
        $query->where(function (Builder $query) use ($search, $columns) {
            foreach ($columns as $column) {
                $query->orWhere($column, 'like', "%{$search}%");
            }
        });
    }
}
