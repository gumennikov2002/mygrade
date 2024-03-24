<?php

namespace App\Enums;

use App\Traits\Enums\AsArray;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
enum PortfolioFilter: string
{
    use AsArray;

    case STATUS = 'status';

    case SEARCH = 'search';
}
