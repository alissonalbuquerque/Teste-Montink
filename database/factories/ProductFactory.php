<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Stock;
use App\Models\Variant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word
        ];
    }

    public function withVariants(int $count = 3)
    {
        return $this->afterCreating(function (Product $product) use ($count)
        {   
            $loop_list = range(1, $count);

            foreach($loop_list as $item_list) {
                Variant::factory()->withStock()->create([
                    'product_id' => $product->id
                ]);
            }
        });
    }

    public function withStock()
    {   
        return $this->afterCreating(function (Product $product)
        {
            $variants = $product->variants;

            foreach($variants as $variant) {
                Stock::factory()->create([
                    'variant_id' => $variant->id,
                    'quantity'   => $this->faker->numberBetween(1, 10)
                ]);
            }
        });
    }
}
