<?php

namespace Database\Seeders;

use App\Models\Settlement;
use Illuminate\Database\Seeder;

class SettlementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Settlement::factory()
            ->count(50)
            ->create();
    }
}
