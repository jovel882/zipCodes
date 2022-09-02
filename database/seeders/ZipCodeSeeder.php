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
        if (app()->env !== 'testing') {
            DatabaseSeeder::loadData(ZipCode::class, 'database/seeders/jsonData/zip_codes.json');
        } else {
            ZipCode::factory()
                ->count(50)
                ->create();
        }

    }
}
