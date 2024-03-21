<?php

namespace App\Data\Backend\Portfolio;

use Spatie\LaravelData\Data;

class SavePortfolioData extends Data
{
    public function __construct(
        public bool $isActive,
        public string $slug,
        public string $title,
        public ?string $description,
    ) {}
}
