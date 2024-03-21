<?php

namespace App\Data\Portfolio;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class PortfolioData extends Data
{
    public function __construct(
        public int $id,
        public bool $isActive,
        public string $slug,
        public string $title,
        public ?string $description,
        public ?string $createdAt,
        public ?string $updatedAt
    ) {}
}
