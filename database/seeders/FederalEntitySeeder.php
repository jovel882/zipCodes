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
        if (app()->env !== 'testing') {
            DatabaseSeeder::loadData(FederalEntity::class, 'database/seeders/jsonData/federal_entities.json');
        } else {
            FederalEntity::factory()
                ->count(5)
                ->create();
        }
    }
}
