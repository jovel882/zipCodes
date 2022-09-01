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
        DatabaseSeeder::loadData(Municipality::class, 'database/seeders/jsonData/municipalities.json');

        // Municipality::factory()
        //     ->count(50)
        //     ->create();
    }
}
