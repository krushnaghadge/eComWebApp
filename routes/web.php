<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('index');
// });

Route::get('/', [MainController::class, 'index']);
Route::get('/cart', [MainController::class, 'cart']);

Route::get('/shop', [MainController::class, 'shop']);

Route::get('/single/{id}', [MainController::class, 'singleProduct']);

Route::post('/checkout', [MainController::class, 'checkout']);

// Route::post('/register', [MainController::class,'register']);
Route::get('/register', [MainController::class,'register']);


Route::post('/registerUser', [MainController::class,'registerUser']);
Route::get('/login', [MainController::class, 'showLogin']); // shows login form
Route::post('/loginUser', [MainController::class, 'loginUser']); // handles login submission
Route::get('/dashboard', [MainController::class, 'dashboard']); // shows dashboard after login
Route::get('/logout', [MainController::class, 'logout']);
Route::post('/addToCart', [MainController::class, 'addToCart']); // handles \ submission addToCart

Route::get('deleteCartItem/{id}', [MainController::class, 'deleteCartItem']);

