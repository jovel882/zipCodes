<?php

namespace Tests\Feature\Api;

use App\Models\FederalEntity;
use App\Models\Municipality;
use App\Models\Settlement;
use App\Models\SettlementType;
use App\Models\ZipCode;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ZipCodesTest extends TestCase
{
    use RefreshDatabase;

    private const SETTLEMENTDATATEST = '{"zip_code":"01210","locality":"CIUDAD DE MEXICO","federal_entity":{"key":9,"name":"CIUDAD DE MEXICO","code":null},"settlements":[{"key":82,"name":"SANTA FE","zone_type":"URBANO","settlement_type":{"name":"Pueblo"}}],"municipality":{"key":3,"name":"ALVARO OBREGON"}}';

    protected $settlementModelTest = false;

    private $settlementDataTest;

    protected function setUp(): void
    {
        parent::setUp();

        $this->settlementDataTest = json_decode(self::SETTLEMENTDATATEST, true);
    }

    public function testCanGetZipCode()
    {
        $this->getSettlementTest();

        $response = $this->getJson(route('api.zip-codes', [
            'zipCode' => $this->settlementDataTest['zip_code'],
        ]));

        $response
            ->assertStatus(200)
            ->assertExactJson($this->settlementDataTest);
    }

    private function getSettlementTest()
    {
        if (! $this->settlementModelTest) {
            $this->settlementModelTest = Settlement::create([
                'key' => $this->settlementDataTest['settlements'][0]['key'],
                'name' => $this->settlementDataTest['settlements'][0]['name'],
                'zone_type' => $this->settlementDataTest['settlements'][0]['zone_type'],
                'zip_code_id' => ZipCode::create([
                    'zip_code' => $this->settlementDataTest['zip_code'],
                    'locality' => $this->settlementDataTest['locality'],
                    'federal_entity_id' => FederalEntity::create($this->settlementDataTest['federal_entity'])->id,
                    'municipality_id' => Municipality::create($this->settlementDataTest['municipality'])->id,
                ])->id,
                'settlement_type_id' => SettlementType::create($this->settlementDataTest['settlements'][0]['settlement_type'])->id,
            ]);
        }

        return $this->settlementModelTest;
    }
}
