<?php

use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\EntityController;
use App\Http\Controllers\Api\FilterController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\TemplateController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Passport;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware('auth:sanctum')->get('/user', [UserController::class , 'getUser']);


Route::get('/user', [UserController::class, 'getUser'])->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);

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

Route::apiResource('users', UserController::class);

Route::apiResource('permissions', PermissionController::class);

Route::apiResource('chats', ChatController::class);
