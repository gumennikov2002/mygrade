<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\UserService;
use App\Data\Backend\UpdateUserData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Profile\UpdateUserRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class ProfileController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {}

    public function index(): Response
    {
        return inertia('Backend/Profile');
    }

    public function update(UpdateUserRequest $request): RedirectResponse
    {
        $this->userService->update(
            auth()->user(),
            UpdateUserData::from($request)
        );

        return redirect()->back();
    }
}
