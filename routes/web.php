<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('index');
// });

Route::get('/', [MainController::class, 'index']);
Route::get('/cart', [MainController::class, 'cart']);

Route::get('/shop', [MainController::class, 'shop']);

Route::get('/single', [MainController::class, 'singleProduct']);

Route::get('/checkout', [MainController::class, 'checkout']);

Route::get('/register', [MainController::class,'register']);

Route::post('/registerUser', [MainController::class,'registerUser']);
Route::post('/loginUser', [MainController::class,'loginUser']);
