<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('index');
// });



//Admin routes

Route::get('/admin', [AdminController::class, 'index']);

Route::get('/adminProducts', [AdminController::class, 'products']);
Route::get('/adminProfile', [AdminController::class, 'profile']);

Route::POST('/addNewProduct', [AdminController::class, 'addNewProduct']);




//User routes

Route::get('/', [MainController::class, 'index']);
Route::get('/cart', [MainController::class, 'cart']);

Route::get('/shop', [MainController::class, 'shop']);

Route::get('/single/{id}', [MainController::class, 'singleProduct']);

Route::post('/checkout', [MainController::class, 'checkout']);

// Route::post('/register', [MainController::class,'register']);
Route::get('/register', [MainController::class, 'register']);
Route::get('/order', [MainController::class, 'myOrders']);

Route::post('/registerUser', [MainController::class, 'registerUser']);
Route::get('/login', [MainController::class, 'showLogin']); // shows login form

Route::get('/checkout', [MainController::class, 'checkout']); // shows checkout form
Route::post('/loginUser', [MainController::class, 'loginUser']); // handles login submission
Route::get('/dashboard', [MainController::class, 'dashboard']); // shows dashboard after login
Route::get('/logout', [MainController::class, 'logout']);
Route::post('/addToCart', [MainController::class, 'addToCart']); // handles \ submission addToCart

Route::get('deleteCartItem/{id}', [MainController::class, 'deleteCartItem']);
