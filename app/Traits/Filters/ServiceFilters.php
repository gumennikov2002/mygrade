<?php

namespace App\Traits\Filters;

use App\Traits\Filters\Common\ActiveFilter;
use App\Traits\Filters\Common\SearchFilter;

trait ServiceFilters
{
    use SearchFilter, ActiveFilter;
}
