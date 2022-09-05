<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ZipCode;
use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\Validator;

class ZipCodesController extends Controller
{
    public function getZipCode(string $zipCode): JsonResponse
    {
        if ($resposeError = $this->getErrorsGetZipCode($zipCode)) {
            return $resposeError;
        }

        $dataZipCode = $this->getZipCodeModel($zipCode);
        if ($dataZipCode instanceof JsonResponse) {
            return $dataZipCode;
        }

        return $this->getResponseZipCode($dataZipCode);
    }

    protected function getErrorsGetZipCode(string $zipCode): JsonResponse|bool
    {
        $validator = Validator::make([
            'zipCode' => $zipCode,
        ], [
            'zipCode' => 'required|regex:/^[0-9]{1,5}$/i',
        ]);

        if ($validator->fails()) {
            return response()
                ->json([
                    'message' => trans_choice('validation.errors', count($validator->errors())),
                    'errors' => $validator->errors(),
                ], 422);
        }

        return false;
    }

    protected function getZipCodeModel(string $zipCode): JsonResponse|ZipCode
    {
        if (! $dataZipCode = ZipCode::with(['federal_entity:key,name,code,id', 'settlements.settlement_type', 'municipality:key,name,id'])
            ->whereZipCode($zipCode)
            ->select(['zip_code', 'locality', 'federal_entity_id', 'id', 'municipality_id'])
            ->first()) {
            return response()
                ->json([
                    'message' => __('validation.404'),
                ], 404);
        }

        return $dataZipCode;
    }

    protected function getResponseZipCode(ZipCode $dataZipCode): JsonResponse
    {
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
                ],
                200
            );
    }
}
