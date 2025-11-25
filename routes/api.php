<?php

use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\TwinController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:twins')->group(function () {
    Route::post('/v1/conversations/list', [ThirdPartyApiController::class, 'listConversations']);
    Route::post('/v1/conversation/messages', [ThirdPartyApiController::class, 'listConversationMessages']);
    Route::post('/v1/message/send', [ThirdPartyApiController::class, 'sendMessage']);
    Route::post('/v1/message/reply', [ThirdPartyApiController::class, 'sendMessageToUser']);

    //Route::any('/{endpoint}', [ThirdPartyApiController::class, 'proxy'])->where('endpoint', '.+');


});
Route::any('/proxyFBAppTobootPress', [ThirdPartyApiController::class, 'proxyFBAppTobootPress']);


Route::post('/recive_messages', [ThirdPartyApiController::class, 'reciveMessages']);

// Route::get('/recived_messages', [ThirdPartyApiController::class, 'listTempMessages']);

Route::prefix('twins')->group(function () {
    Route::post('files/upload', [TwinController::class, 'uploadFile']);
    Route::post('files/remove', [TwinController::class, 'removeFile']);
    Route::post('train', [TwinController::class, 'train']);
    Route::post('update', [TwinController::class, 'update']);
});

Route::get('latest-orders', [OrderController::class, 'latestOrders']);
Route::get('user-credit/{id}', [OrderController::class, 'userCredit']);

