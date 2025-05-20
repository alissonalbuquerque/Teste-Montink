<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cupom>
 */
class CupomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code'          => "PROMO-" . $this->faker->unique()->numberBetween(1, 50),
            'minimal_value' => $this->faker->randomFloat(2, 100, 500),
            'active'        => true,
            'percentage'    => $this->faker->unique()->numberBetween(1, 100)
            
        ];
    }
}
