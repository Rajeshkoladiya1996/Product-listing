<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;


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
//     return view('welcome');
// });

 /** ---------------------------------------------------
     *  Route
     *  @Created By : Rajesh Koladiya
     *  @Created At : 03-06-2022
     * ---------------------------------------------------
 */

Route::get('/', [ProductController::class, 'index'])->name('front.product.create');
Route::get('/categorylist', [CategoryController::class, 'index'])->name('front.category.create');
Route::get('/addcategory', [CategoryController::class, 'addcategory'])->name('front.category.addcategory');
Route::get('/editcategory/{id}', [CategoryController::class, 'edit'])->name('front.category.editcategory');
Route::post('/updatecategory', [CategoryController::class, 'update'])->name('front.category.update');
Route::get('/category/destroy/{id}', [CategoryController::class, 'destroy'])->name('front.category.destroy');
Route::post('/addcatgeorystore', [CategoryController::class, 'store'])->name('front.category.store');
Route::get('/addproduct', [ProductController::class, 'create'])->name('front.product.addproduct');
Route::post('/update', [ProductController::class, 'update'])->name('front.product.update');
Route::post('/storeproduct', [ProductController::class, 'store'])->name('front.product.store');
Route::get('/editproduct/{id}', [ProductController::class, 'edit'])->name('front.product.edit');
Route::get('/product/destroy/{id}', [ProductController::class, 'destroy'])->name('front.product.destroy');
Route::get('/productlist', [ProductController::class, 'productList'])->name('front.product.productList');

