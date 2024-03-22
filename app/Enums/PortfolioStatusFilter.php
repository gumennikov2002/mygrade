<?php

namespace App\Enums;

use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
enum PortfolioStatusFilter: string
{
    case ALL = 'all';

    case ACTIVE = 'active';

    case INACTIVE = 'inactive';
}
