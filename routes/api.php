<?php

use App\Http\Controllers\Api\ZipCodesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/zip-codes/{zipCode}', [ZipCodesController::class, 'getZipCode'])
    ->name('api.zip-codes')
    ->where([
        'zipCode' => '^[0-9]{1,5}$',
    ]);
