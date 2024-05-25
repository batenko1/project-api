<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\ChatController;
use App\Http\Controllers\Admin\EntityController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TemplateController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Api\CancelOrderAction;
use App\Http\Controllers\Api\SuccessOrderAction;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//\Illuminate\Support\Facades\Broadcast::routes();

//\Illuminate\Support\Facades\Broadcast::routes(['middleware' => ['auth:api']]);

Route::get('/', HomeController::class);


Route::get('php-info', function () {
   phpinfo();
});

Route::match(['get', 'post'], 'success', SuccessOrderAction::class);
Route::match(['get', 'post'], 'cancel', CancelOrderAction::class);

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => 'checkUser'
], function () {
    Route::get('/', MainController::class)->name('main');
    Route::post('change-password', [UserController::class, 'changePassword'])->name('change-password');

    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('entities', EntityController::class);
    Route::resource('products', ProductController::class);
    Route::resource('orders', OrderController::class);

    Route::resource('templates', TemplateController::class);

    Route::resource('chat', ChatController::class);

    Route::resource('settings', SettingController::class);
    Route::resource('accounts', AccountController::class);

    Route::resource('pages', PageController::class);


});



Route::match(['get', 'post'],'/login', AuthController::class)->name('login');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');
