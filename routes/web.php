<?php

use App\Http\Controllers\CommoditiesController;
use App\Http\Controllers\UserCommodityController;
use App\Http\Controllers\CommodityAttributesController;
use App\Http\Controllers\CommodityTypesController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;

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

//show commodities belonging to a user (grocery owner)
Route::get(
    '/commodities/show/{commodity:id}',
    [UserCommodityController::class, 'showUserCommodity']
)->name('show_user_commodities');

//assign commodity attributes route
Route::get(
    '/commodity/{commodity:id}/add_commodity_attributes',
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
    '/commodities/types/{commodity}/add_type_attributes',
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
    '/commodities/commodity_supplier_purchase',
    [CommodityAttributesController::class, 'storeCommoditySupply']
)->name('store_commodity_supply');

//Route to add and store a commodity type purchase from a supplier
Route::get(
    '/commodities/types/{commodity}/{type}/type_supplier_purchase',
    [CommodityTypesController::class, 'addTypeSupply']
)->name('add_type_supply');
Route::post(
    '/commodities/types/{commodity}/{type}/type_supplier_purchase',
    [CommodityTypesController::class, 'storeTypeSupply']
)->name('store_type_supply');

//Route to record and store a sells of a type item
Route::get(
    '/sales/types/{commodity}/{type}/sell_type',
    [TransactionsController::class, 'sellType']
)->name('sell_type');
Route::post(
    '/sales/types/{commodity}/{type}/sell_type',
    [TransactionsController::class, 'recordSellType']
)->name('record_sell_type');


//Route to Display Available Commodities
Route::get(
    '/sales/available_commodities',
    [TransactionsController::class, 'AvailableCommodities']
)->name('available_commodities');

//Route to view sales reports
Route::get(
    '/sales/sales_report',
    [TransactionsController::class, 'viewSalesReport']
)->name('sales_report');

//Route to view Financial Statements
Route::get(
    '/sales/financial_statements',
    [TransactionsController::class, 'viewFinancialStatements']
)->name('financial_statements');

//Route to view Purchase Reports
Route::get(
    '/sales/purchases_report',
    [TransactionsController::class, 'viewPurchaseReport']
)->name('purchases_report');

/**
 * User Authentication and Authorization routes
 */
//signup
Route::get(
    '/auth/signup',
    [SignupController::class, 'signup']
)->name('signup');
Route::post(
    '/auth/signup',
    [SignupController::class, 'add_account']
);
//login
Route::get(
    '/auth/login',
    [LoginController::class, 'login']
)->name('login');
Route::post(
    '/auth/login',
    [LoginController::class, 'login_account']
);
//Logout
Route::post(
    '/auth/logout',
    [LogoutController::class, 'logout']
)->name('logout');

//category resource route
Route::resource('/category', CategoryController::class);

//commodity type's resource route
Route::resource('/commodity/type', CommodityTypesController::class);

/**  user customer route's */

// view all customers
Route::get(
    '/customer/view_customers',
    [CustomerController::class, 'view_customers']
)->name('view_customers');

// add customer
Route::get(
    '/customer/add_customer',
    [CustomerController::class, 'add_customer']
)->name('add_customer');
Route::post(
    '/customer/add_customer',
    [CustomerController::class, 'store_customer']
);

//edit customer
Route::get(
    '/customer/edit_customer/{customer_id}',
    [CustomerController::class, 'edit_customer']
)->name('edit_customer');


/** user supplier route's */

// view all suppliers
Route::get(
    '/supplier/view_supplier',
    [SupplierController::class, 'view_suppliers']
)->name('view_suppliers');

//add supplier
Route::get(
    '/supplier/add_supplier',
    [SupplierController::class, 'add_supplier']
)->name('add_supplier');
Route::post(
    '/supplier/add_supplier',
    [SupplierController::class, 'store_supplier']
);

//edit supplier
Route::get(
    '/supplier/edit_supplier/{supplier}',
    [SupplierController::class, 'edit_supplier']
)->name('edit_supplier');
