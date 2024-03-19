<?php

namespace Tests\Feature\Frontend\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_users_can_register(): void
    {
        $response = $this->post(route('register.store'), [
            'name' => fake()->name,
            'email' => fake()->safeEmail,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect();
    }

    public function test_new_user_cant_register_if_email_already_exists(): void
    {
        $email = fake()->safeEmail;
        User::factory()->create(['email' => $email]);
        $response = $this->post(route('register.store'), [
            'name' => fake()->name,
            'email' => $email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertSessionHasErrors();
    }

    public function test_mew_user_cant_register_if_password_does_not_match(): void
    {
        $response = $this->post(route('register.store'), [
            'name' => fake()->name,
            'email' => fake()->safeEmail,
            'password' => 'password',
            'password_confirmation' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors();
    }
}
