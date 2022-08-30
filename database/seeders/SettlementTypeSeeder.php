<?php

namespace Database\Seeders;

use App\Models\SettlementType;
use Illuminate\Database\Seeder;

class SettlementTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        SettlementType::factory()
            ->count(50)
            ->create();
    }
}
