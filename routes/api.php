<?php

use App\Http\Controllers\ThirdPartyApiController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('apirequest')->group(function () {
    Route::get('/{endpoint}', [ThirdPartyApiController::class, 'proxy'])->where('endpoint', '.+');
});