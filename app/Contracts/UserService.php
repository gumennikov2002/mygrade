<?php

namespace App\Contracts;

use App\Data\Backend\UpdateUserData;
use App\Data\Frontend\Auth\RegisterUserData;
use App\Models\User;

interface UserService
{
    /**
     * Register a new user.
     *
     * @param RegisterUserData $data
     *
     * @return User
     */
    public function register(RegisterUserData $data): User;

    /**
     * Update an existing user.
     *
     * @param User $user
     * @param UpdateUserData $updates
     *
     * @return User
     */
    public function update(User $user, UpdateUserData $updates): User;

    /**
     * Delete an existing user.
     *
     * @param User $user
     *
     * @return void
     */
    public function delete(User $user): void;
}
