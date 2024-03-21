<?php

namespace App\Data\User;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class UpdateUserData extends Data
{
    public function __construct(
        public string $name,
        public string $email,
        public string $username,
        public ?string $password
    ) {}
}
