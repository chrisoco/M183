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

Route::get('/complete-registration', 'Auth\RegisterController@completeRegistration')->name('complete-reg');

Route::post('/2fa', function () {
    return redirect(URL()->previous());
})->name('2fa')->middleware('2fa');

Route::group(['middleware' => ['auth', '2fa']], function() {

    /** INDEX */
    Route::get('/', 'UserController@index')->name('index');

    Route::get ('konto', 'UserController@profile')->name('profile');
    Route::post('konto', 'UserController@password_update')->name('profile.password.update');

    Route::resources([
        'news' => 'NewsController'
    ]);

});
