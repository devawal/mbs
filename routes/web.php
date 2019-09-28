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

// User login
Route::group(['prefix' => 'auth'], function () {

    Route::get('user-login', array("as" => "login", 'uses' => 'Auth\LoginController@showLogin'));
    Route::post('user-authentication', array("as" => "user_authentication", 'uses' => 'Auth\LoginController@userAuthentication'));
    Route::get('user-registration', array("as" => "user_registration", 'uses' => 'Auth\LoginController@userRegistration'));
    Route::post('post-registration', array("as" => "post_registration", 'uses' => 'Auth\LoginController@postRegistration'));

});

// Admin part start here
Route::group(['middleware' => 'auth', 'prefix' => 'account'], function () {

    Route::get('dashboard', array("as" => "user_dashboard", 'uses' => 'Admin_access\DashboardController@getIndex'));

    Route::get('profile', array("as" => "user_profile", 'uses' => 'Admin_access\UsersController@userProfile'));
    Route::post('user/update-password', array("as" => "update_user_password", 'uses' => 'Admin_access\UsersController@updateUserPassword'));

    Route::get('deposit', array("as" => "deposit", 'uses' => 'Admin_access\AccountController@depositIndex'));
    Route::get('deposit-form', array("as" => "deposit_form", 'uses' => 'Admin_access\AccountController@depositForm'));
    Route::post('post-deposit', array("as" => "post_deposit", 'uses' => 'Admin_access\AccountController@postDeposit'));

    Route::get('get-balance', array("as" => "get_balance", 'uses' => 'Admin_access\AccountController@getBalance'));

    Route::get('fund-transfer', array("as" => "fund_transfer", 'uses' => 'Admin_access\AccountController@fundTransfer'));
    Route::post('post-transfer', array("as" => "post_transfer", 'uses' => 'Admin_access\AccountController@postTransfer'));

    Route::get('fund-withdraw', array("as" => "fund_withdraw", 'uses' => 'Admin_access\AccountController@fundWithdraw'));
    Route::post('post-withdraw', array("as" => "post_withdraw", 'uses' => 'Admin_access\AccountController@postWithdraw'));

    // Logout active session
    Route::get('get-logout', array("as" => "get_logout", 'uses' => 'Auth\LoginController@getLogout'));
});