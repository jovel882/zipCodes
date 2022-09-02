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
        if (app()->env !== 'testing') {
            DatabaseSeeder::loadData(SettlementType::class, 'database/seeders/jsonData/settlement_types.json');
        } else {
            SettlementType::factory()
                ->count(50)
                ->create();
        }

    }
}
