<?php

namespace App\Traits\Filters\Common;

use Illuminate\Database\Eloquent\Builder;

trait ActiveFilter
{
    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }
}
