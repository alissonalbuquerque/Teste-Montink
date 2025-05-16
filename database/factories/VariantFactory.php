<?php

namespace Database\Factories;

use App\Models\Stock;
use App\Models\Variant;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Variant>
 */
class VariantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   
        return [
            'product_id' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'config' => Json::encode(
                [
                    'size'  => $this->faker->randomElement(['P', 'M', 'G', 'GG']),
                    'color' => $this->faker->randomElement(['red', 'green', 'blue'])
                ]
            ),
            'price'  => $this->faker->randomFloat(2, 100, 500)
        ];
    }

    public function withStock()
    {   
        return $this->afterCreating(function (Variant $variant)
        {    
            Stock::factory()->create([
                'variant_id' => $variant->id,
                'quantity'   => $this->faker->numberBetween(1, 10)
            ]);
            
        });
    }
}
