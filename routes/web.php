<?php

use App\Http\Controllers\Admin\ItemCategoryController as AdminItemCategoryController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ItemCategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReOrderController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;


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

Route::get('/roles', [AdminController::class,'Permission']);

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware'=>'preventBack'], function(){
    Auth::routes();
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::group(['middleware'=>['auth','preventBack']], function(){

    Route::group(['prefix'=>'user', 'middleware'=> 'isUser'], function(){
        Route::get('dashboard', [UserController::class, 'index'])->name('user.dashboard');
        Route::get('product', [ProductController::class, 'index'])->name('user.product');
        Route::get('countries', [CountryController::class, 'index'])->name('user.countries');
        Route::get('invoice', [InvoiceController::class, 'index'])->name('user.invoice');
        Route::get('profile', [UserController::class, 'profile'])->name('user.profile');
        Route::get('search', [ItemController::class, 'search'])->name('user.search');
        Route::get('search-customer', [CustomerController::class, 'search'])->name('user.customer-search');
        Route::get('search-supplier', [SupplierController::class, 'search'])->name('user.supplier-search');
        Route::get('search-customer-name', [InvoiceController::class, 'customerSearch'])->name('user.search-customer-name');
        Route::get('search-inv-item', [InvoiceController::class, 'search'])->name('invoice.search');
        Route::get('search-edit', [ItemController::class, 'searchEdit'])->name('user.search-edit');
        Route::get('get-item-category/{id}', [ItemCategoryController::class, 'edit']);
        Route::get('get-country/{id}', [CountryController::class, 'edit']);
        Route::get('get-item/{id}', [ItemController::class, 'edit']);
        Route::get('get-all-items', [ItemController::class, 'getAllItems'])->name('user.all-items');
        Route::delete('delete-item-category/{id}', [ItemCategoryController::class, 'delete'])->name('category.delete');
        Route::delete('delete-item/{id}', [ItemController::class, 'delete'])->name('item.delete');
        Route::delete('delete-customer/{id}', [CustomerController::class, 'destroy'])->name('customer.delete');
        Route::delete('delete-supplier/{id}', [SupplierController::class, 'destroy'])->name('supplier.delete');
        Route::delete('delete-product/{id}', [ProductController::class, 'destroy'])->name('product.delete');
        Route::delete('delete-country/{id}', [CountryController::class, 'delete'])->name('country.delete');
        Route::get('get-category-details', [ItemController::class, 'categoryDetials'])->name('user.category-details');
        Route::get('get-item-details', [InvoiceController::class, 'itemDetails'])->name('user.item-details');
        Route::get('get-customer-details', [InvoiceController::class, 'customerDetails'])->name('customer-details');
        Route::get('add-item', [ItemController::class, 'index'])->name('user.add-item');
        Route::get('add-customer', [CustomerController::class, 'index'])->name('user.customer');
        Route::get('add-item-category', [ItemCategoryController::class, 'index'])->name('user.add-item-category');
        Route::get('print-invoice-pdf', [InvoiceController::class, 'printInvoice'])->name('user.print-pdf');
        Route::get('all-re-orders', [ReOrderController::class, 'allReOrders'])->name('all-re-orders');
        Route::get('price-change', [ItemController::class, 'priceChange'])->name('price-change');
        Route::get('suppliers', [SupplierController::class, 'index'])->name('suppliers');
        // Route::get('print-invoice-pdf', [InvoiceController::class, 'printInvoice'])->name('user.print-pdf');
        Route::post('print-invoice', [InvoiceController::class, 'printInvoice']);
        Route::post('save-item-category', [ItemCategoryController::class, 'create']);
        Route::post('save-country', [CountryController::class, 'save']);
        Route::post('save-invoice', [InvoiceController::class, 'save'])->name('invoice.save');
        Route::post('save-product', [ProductController::class, 'store']);
        Route::post('save-customer', [CustomerController::class, 'store']);
        Route::post('save-supplier', [SupplierController::class, 'store']);
        Route::post('save-item', [ItemController::class, 'save']);
        Route::post('update-item-category', [ItemCategoryController::class, 'update']);
        Route::post('update-item', [ItemController::class, 'update']);
        Route::post('update-country', [CountryController::class, 'update']);
        Route::get('re-order', [ReOrderController::class,'index'])->name('user.re-order');
        Route::post('update-soh', [ReOrderController::class, 'updateSoh']);
    });

    Route::group(['prefix'=>'admin', 'middleware'=>['isAdmin'], 'as'=>'admin.'], function(){
        Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::post('save-item', [\App\Http\Controllers\Admin\ItemController::class, 'store']);
        Route::get('add-item', [\App\Http\Controllers\Admin\ItemController::class, 'index'])->name('add-item');
        Route::get('item-category', [\App\Http\Controllers\Admin\ItemCategoryController::class, 'index'])->name('item-category');
        Route::delete('delete-item/{id}', [\App\Http\Controllers\Admin\ItemController::class, 'destroy'])->name('item-delete');
        Route::get('search', [\App\Http\Controllers\Admin\ItemController::class, 'search'])->name('search');
        Route::get('get-category-details', [\App\Http\Controllers\Admin\ItemController::class, 'categoryDetials'])->name('category-details');
    });
   
    
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
