<?php

use App\Http\Controllers\DiscountCodesController;
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

//No authentication is added around the endpoint due to task scope
Route::post('/discountCodes/create',[DiscountCodesController::Class,'createNewDiscountCodes']);
Route::post('/discountCodes/getCodeForUser/',[DiscountCodesController::Class,'connectCodeToUser']);
