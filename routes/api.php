<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\InputInvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductSpecificationController;
use App\Http\Controllers\UserController;
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

Route::post('login', [AuthenticationController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function ()
{
    Route::post('refresh-token', [AuthenticationController::class, 'refreshToken']);

    Route::get('me', [UserController::class, 'me']);

    Route::apiResource('products', ProductController::class);
    Route::apiResource('products.specifications', ProductSpecificationController::class);
    Route::apiResource('input-invoices', InputInvoiceController::class)->only(['index', 'show', 'store']);
});


