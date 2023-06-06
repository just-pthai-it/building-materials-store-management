<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InputInvoiceController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductSpecificationController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UnitController;
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

    Route::get('profile', [UserController::class, 'myProfile']);
    Route::patch('profile', [UserController::class, 'updateMyProfile']);

//    Route::get('users/search', [UserController::class, 'search']);
    Route::apiResource('users', UserController::class);

    Route::apiResource('suppliers', SupplierController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('product-types', ProductTypeController::class);
    Route::apiResource('units', UnitController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('products.specifications', ProductSpecificationController::class);
    Route::apiResource('input-invoices', InputInvoiceController::class)->only(['index', 'show', 'store']);
    Route::apiResource('invoices', InvoiceController::class)->only(['index', 'show', 'store']);

    Route::prefix('statistics')->group(function ()
    {
        Route::get('input', [StatisticsController::class, 'input']);
        Route::get('output', [StatisticsController::class, 'output']);
    });
});


