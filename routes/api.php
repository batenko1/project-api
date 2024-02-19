<?php

use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\EntityController;
use App\Http\Controllers\Api\FilterController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\TemplateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('entities', EntityController::class);

Route::get('filters/types', [FilterController::class, 'types']);
Route::apiResource('filters', FilterController::class);

Route::apiResource('products', ProductController::class);

Route::get('products/get-filters/{entityId}', [ProductController::class, 'getFilters']);

Route::apiResource('orders', OrderController::class);


Route::get('accounts/{id}/orders', [AccountController::class, 'orders']);

Route::apiResource('accounts', AccountController::class);

Route::apiResource('settings', SettingController::class);

Route::apiResource('templates', TemplateController::class);

Route::apiResource('roles', RoleController::class);
