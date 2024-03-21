<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\UserService;
use App\Data\Auth\RegisterUserData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class RegisterController extends Controller
{
    public function index(): Response
    {
        return inertia('Auth/Register');
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
