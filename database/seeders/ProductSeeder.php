<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $names = [
            'Blusa de Lã',
            'Calça Jeans',
            'Vestido Casual',
            'Camiseta Básica',
            'Jaqueta Corta-Vento',
        ];

        foreach($names as $name) {
            Product::factory()
                   ->withVariants()
                   ->withStock()
                   ->create(['name' => $name]);
        }
    }
}
