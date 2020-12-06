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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'HomeController@register');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'HomeController@profilePage')->name('home');
Route::post('/profile', 'HomeController@updateProfile')->name('home');
Route::get('/change-password', 'HomeController@changePassword')->name('home');
Route::post('/change-password', 'HomeController@updatePassword')->name('home');
Route::resource('/course', 'CourseController');
Route::resource('/customer', 'CustomerController');
Route::post('/assign', 'HomeController@assign');
