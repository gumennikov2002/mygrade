<?php

namespace App\Http\Controllers\Frontend;

use App\Data\Frontend\Auth\RegisterUserData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class RegisterController extends Controller
{
    public function index(): Response
    {
        return inertia('Frontend/Auth/Register');
    }

    public function store(RegisterRequest $request): RedirectResponse
    {
        $user = User::query()->create(
            RegisterUserData::from($request)->toArray()
        );
        auth()->login($user);

        return redirect()->route('homepage');
    }
}
