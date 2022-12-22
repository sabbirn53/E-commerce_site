<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

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

Route::get('/',[HomeController::class,'index']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::post('add-comment',[HomeController::class,'addComment']);
Route::post('add-reply',[HomeController::class,'addReply']);

Route::get('/redirect',[HomeController::class,'redirect']);
Route::get('product-details/{id}',[HomeController::class,'productDetails']);
Route::post('add-cart/{id}',[HomeController::class,'addCart']);
Route::get('show-cart',[HomeController::class,'showCart']);
Route::get('remove-cart/{id}',[HomeController::class,'removeCart']);
Route::get('cash-order',[HomeController::class,'cashOrder']);
Route::get('card-pay/{totalPrice}',[HomeController::class,'cardPay']);
Route::post('stripe/{totalPrice}',[HomeController::class,'stripePost'])->name('stripe.post');

Route::get('view_category',[AdminController::class,'viewCategory']);
Route::post('add-category',[AdminController::class,'addCategory']);
Route::get('delete-category/{id}',[AdminController::class,'deleteCategory']);

Route::get('add-product',[AdminController::class,'addProduct']);
Route::post('store-product',[AdminController::class,'storeProduct']);
Route::get('view-product',[AdminController::class,'viewProduct']);

Route::get('delete/{id}',[AdminController::class,'delete']);

Route::get('edit/{id}',[AdminController::class,'edit']);
Route::post('update-product/{id}',[AdminController::class,'updateProduct']);

Route::get('view-order',[AdminController::class,'viewOrder']);
Route::get('deliver/{id}',[AdminController::class,'deliver']);


Route::get('print-pdf/{id}',[AdminController::class,'printPdf']);


Route::get('search',[AdminController::class,'searchData']);