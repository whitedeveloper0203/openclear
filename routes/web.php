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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home')->middleware('auth', 'profile.passed');;

Route::middleware(['auth', 'auth.admin'])->namespace('Admin')->group(function() {
    Route::get('admin','DashboardController@index');
});
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get( '/redirect/{service}', 'Auth\SocialAuthController@redirect' );
Route::get( '/callback/{service}', 'Auth\SocialAuthController@callback' );

Route:: get( '/account-register', 'Auth\SocialAuthController@accountShow' )->name('account-register');
Route:: post( '/account-register', 'Auth\SocialAuthController@accountRegister' );

Route::get('/friends', 'Pages\FriendController@index')->name('friends')->middleware('auth', 'profile.passed');
Route::get('/about', 'Pages\AboutController@index')->name('about')->middleware('auth', 'profile.passed');
Route::get('/photo', 'Pages\PhotoController@index')->name('photo')->middleware('auth', 'profile.passed');
Route::get('/video', 'Pages\VideoController@index')->name('video')->middleware('auth', 'profile.passed');

// Import Social Data
Route::get('/import-facebook', 'Pages\ImportController@facebook')->name('import-facebook')->middleware('auth', 'profile.passed');
Route::post('/import-facebook/{service}', 'Pages\ImportController@importFacebook')->middleware('auth', 'profile.passed');

// Import Local Data
Route::post('/import/{type}', 'Pages\ImportController@importLocalMedia')->middleware('auth', 'profile.passed');