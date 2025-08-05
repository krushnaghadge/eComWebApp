<?php

use App\Http\Controllers\MainController;
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
