<?php

use App\Http\Controllers\Api\{
    IndicadoresController,
    FakeCardsController,
};
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

//Colocando as rotas dentro da controller para organizar o código
IndicadoresController::routes();

Route::prefix('fake')->group(function () {
    FakeCardsController::routes();
});
