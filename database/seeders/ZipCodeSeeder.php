<?php

namespace Database\Seeders;

use App\Models\ZipCode;
use Illuminate\Database\Seeder;

class ZipCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DatabaseSeeder::loadData(ZipCode::class, 'database/seeders/jsonData/zip_codes.json');

        // ZipCode::factory()
        //     ->count(50)
        //     ->create();
    }
}
