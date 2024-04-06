<?php

namespace App\Traits\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait ActiveScope
{
    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }
}
