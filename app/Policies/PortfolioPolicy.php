<?php

namespace App\Policies;

use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PortfolioPolicy
{
    use HandlesAuthorization;

    public function __construct() {}

    public function update(User $user, Portfolio $portfolio): Response
    {
        return $portfolio->checkIfOwner($user)
            ? Response::allow()
            : Response::deny('Нет прав на редактирование портфолио');
    }
}
