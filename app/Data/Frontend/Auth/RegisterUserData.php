<?php

namespace App\Data\Frontend\Auth;

use Spatie\LaravelData\Data;

class RegisterUserData extends Data
{
    public function __construct(
        public string $email,
        public string $name,
        public string $password,
    ) {}

}
