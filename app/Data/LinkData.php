<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\Optional;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class LinkData extends Data
{
    public function __construct(
        #[Optional]
        public ?int $id,
        public int $portfolioId,
        public bool $isActive,
        public string $label,
        public string $href,
        public int $sortOrder,
        #[Optional]
        public ?string $updatedAt,
        #[Optional]
        public ?string $createdAt
    ) {}
}
