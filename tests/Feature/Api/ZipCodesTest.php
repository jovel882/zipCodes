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

    private const SETTLEMENTDATATEST = '{"zip_code":"01210","locality":"Ciudad de M\u00e9xico","federal_entity":{"key":9,"name":"Ciudad de M\u00e9xico","code":null},"settlements":[{"key":82,"name":"Santa Fe","zone_type":"Urbano","settlement_type":{"name":"Pueblo"}}],"municipality":{"key":3,"name":"\u00c1lvaro Obreg\u00f3n"}}';

    protected $settlementModelTest = false;

    public function testCanGetZipCode()
    {
        $this->getSettlementTest();

        $json = json_decode(self::SETTLEMENTDATATEST, true);

        $response = $this->getJson(route('api.zip-codes', [
            'zipCode' => $json['zip_code'],
        ]));

        $response
            ->assertStatus(200)
            ->assertExactJson($json);
    }

    private function getSettlementTest()
    {
        if (! $this->settlementModelTest) {
            $json = json_decode(self::SETTLEMENTDATATEST, true);

            $this->settlementModelTest = Settlement::create([
                'key' => $json['settlements'][0]['key'],
                'name' => $json['settlements'][0]['name'],
                'zone_type' => $json['settlements'][0]['zone_type'],
                'zip_code_id' => ZipCode::create([
                    'zip_code' => $json['zip_code'],
                    'locality' => $json['locality'],
                    'federal_entity_id' => FederalEntity::create($json['federal_entity'])->id,
                    'municipality_id' => Municipality::create($json['municipality'])->id,
                ])->id,
                'settlement_type_id' => SettlementType::create($json['settlements'][0]['settlement_type'])->id,
            ]);
        }

        return $this->settlementModelTest;
    }
}
