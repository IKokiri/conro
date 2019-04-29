<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::prefix('game')->group(function(){
    Route::post('criar/','GameController@store');
    Route::delete('remover/{id}','GameController@destroy');
    Route::post('close','GameController@closeGame');
    Route::post('openGameClosed','GameController@openGameClosed');
});

Route::prefix('gamer')->group(function(){
    Route::post('criar/','GamerController@store');
});

Route::prefix('gameGamer')->group(function(){
    Route::post('criar/','GameGamerController@store');
    Route::post('addScore/','GameGamerController@addScore');
    Route::post('subScore/','GameGamerController@subScore');
    Route::post('createGamerGame/','GameGamerController@createGamerGame');
});

