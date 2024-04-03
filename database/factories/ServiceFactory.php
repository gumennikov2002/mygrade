<?php

namespace Database\Factories;

use App\Models\Portfolio;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'portfolio_id' => Portfolio::factory()->create()->id,
            'title' => $this->faker->sentence(),
            'price' => rand(0, 100000),
            'is_final_price' => rand(0, 1),
            'description' => $this->faker->paragraph(),
            'sort_order' => 1,
        ];
    }
}
