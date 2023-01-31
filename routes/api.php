<?php

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::apiResource('/company', \App\Http\Controllers\CompanyController::class);
Route::apiResource('/provider', \App\Http\Controllers\ProviderController::class)->except(['show']);
Route::get('/states', [\App\Http\Controllers\StateController::class,'index']);