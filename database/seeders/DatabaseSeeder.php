<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->truncateTables([
            'federal_entities',
            'municipalities',
            'settlement_types',
            'zip_codes',
            'settlements',
        ]);
        $this->call([
            FederalEntitySeeder::class,
            MunicipalitySeeder::class,
            SettlementTypeSeeder::class,
            ZipCodeSeeder::class,
            SettlementSeeder::class,
        ]);
    }

    /**
     * Trunca todas las tablas enviadas en el array
     * @param array $tables Array con los nombres de las tablas a truncar.
     */
    protected function truncateTables(array $tables)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
