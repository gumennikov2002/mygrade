<?php

namespace App\Data\Backend;

use Spatie\LaravelData\Data;

class UpdateUserData extends Data
{
    public function __construct(
        public string $name,
        public string $email,
        public string $username,
        public ?string $password
    ) {}
}
