<?php

namespace App\Traits\Filters;

use App\Traits\Filters\Common\ActiveFilter;
use App\Traits\Filters\Common\SearchFilter;

trait LinkFilters
{
    use SearchFilter, ActiveFilter;
}
