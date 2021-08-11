<?php

use Illuminate\Support\Facades\Auth;
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

/** Auth Routes (Login, Register, Logout) */
Auth::routes();

Route::group(['middleware' => 'auth'], function() {

    /** INDEX */
    Route::get('/', 'UserController@index')->name('index');

    Route::get ('konto', 'UserController@profile')->name('profile');
    Route::post('konto', 'UserController@password_update')->name('profile.password.update');

    Route::resources([
        'news' => 'NewsController'
    ]);

});
