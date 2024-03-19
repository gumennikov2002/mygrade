<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\UserService;
use App\Data\Frontend\Auth\RegisterUserData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Auth\RegisterRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class RegisterController extends Controller
{
    public function index(): Response
    {
        return inertia('Frontend/Auth/Register');
    }

    public function store(RegisterRequest $request, UserService $userService): RedirectResponse
    {
        $user = $userService->register(
            RegisterUserData::from($request)
        );
        auth()->login($user);

        return redirect()->route('homepage');
    }
}
