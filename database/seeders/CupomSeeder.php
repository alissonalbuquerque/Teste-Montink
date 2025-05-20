<?php

namespace Database\Seeders;

use App\Models\Cupom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CupomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $data = [
            ['validity_date' => '2025-05-10', 'minimal_value' => 10.00],
            ['validity_date' => '2025-05-20', 'minimal_value' => 50.00],
            ['validity_date' => '2025-05-25', 'minimal_value' => 100.00],
            ['validity_date' => '2025-05-30', 'minimal_value' => 200.00],
            ['validity_date' => '2025-05-30', 'minimal_value' => 300.00],
            ['validity_date' => '2025-05-30', 'minimal_value' => 400.00],
            ['validity_date' => '2025-05-30', 'minimal_value' => 500.00],
        ];

        foreach($data as $cupom) {
            Cupom::factory()->create($cupom);
        }
    }
}
