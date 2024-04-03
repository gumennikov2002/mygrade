<?php

namespace App\Data\Service;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class ServiceData extends Data
{
    public function __construct(
        public int $id,
        public int $portfolioId,
        public bool $isActive,
        public string $title,
        public ?string $description,
        public float $price,
        public bool $isFinalPrice,
        public int $sortOrder,
        public ?string $createdAt,
        public ?string $updatedAt
    ) {}
}
