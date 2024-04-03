<?php

namespace App\Data\Link;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class SaveLinkData extends Data
{
    public function __construct(
        public int $portfolioId,
        public bool $isActive,
        public string $label,
        public string $href,
        public int $sortOrder
    ) {}
}
