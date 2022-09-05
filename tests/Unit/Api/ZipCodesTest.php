<?php

namespace Tests\Unit\Api;

use App\Http\Controllers\Api\ZipCodesController;
use App\Models\ZipCode;
use Illuminate\Http\JsonResponse;
use Mockery;
use PHPUnit\Framework\TestCase;

class ZipCodesTest extends TestCase
{
    private const SETTLEMENTDATATEST = '{"zip_code":"01210","locality":"CIUDAD DE MEXICO","federal_entity":{"key":9,"name":"CIUDAD DE MEXICO","code":null},"settlements":[{"key":82,"name":"SANTA FE","zone_type":"URBANO","settlement_type":{"name":"Pueblo"}}],"municipality":{"key":3,"name":"ALVARO OBREGON"}}';

    protected $mockZipCodesController;

    public static function tearDownAfterClass(): void
    {
        Mockery::close();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->mockZipCodesController = Mockery::mock(ZipCodesController::class)
            ->makePartial()
            ->shouldAllowMockingProtectedMethods();
    }

    public function testCheckZipCodeAndReceiveErrorValidation()
    {
        $zipCode = '43511R';
        $response = $this->createJsonResponse('{"message":"The following error is generated.","errors":{"zipCode":["The zip code format is invalideted."]}}', 422);
        $this->mockZipCodesController->shouldReceive('getErrorsGetZipCode')
            ->with($zipCode)
            ->once()
            ->andReturn(clone $response);

        $resposneReturn = $this->mockZipCodesController->getZipCode($zipCode);

        $this->assertEquals($resposneReturn->getStatusCode(), $response->getStatusCode());
        $this->assertEquals($resposneReturn->getData(), $response->getData());
    }

    public function testCheckZipCodeAndReceiveNotFound()
    {
        $zipCode = '5555555';
        $response = $this->createJsonResponse('{"message":"Resource not found."}', 404);
        $this->mockZipCodesController->shouldReceive('getErrorsGetZipCode')
            ->with($zipCode)
            ->once()
            ->andReturn(false);
        $this->mockZipCodesController->shouldReceive('getZipCodeModel')
            ->with($zipCode)
            ->once()
            ->andReturn(clone $response);

        $resposneReturn = $this->mockZipCodesController->getZipCode($zipCode);

        $this->assertEquals($resposneReturn->getStatusCode(), $response->getStatusCode());
        $this->assertEquals($resposneReturn->getData(), $response->getData());
    }

    public function testCheckZipCodeAndReceiveCorrectData()
    {
        $zipCodeData = json_decode(self::SETTLEMENTDATATEST, true);
        $zipCodeModel = new ZipCode();
        $response = $this->createJsonResponse($zipCodeData, 200);
        $this->mockZipCodesController->shouldReceive('getErrorsGetZipCode')
            ->with($zipCodeData['zip_code'])
            ->once()
            ->andReturn(false);
        $this->mockZipCodesController->shouldReceive('getZipCodeModel')
            ->with($zipCodeData['zip_code'])
            ->once()
            ->andReturn($zipCodeModel);
        $this->mockZipCodesController->shouldReceive('getResponseZipCode')
            ->with($zipCodeModel)
            ->once()
            ->andReturn($response);

        $resposneReturn = $this->mockZipCodesController->getZipCode($zipCodeData['zip_code']);

        $this->assertEquals($resposneReturn->getStatusCode(), $response->getStatusCode());
        $this->assertEquals($resposneReturn->getData(), $response->getData());
    }

    private function createJsonResponse($data, $status)
    {
        return new JsonResponse($data, $status);
    }
}
