<?php

namespace App\Data\Backend\Portfolio;

use Spatie\LaravelData\Data;

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
