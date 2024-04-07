<?php

namespace App\Data;

use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Attributes\WithoutValidation;
use Spatie\LaravelData\Data;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
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
        #[Optional]
        #[WithoutValidation]
        public null|string|UploadedFile $cover,
        #[Optional]
        /* @var Media[] */
        public ?array $media,
        public int $sortOrder,
        #[Optional]
        public ?string $createdAt,
        #[Optional]
        public ?string $updatedAt
    ) {}
}
