<?php

namespace App\Enums;

use App\Traits\Enums\EnumWithUnpackingValues;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
enum PortfolioFilter: string
{
    use EnumWithUnpackingValues;

    case STATUS = 'status';

    case SEARCH = 'search';
}
