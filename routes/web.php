<?php

use App\Http\Controllers\AccountingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\HamburgerMenuController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\InstantMessageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
/********************************************** Commentaires **********************************************/

/********************************************** Ressources Route **********************************************/

Auth::routes();

/********************************************** index Of Online Doctor **********************************************/

Route::get('/home', [IndexController::class, 'index1']);

Route::get('/', [IndexController::class, 'index']);
Route::get('/services', [IndexController::class, 'services']);
Route::get('/industries', [IndexController::class, 'industries']);
Route::get('/about_od', [IndexController::class, 'about_od']);
Route::get('/privacy', [IndexController::class, 'privacy']);

Route::get('/services/business-entity', [IndexController::class, 'business_entity']);
Route::get('/services/ucc-nationwide', [IndexController::class, 'ucc_nationwide']);
Route::get('/services/registered-agent', [IndexController::class, 'registered_agent']);
Route::get('/services/apostille', [IndexController::class, 'apostille']);
Route::get('/services/additional-services', [IndexController::class, 'additional_services']);
Route::get('/industries/law-firms-and-paralegal', [IndexController::class, 'law_firms_and_paralegal']);
Route::get('/industries/corporations', [IndexController::class, 'corporations']);
Route::get('/industries/businesses', [IndexController::class, 'businesses']);
Route::get('/industries/real-estate', [IndexController::class, 'real_estate']);
Route::get('/about-c2k', [IndexController::class, 'about']);
Route::get('/special-offers', [IndexController::class, 'special_offers']);
Route::get('/contact', [IndexController::class, 'contact']);
Route::get('/privacy-policy', [IndexController::class, 'privacy_policy']);

/********************************************** index Of CORP2000 **********************************************/

Route::post('/entities/{id}/{service}', [EntityController::class, 'store'])->name('entity.store');

Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
Route::put('/upload', [UserController::class, 'upload']);

/********************************************** Hamburger Menu **********************************************/

Route::get('/hamburger_menu/users', [UserController::class, 'users'])->name('hamburger_menu.users');
Route::get('/hamburger_menu/subscriptions', [SubscriptionController::class, 'subscriptions'])->name('hamburger_menu.subscriptions');
Route::get('/hamburger_menu/surveys', [SurveyController::class, 'surveys'])->name('hamburger_menu.surveys');
Route::get('/hamburger_menu/scans', [HamburgerMenuController::class, 'scans'])->name('hamburger_menu.scans');
Route::get('/hamburger_menu/reports', [HamburgerMenuController::class, 'reports'])->name('hamburger_menu.reports');
Route::get('/hamburger_menu/accounting', [AccountingController::class, 'accounting'])->name('hamburger_menu.accounting');

/********************************************** Orders **********************************************/

Route::get('/orders/status/new', [OrderController::class, 'orders_new']);
Route::put('/orders/{id}', [OrderController::class, 'update']);

/**********************************************  **********************************************/

Route::get('/my_reports', [RoleController::class, 'my_reports']);
Route::get('/api/instant_messages/{id}', [InstantMessageController::class, 'index']);
Route::get('/instant_messages/users', [InstantMessageController::class, 'users']);
Route::post('/instant_messages/{id}', [InstantMessageController::class, 'store']);
Route::get('/instant_messages/online_users', [InstantMessageController::class, 'online_users']);
Route::put('/instant_messages/read/{id}', [InstantMessageController::class, 'read']);
Route::get('/new_order', [OrderController::class, 'new']);

/********************************************** Dashboard **********************************************/

Route::get('/api/dashboard', [HomeController::class, 'dashboard']);
Route::get('/api/my_orders', [DashboardController::class, 'my_orders']);
Route::get('/users/count', [DashboardController::class, 'count_users']);
Route::get('/orders/count', [DashboardController::class, 'count_orders']);
Route::get('/entities/count', [DashboardController::class, 'count_entities']);
Route::get('/contacts/count', [DashboardController::class, 'count_contacts']);
Route::get('/auth_user', [UserCOntroller::class, 'getAuthUser']);
Route::put('/edit_profile/{id}', [UserCOntroller::class, 'edit_profile']);
