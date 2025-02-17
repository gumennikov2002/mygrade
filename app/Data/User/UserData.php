<?php

namespace App\Data\User;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;


#[TypeScript]
class UserData extends Data
{
    public function __construct(
        public int $id,
        public string $username,
        public string $email,
        public string $name
    ) {}
}
