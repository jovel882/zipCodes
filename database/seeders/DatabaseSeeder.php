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

    public static function loadData($model, string $file)
    {
        $rowsInsert = [];
        $rowData = [];
        foreach (self::readFile($file) as $line) {
            if (preg_match('/^.*\}.*$/', $line)) {
                if (count($rowsInsert) === 100) {
                    $model::insert($rowsInsert);
                    $rowsInsert = null;
                    unset($rowsInsert);
                    $rowsInsert = [];
                }
                array_push($rowsInsert, $rowData);
                $rowData = null;
                unset($rowData);
                $rowData = [];
            }

            if (preg_match('/^.*\"(.*)\"\:\ \"?([^\"\,\\n]*)(\"\,|\n)?.*$/', $line, $data)) {
                $rowData[$data[1]] = $data[2] === 'null' ? null : $data[2];
            }
        }

        if (count($rowsInsert) > 0) {
            $model::insert($rowsInsert);
            $rowsInsert = null;
            unset($rowsInsert);
        }
    }

    public static function readFile($nameFile)
    {
        $file = fopen($nameFile, 'r');
        while (($line = fgets($file)) !== false) {
            yield $line;
        }
        fclose($file);
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
