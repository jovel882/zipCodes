<?php

namespace Database\Seeders;

use App\Models\FederalEntity;
use Illuminate\Database\Seeder;

class FederalEntitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DatabaseSeeder::loadData(FederalEntity::class, 'database/seeders/jsonData/federal_entities.json');

        // FederalEntity::factory()
        //     ->count(50)
        //     ->create();
    }
}
