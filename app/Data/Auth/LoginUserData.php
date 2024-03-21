<?php

namespace App\Data\Auth;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class LoginUserData extends Data
{
    public function __construct(
        public string $email,
        public string $password
    ) {}
}
