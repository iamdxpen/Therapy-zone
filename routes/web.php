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

Route::group(['prefix' => 'admin'],base_path('routes/admin.php'));

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

Route::get('/automation.html', ['as' => 'automation', 'uses' => 'PageController@automation']);
Route::get('/facilities.html', ['as' => 'facilities', 'uses' => 'PageController@facilities']);
Route::get('/oems.html', ['as' => 'oems', 'uses' => 'PageController@oems']);
Route::get('/contact-us.html', ['as' => 'contact-us', 'uses' => 'PageController@contactUs']);


Route::get('/products.html', ['as' => 'products', 'uses' => 'ProductController@index']);
Route::get('/{slug}.html', ['as' => 'product.detail', 'uses' => 'ProductController@detail']);

Route::post('/contact-us.html', ['as' => 'submit-contact-us', 'uses' => 'PageController@submitContactUs']);
Route::post('/send-enquiry', ['as' => 'send-enquiry', 'uses' => 'ProductController@sendEnquiry']);
Route::post('/', ['as' => 'get-a-quote', 'uses' => 'HomeController@getQuote']);