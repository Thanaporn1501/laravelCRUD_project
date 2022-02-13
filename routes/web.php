<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MapController;
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


Route::get('/home', function () {
    return view('home');
});

//login
Route::get('/auth/login', [LoginController::class, 'loginForm'])
->name('login'); // name this route to login by default setting.

Route::post('/auth/login', [LoginController::class, 'authenticate'])
->name('authenticate');

Route::get('/auth/logout', [LoginController::class, 'logout'])
->name('logout');

//product
Route::get('/product', [ProductController::class, 'list'])
->name('product-list');

Route::get('/product/create', [ProductController::class, 'createForm'])
->name('product-create-form');

Route::post('/product/create', [ProductController::class, 'create'])
->name('product-create');

Route::get('/product/{product}', [ProductController::class, 'show'])
->name('product-view');

Route::get('/product/{product}/location/add',[ProductController::class, 'addLocationForm'])
->name('product-add-location-form');

Route::post('/product/{product}/location/add',[ProductController::class, 'addLocation'])
->name('product-add-location');

Route::get('/product/{product}/location/{location}/remove',[ProductController::class, 'removeLocation'])
->name('product-remove-location');

Route::get('/product/{product}/location', [ProductController::class, 'showLocation'])
->name('product-view-location');

Route::get('/product/{product}/update', [ProductController::class, 'updateForm'])
->name('product-update-form');

Route::post('/product/{product}/update', [ProductController::class, 'update'])
->name('product-update');

Route::get('/product/{product}/delete', [ProductController::class, 'delete'])
->name('product-delete');
//location

Route::get('/location', [LocationController::class, 'list'])
->name('location-list');

Route::get('/location/create', [LocationController::class, 'createForm'])
->name('location-create-form');

Route::post('/location/create', [LocationController::class, 'create'])
->name('location-create');

Route::get('/location/{location}', [LocationController::class, 'show'])
->name('location-view');

Route::get('/location/{location}/product/add',[LocationController::class, 'addProductForm'])
->name('location-add-product-form');

Route::post('/location/{location}/product/add',[LocationController::class, 'addProduct'])
->name('location-add-product');

Route::get('/location/{/location}/product/{product}/remove',[LocationController::class, 'removeProduct'])
->name('location-remove-product');

Route::get('/location/{location}/product', [LocationController::class, 'showProduct'])
->name('location-view-product');

Route::get('/location/{location}/update', [LocationController::class, 'updateForm'])
->name('location-update-form');

Route::post('/location/{location}/update', [LocationController::class, 'update'])
->name('location-update');

Route::get('/location/{location}/delete', [LocationController::class, 'delete'])
->name('location-delete');

Route::get('/location/{location}', [LocationController::class, 'show'])
->name('location-view');



//category

Route::get('/category', [CategoryController::class, 'list'])
->name('category-list');

Route::get('/category/create', [CategoryController::class, 'createForm'])
->name('category-create-form');

Route::post('/category/create', [CategoryController::class, 'create'])
->name('category-create');

Route::get('/category/{category}', [CategoryController::class, 'show'])
->name('category-view');

Route::get('/category/{category}/product', [CategoryController::class, 'showProduct'])
->name('category-view-product');

Route::get('/category/{category}/product/add',[CategoryController::class, 'addProductForm'])
->name('category-add-product-form');

Route::post('/category/{category}/product/add',[CategoryController::class, 'addProduct'])
->name('category-add-product');

Route::get('/category/{category}/update', [CategoryController::class, 'updateForm'])
->name('category-update-form');

Route::post('/category/{category}/update', [CategoryController::class, 'update'])
->name('category-update');

Route::get('/category/{category}/delete', [CategoryController::class, 'delete'])
->name('category-delete');


