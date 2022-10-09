<?php

use App\Http\Controllers\CommoditiesController;
use App\Http\Controllers\CommodityAttributesController;
use App\Http\Controllers\CommodityTypesController;
use App\Http\Controllers\TransactionsController;
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

// Show or View a commodity's Type
Route::get(
    '/commodities/types/{commodity}/{type}/show_commodity_type',
    [CommodityTypesController::class, 'showCommodityType']
)->name('show_commodity_type');

// Add and store a commodity's type's attributes
Route::get(
    '/commodities/types/{commodity}/{type}/add_type_attributes',
    [CommodityTypesController::class, 'addTypeAttributes']
)->name('assign_type_attributes');
Route::post(
    '/commodities/types/{commodity}/{type_name}/add_type_attributes',
    [CommodityTypesController::class, 'storeTypeAttributes']
)->name('store_type_attributes');

// Edit attributes of a commodity type
Route::get(
    '/commodities/types/{commodity}/{type}/edit_commodity_type',
    [CommodityTypesController::class, 'editCommodityType']
)->name('edit_commodity_type');
Route::put(
    '/commodities/types/{commodity}/{type}',
    [CommodityTypesController::class, 'updateCommodityType']
)->name('update_commodity_type');


//Route to record a Sales transaction of a commodity
Route::get(
    '/sales/commodities/{commodity}/sell_commodity',
    [TransactionsController::class, 'sellCommodity']
)->name('sell_commodity');
Route::post(
    '/sales/commodities/sell_commodity',
    [TransactionsController::class, 'recordSellCommodity']
)->name('record_sell_commodity');

//Route to add and store a commodity purchase from a supplier
Route::get(
    '/commodities/{id}/commodity_supplier_purchase',
    [CommodityAttributesController::class, 'addCommoditySupply']
)->name('add_commodity_supply');
Route::post(
    '/commodity/commodity_supplier_purchase',
    [CommodityAttributesController::class, 'storeCommoditySupply']
)->name('store_commodity_supply');
