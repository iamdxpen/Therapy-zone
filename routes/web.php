<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::group(['prefix' => 'admin'],base_path('routes/admin.php'));
Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('about-us');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::post('/customer', [HomeController::class, 'store'])->name('customer.store');

Route::get('/code', [HomeController::class, 'code'])->name('code');
Route::post('/code', [HomeController::class, 'storeCode'])->name('code.store');