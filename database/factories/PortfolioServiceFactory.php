<?php

namespace Database\Factories;

use App\Models\Portfolio;
use App\Models\PortfolioService;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PortfolioService>
 */
class PortfolioServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create();

        return [
            'portfolio_id' => Portfolio::factory()
                ->create(['user_id' => $user->id])
                ->id,
            'service_id' => Service::factory()
                ->create(['user_id' => $user->id])
                ->id,
            'price' => fake()->randomFloat(2, 0, 1000),
            'is_start_price' => fake()->boolean,
        ];
    }
}
