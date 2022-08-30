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
        FederalEntity::factory()
            ->count(50)
            ->create();
    }
}
