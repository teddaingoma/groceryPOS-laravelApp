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

//Assign and store a commodity's category
Route::get(
    '/commodity/{id}/add_commodity_category',
    [CommodityAttributesController::class, 'addCommodityCategory']
)->name('add_commodity_category');
Route::post(
    '/commodity/add_commodity_category',
    [CommodityAttributesController::class, 'storeCommodityCategory']
)->name('store_commodity_category');

//Assign and Store a commodity's price
Route::get(
    '/commodity/{id}/add_commodity_price',
    [CommodityAttributesController::class, 'addCommodityPrice']
)->name('add_commodity_price');
Route::post(
    '/commodity/add_commodity_price',
    [CommodityAttributesController::class, 'storeCommodityPrice']
)->name('store_commodity_price');

//Assign and Store a commodity's Unit of measurement
Route::get(
    '/commodity/{id}/add_commodity_unit',
    [CommodityAttributesController::class, 'addCommodityUnit']
)->name('add _commodity_unit');
Route::post(
    '/commodity/add_commodity_unit',
    [CommodityAttributesController::class, 'storeCommodityUnit']
)->name('store_commodity_unit');

//Assign and store a commodity's acquisition date
Route::get(
    '/commodity/{id}/add_commodity_aquisition-date',
    [CommodityAttributesController::class, 'addCommodityAquisitionDate']
)->name('add_commodity_aquisition-date');
Route::post(
    '/commodity/add_commodity_aquisition-date',
    [CommodityAttributesController::class, 'storeCommodityAquisitionDate']
)->name('store_commodity_aquisition-date');

//Assign and store a commodity's available quantity
Route::get(
    '/commodity/{id}/add_commodity_quantity',
    [CommodityAttributesController::class, 'addCommodityQuantity']
)->name('add_commodity_quantity');
Route::post(
    '/commodity/add_commodity_quantity',
    [CommodityAttributesController::class, 'storeCommodityQuantity']
)->name('store_commodity_quantity');
