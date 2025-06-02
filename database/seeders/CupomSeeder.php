<?php

namespace Database\Seeders;

use App\Models\Cupom;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CupomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        [$start_date, $end_date] = [Carbon::now()->toDateString(), Carbon::tomorrow()->toDateString()];

        $data = [
            ['start_date' => $start_date, 'end_date' => $end_date, 'minimal_value' => 10.00],
            ['start_date' => $start_date, 'end_date' => $end_date, 'minimal_value' => 50.00],
            ['start_date' => $start_date, 'end_date' => $end_date, 'minimal_value' => 100.00],
            ['start_date' => $start_date, 'end_date' => $end_date, 'minimal_value' => 200.00],
            ['start_date' => $start_date, 'end_date' => $end_date, 'minimal_value' => 300.00],
            ['start_date' => $start_date, 'end_date' => $end_date, 'minimal_value' => 400.00],
            ['start_date' => $start_date, 'end_date' => $end_date, 'minimal_value' => 500.00],
        ];

        foreach($data as $cupom) {
            Cupom::factory()->create($cupom);
        }
    }
}
