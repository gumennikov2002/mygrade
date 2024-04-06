<?php

namespace App\Traits\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait SearchFilterScope
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
