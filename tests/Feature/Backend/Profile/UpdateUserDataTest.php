<?php

namespace Tests\Feature\Backend\Profile;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UpdateUserDataTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_update_profile(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $update = [
            'name' => fake()->name,
            'username' => fake()->userName,
            'email' => fake()->safeEmail,
            'password' => 'newPassword',
        ];

        $response = $this->put(route('profile.update'), $update);
        $user->fresh();

        $response->assertRedirect();
        $response->assertSessionDoesntHaveErrors();
        $this->assertEquals($update['name'], $user->name);
        $this->assertEquals($update['username'], $user->username);
        $this->assertEquals($update['email'], $user->email);
        $this->assertTrue(Hash::check($update['password'], $user->password));
    }

    public function test_user_cant_use_existing_username(): void
    {
        $username = fake()->userName;
        User::factory()->create(['username' => $username]);
        $user = User::factory()->create();

        $this->actingAs($user);
        $updates = $user->toArray();
        $updates['username'] = $username;
        $response = $this->put(route('profile.update'), $updates);
        $user->fresh();

        $response->assertRedirect();
        $response->assertSessionHasErrors();
        $this->assertNotEquals($username, $user->username);
    }
}
