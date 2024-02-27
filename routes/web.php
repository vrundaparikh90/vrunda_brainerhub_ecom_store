<?php

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

/*Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', function () {
    return view('auth.login');
});
Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/login', [App\Http\Controllers\UserController::class, 'login'])->name('login');
Route::post('/register', [App\Http\Controllers\UserController::class, 'register'])->name('register');
Route::get('page-401', [App\Http\Controllers\UserController::class, 'page401'])->name('page-401');

/*Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');*/

Route::group(['middleware'=>['auth']],function(){

	//categories - start
	Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories');
	Route::get('categories/create',[App\Http\Controllers\CategoryController::class, 'create'])->name('categories_create');
	Route::post('categories/store',[App\Http\Controllers\CategoryController::class, 'store'])->name('categories_store');
	Route::get('categories/edit/{id}',[App\Http\Controllers\CategoryController::class, 'edit'])->name('categories_edit');
	Route::post('categories/update/{id}',[App\Http\Controllers\CategoryController::class, 'update'])->name('categories_update');
	Route::post('categories/delete/{id}',[App\Http\Controllers\CategoryController::class, 'destroy'])->name('categories_delete');
	Route::get('getSubCategories',[App\Http\Controllers\CategoryController::class, 'getSubCategories'])->name('getSubCategories');
	//categories - end

	//products - start
	Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products');
	Route::get('products/create',[App\Http\Controllers\ProductController::class, 'create'])->name('products_create');
	Route::post('products/store',[App\Http\Controllers\ProductController::class, 'store'])->name('products_store');
	Route::get('products/edit/{id}',[App\Http\Controllers\ProductController::class, 'edit'])->name('products_edit');
	Route::post('products/update/{id}',[App\Http\Controllers\ProductController::class, 'update'])->name('products_update');
	Route::post('products/delete/{id}',[App\Http\Controllers\ProductController::class, 'destroy'])->name('products_delete');
	//products - end
});

Route::get('/logout',[App\Http\Controllers\UserController::class, 'logout'])->name('logout');
