<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\Optional;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class PortfolioData extends Data
{
    public function __construct(
        #[Optional]
        public int $id,
        public bool $isActive,
        public string $slug,
        public string $title,
        public string $aboutMe,
        public ?string $description,
        #[Optional]
        public ?string $createdAt,
        #[Optional]
        public ?string $updatedAt
    ) {}
}
