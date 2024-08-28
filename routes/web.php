<?php

use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/product', [ProductController::class, 'generate'])->name('product.index');
route::get('/product/create',[ProductController::class,'create'])->name('product.create');
route::post('/product/store',[ProductController::class,'store'])->name('product.store');
route::get('/product/{id}/show',[ProductController::class,'show'])->name('product.show');
route::get('/product/{id}/edit',[ProductController::class,'edit'])->name('product.edit');
route::put('/product/{id}/update',[ProductController::class,'update'])->name('product.update');
route::delete('/product/{id}/delete',[ProductController::class,'delete'])->name('product.delete');




