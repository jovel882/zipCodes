<?php

namespace Database\Seeders;

use App\Models\Municipality;
use Illuminate\Database\Seeder;

class MunicipalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        if (app()->env !== 'testing') {
            DatabaseSeeder::loadData(Municipality::class, 'database/seeders/jsonData/municipalities.json');
        } else {
            Municipality::factory()
                ->count(50)
                ->create();
        }

    }
}
