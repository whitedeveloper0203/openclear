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

Route::group(['middleware' => ['auth', 'profile.passed']], function () {
    Route::get('/friends', 'Pages\FriendController@index')->name('friends');
    Route::get('/friends-search', 'Pages\FriendController@search')->name('search-friends');
    Route::post('/friends/add-friend', 'Pages\FriendController@addFriend')->name('add-friend');
    Route::post('/friends/accept-friend', 'Pages\FriendController@acceptFriendRequest')->name('accept-friend');
    Route::post('/friends/deny-friend', 'Pages\FriendController@denyFriendRequest')->name('deny-friend');
    Route::post('/friends/block-friend', 'Pages\FriendController@blockFriend')->name('block-friend');
    Route::post('/friends/remove-friend', 'Pages\FriendController@removeFriend')->name('remove-friend');

    Route::get('/notification/unread-friendlist-count', 'Pages\FriendController@getUnReadFollowCount')->name('get-unread-friendlist-count');
    Route::get('/notification/mark-as-read-friendlist', 'Pages\FriendController@markAsReadFollowNotification')->name('mark-as-read-friendlist');
});

Route::get('/about', 'Pages\AboutController@index')->name('about')->middleware('auth', 'profile.passed');
Route::get('/photo', 'Pages\PhotoController@index')->name('photo')->middleware('auth', 'profile.passed');
Route::get('/video', 'Pages\VideoController@index')->name('video')->middleware('auth', 'profile.passed');

// Import Social Data
Route::get('/import-facebook', 'Pages\ImportController@facebook')->name('import-facebook')->middleware('auth', 'profile.passed');
Route::post('/import-facebook/{service}', 'Pages\ImportController@importFacebook')->middleware('auth', 'profile.passed');
Route::get('/import-google', 'Pages\ImportController@google')->name('import-facebook')->middleware('auth', 'profile.passed');
// Route::post('/import-facebook/{service}', 'Pages\ImportController@importFacebook')->middleware('auth', 'profile.passed');

// Import Local Data
Route::post('/import/{type}', 'Pages\ImportController@importLocalMedia')->middleware('auth', 'profile.passed');
Route::post('/import-header-photo', 'Pages\ImportController@importHeaderPhoto')->middleware('auth', 'profile.passed');

// Account Pages

// Friend Request
Route::get('/friend-request', 'Pages\Account\FriendRequestController@index')->name('friend-request')->middleware('auth', 'profile.passed');

// Notification
Route::get('/notification', 'Pages\Account\NotificationController@index')->name('notification')->middleware('auth', 'profile.passed');

// Chat Messages
Route::get('/chat-message', 'Pages\Account\ChatMessageController@index')->name('chat-message')->middleware('auth', 'profile.passed');

// Account Setting
Route::get('/account-setting', 'Pages\Account\AccountSettingController@index')->name('account-setting')->middleware('auth', 'profile.passed');

// Personal Information
Route::get('/personal-information', 'Pages\Account\PersonalInfoController@index')->name('personal-info')->middleware('auth', 'profile.passed');
Route::post('/personal-information', 'Pages\Account\PersonalInfoController@store')->name('personal-info')->middleware('auth', 'profile.passed');
Route::get('/personal-information/get-state-list','Pages\Account\PersonalInfoController@getStateList')->name('state-list')->middleware('auth', 'profile.passed');
Route::get('/personal-information/get-city-list','Pages\Account\PersonalInfoController@getCityList')->name('city-list')->middleware('auth', 'profile.passed');

// Change Password
Route::get('/change-password', 'Pages\Account\ChangePasswordController@index')->name('change-password')->middleware('auth', 'profile.passed');
Route::post('change-password', 'Pages\Account\ChangePasswordController@store')->name('change-password')->middleware('auth', 'profile.passed');

// Hobby Interest
Route::get('/hobby-interest', 'Pages\Account\HobbyInterestController@index')->name('hobby-interest')->middleware('auth', 'profile.passed');
Route::post('/hobby-interest', 'Pages\Account\HobbyInterestController@store')->name('hobby-interest')->middleware('auth', 'profile.passed');

// Education
Route::get('/education', 'Pages\Account\EducationController@index')->name('education')->middleware('auth', 'profile.passed');