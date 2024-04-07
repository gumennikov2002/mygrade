<?php

namespace App\Data;

use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class ProjectCoverData extends Data
{
    public function __construct(
        public UploadedFile $cover,
    ) {}
}
