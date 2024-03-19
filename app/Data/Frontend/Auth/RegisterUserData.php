<?php

namespace App\Data\Frontend\Auth;

use App\Models\User;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;

class RegisterUserData extends Data
{
    #[Computed]
    public string $username;

    public function __construct(
        public string $email,
        public string $name,
        public string $password,
    ) {
        $this->username = User::suggestUsername();
    }

}
