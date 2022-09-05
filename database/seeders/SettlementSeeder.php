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
            DatabaseSeeder::loadData(Settlement::class, 'database/seeders/jsonData/settlements' . (! env('USE_ORIGIN_DATA') ? '_Out' : '') . '.json');
        } else {
            Settlement::factory()
                ->count(50)
                ->create();
        }

    }
}
