<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\Optional;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class ProjectData extends Data
{
    public function __construct(
        #[Optional]
        public ?int $id,
        public int $portfolioId,
        public bool $isActive,
        public string $title,
        public ?string $description,
        public int $sortOrder,
        #[Optional]
        public ?string $createdAt,
        #[Optional]
        public ?string $updatedAt
    ) {}
}
