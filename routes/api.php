<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\HamburgerMenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\QbItemController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\UccJurisdictionMapController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resources([
    'users' => UserController::class,
    'subscriptions' => SubscriptionController::class,
    'qb_items' => QbItemController::class,
    'surveys' => SurveyController::class,
    'contacts' => ContactController::class,
    'companies' => CompanyController::class,
    // 'orders' => OrderController::class,
]);

Route::resource('entities', EntityController::class)->except([
    'store',
]);

Route::resource('orders', OrderController::class)->except([
    'update',
]);

Route::post('/subscriptions/{id}', [SubscriptionController::class, 'store'])->name('subscriptions.store');

Route::get('/roles/reports', [RoleController::class, 'reports'])->name('roles.reports');
Route::get('/roles/hamburger', [RoleController::class, 'hamburger'])->name('roles.hamburger');

Route::get('/rolesSelect/{id}', [RoleController::class, 'rolesSelect']);
Route::get('/rolesNotSelect/{id}', [RoleController::class, 'rolesNotSelect']);

Route::get('/reportsSelect/{id}', [RoleController::class, 'reportsSelect']);
Route::get('/reportsNotSelect/{id}', [RoleController::class, 'reportsNotSelect']);

Route::put('/companies/company_info/{id}', [CompanyController::class, 'company_info']);
Route::put('/companies/contact/{id}', [CompanyController::class, 'contact']);
Route::put('/companies/locations/{id}', [CompanyController::class, 'locations']);
Route::get('/surveys_paginate/{paginate}', [SurveyController::class, 'refresh']);

// Route::get('/my_reports', [RoleController::class, 'my_reports']);

Route::get('/orders/status/new', [OrderController::class, 'new_orders']);
// Route::get('/orders/{id}/edit', [OrderController::class, 'edit']);
Route::get('/orders/status/new/new_orders_entities_count/{id}', [OrderController::class, 'new_orders_entities_count']);
Route::get('/hamburger_menu/si_alerts', [HamburgerMenuController::class, 'si_alerts']);
Route::get('/hamburger_menu/scans', [HamburgerMenuController::class, 'scans']);
Route::get('/hamburger_menu/ucc', [UccJurisdictionMapController::class, 'index']);
Route::post('/hamburger_menu/ucc/{id}', [UccJurisdictionMapController::class, 'store']);

// Route::get('/instant_messages/{id}', [InstantMessageController::class, 'index']);

Route::get('/orders_max', [OrderController::class, 'ordermax']);
Route::get('/entity_copy', [EntityController::class, 'entity_copy']);

Route::post('/entities/{id}/pdf', [EntityController::class, 'pdf']);
