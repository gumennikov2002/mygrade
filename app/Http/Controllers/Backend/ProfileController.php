<?php

namespace App\Http\Controllers\Backend;

use App\Data\Backend\UpdateUserData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Profile\UpdateUserRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class ProfileController extends Controller
{
    public function index(): Response
    {
        return inertia('Backend/Profile');
    }

    public function update(UpdateUserRequest $request): RedirectResponse
    {
        $user = auth()->user();
        $data = UpdateUserData::from($request)
            ->toArray();

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->get('password'));
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->back();
    }
}
