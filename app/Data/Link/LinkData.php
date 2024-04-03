<?php

namespace App\Data\Link;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class LinkData extends Data
{
    public function __construct(
        public int $id,
        public int $portfolioId,
        public bool $isActive,
        public string $label,
        public string $href,
        public int $sortOrder,
        public string $updatedAt,
        public string $createdAt
    ) {}
}
