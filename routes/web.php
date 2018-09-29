<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/fb-login', 'Auth\LoginController@redirect')->name('login');
Route::get('/facebook/callback', 'Auth\LoginController@callback');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::prefix('sudo-admin')->group(function() {

});

Route::match(['get', 'post'],'/store/post', 'PostController@store');
Route::post('/store/category', 'PostController@storeCategory');

Route::get('/fetch/category', 'HomeController@fetchCategory');
Route::post('/shorten', 'HomeController@shorten');

Route::get('/sudo', 'HomeController@index')->name('home');


// this is where user see
Route::get('/read/{slug}', 'PostController@show');