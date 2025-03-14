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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('institution-product-info',[\App\Http\Controllers\InstitutionInformationApi::class,'getInstitution'])->name('institution-info');
Route::post('bank_funds_transfer_request',[\App\Http\Controllers\InstitutionInformationApi::class,'internalBankTransfer'])->name('institution-request');
//Route::get('bank_funds_transfer_request', function (){
//    return 123;
//});


