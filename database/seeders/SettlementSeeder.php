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
        if (app()->env !== 'testing') {
            DatabaseSeeder::loadData(Settlement::class, 'database/seeders/jsonData/settlements.json');
        } else {
            Settlement::factory()
                ->count(50)
                ->create();
        }

    }
}
