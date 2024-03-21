<?php

namespace App\Data\Auth;

use App\Models\User;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\Optional;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class RegisterUserData extends Data
{
    #[Computed]
    #[Optional]
    public string $username;

    public function __construct(
        public string $email,
        public string $name,
        public string $password,
        public string $password_confirmation
    ) {
        $this->username = User::suggestUsername();
    }

}
