<?php

namespace App\Services;

use App\Contracts\UserService;
use App\Data\Backend\UpdateUserData;
use App\Data\Frontend\Auth\RegisterUserData;
use App\Models\User;

class WebUserService implements UserService
{

    /**
     * Register a new user.
     *
     * @param RegisterUserData $data
     *
     * @return User
     */
    public function register(RegisterUserData $data): User
    {
        return User::query()->create($data->toArray());
    }

    /**
     * Update an existing user.
     *
     * @param User $user
     * @param UpdateUserData $updates
     *
     * @return User
     */
    public function update(User $user, UpdateUserData $updates): User
    {
        $data = $updates->toArray();

        if ($updates->password) {
            $data['password'] = bcrypt($updates->password);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return $user->fresh();
    }

    /**
     * Delete an existing user.
     *
     * @param User $user
     *
     * @return void
     */
    public function delete(User $user): void
    {
        $user->delete();
    }
}
