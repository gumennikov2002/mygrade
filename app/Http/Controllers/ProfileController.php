<?php

namespace App\Http\Controllers;

use App\Contracts\UserService;
use App\Data\User\UpdateUserData;
use App\Http\Requests\Profile\UpdateUserRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class ProfileController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {}

    public function index(): Response
    {
        return inertia('Profile');
    }

    public function update(UpdateUserRequest $request): RedirectResponse
    {
        $this->userService->update(
            $request->user(),
            UpdateUserData::from($request)
        );

        return redirect()->back();
    }
}
