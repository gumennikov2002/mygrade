<?php

namespace App\Data\Portfolio;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class SavePortfolioData extends Data
{
    public function __construct(
        public bool $isActive,
        public string $slug,
        public string $title,
        public ?string $description,
    ) {}
}
