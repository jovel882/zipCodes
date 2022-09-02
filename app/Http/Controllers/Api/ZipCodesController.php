<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ZipCode;
use Illuminate\Http\Request;

class ZipCodesController extends Controller
{
    public function getZipCode(string $zipCode, Request $request)
    {
        $dataZipCode = ZipCode::with(['federal_entity:key,name,code,id', 'settlements.settlement_type', 'municipality:key,name,id'])
            ->whereZipCode($zipCode)
            ->select(['zip_code', 'locality', 'federal_entity_id', 'id', 'municipality_id'])
            ->firstOrFail();

        return response()
            ->json(
                [
                    'zip_code' => $dataZipCode->zip_code,
                    'locality' => $dataZipCode->locality,
                    'federal_entity' => [
                        'key' => $dataZipCode->federal_entity->key,
                        'name' => $dataZipCode->federal_entity->name,
                        'code' => $dataZipCode->federal_entity->code,
                    ],
                    'settlements' => $dataZipCode->settlements->map(function ($settlement) {
                        return [
                            'key' => $settlement->key,
                            'name' => $settlement->name,
                            'zone_type' => $settlement->zone_type,
                            'settlement_type' => [
                                'name' => $settlement->settlement_type->name,
                            ],
                        ];
                    }),
                    'municipality' => [
                        'key' => $dataZipCode->municipality->key,
                        'name' => $dataZipCode->municipality->name,
                    ],
                ]
            );
    }
}
