<?php

namespace Database\Factories;

use App\Models\Link;
use App\Models\Portfolio;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Link>
 */
class LinkFactory extends Factory
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
            'label' => $this->faker->sentence(),
            'href' => $this->faker->url,
            'sort_order' => 1,
        ];
    }
}
