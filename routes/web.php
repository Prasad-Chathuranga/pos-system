<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ItemCategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware'=>'preventBack'], function(){
    Auth::routes();
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'admin', 'middleware'=>['isAdmin','auth','preventBack']], function(){
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('profile', [AdminController::class, 'profile'])->name('admin.profile');
});

Route::group(['prefix'=>'user', 'middleware'=>['isUser','auth','preventBack']], function(){
    Route::get('dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('invoice', [InvoiceController::class, 'index'])->name('user.invoice');
    Route::get('profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('search', [ItemController::class, 'search'])->name('user.search');
    Route::get('search-inv-item', [InvoiceController::class, 'search'])->name('invoice.search');
    Route::get('search-edit', [ItemController::class, 'searchEdit'])->name('user.search-edit');
    Route::get('get-item-category/{id}', [ItemCategoryController::class, 'edit']);
    Route::get('get-item/{id}', [ItemController::class, 'edit']);
    Route::delete('delete-item-category/{id}', [ItemCategoryController::class, 'delete'])->name('category.delete');
    Route::delete('delete-item/{id}', [ItemController::class, 'delete'])->name('item.delete');
    Route::get('get-category-details', [ItemController::class, 'categoryDetials'])->name('user.category-details');
    Route::get('get-item-details', [InvoiceController::class, 'itemDetails'])->name('user.item-details');
    Route::get('add-item', [ItemController::class, 'index'])->name('user.add-item');
    Route::get('add-item-category', [ItemCategoryController::class, 'index'])->name('user.add-item-category');
    Route::post('save-item-category', [ItemCategoryController::class, 'save']);
    Route::post('save-item', [ItemController::class, 'save']);
    Route::post('update-item-category', [ItemCategoryController::class, 'update']);
    Route::post('update-item', [ItemController::class, 'update']);
    
});