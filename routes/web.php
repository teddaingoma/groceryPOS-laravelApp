<?php

use App\Http\Controllers\CommoditiesController;
use App\Http\Controllers\CommodityAttributesController;
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
// Route::get('/', function () {
//     return view('layout.app');
// });

// Route::get('/home', function () {
//     return view('layout.home');
// });

//commodities resource route
Route::resource('/home', CommoditiesController::class);

//assign commodity attributes route
Route::get(
    '/commodity/{id}/add_commodity_attributes',
    [CommodityAttributesController::class, 'assignCommodityAttributes']
)->name('assign_commodity_attributes');

//Save commodity attributes route
Route::post(
    '/commodity/add_commodity_attributes',
    [CommodityAttributesController::class, 'storeCommodityAttributes']
)->name('store_commodity_attributes');

//assign commodity type
Route::get(
    '/commodity/{id}/add_commodity_type',
    [CommodityAttributesController::class, 'addCommodityType']
)->name('add_commodity_type');

Route::post(
    '/commodity/add_commodity_type',
    [CommodityAttributesController::class, 'storeCommodityType']
)->name('store_commodity_type');
