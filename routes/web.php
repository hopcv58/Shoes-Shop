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

use Illuminate\Support\Facades\Route;

//========================== Route User ===========================

Route::get('/', [
    'as' => 'home',
    'uses' => function () {
        return view('welcome');
    }
]);

Route::group(['namespace' => '\User'], function () {
    Route::get('index', [
        'as' => 'index',
        'uses' => 'UserController@index',
    ]);

    Route::get('login', [
        'as' => 'getlogin',
        'uses' => 'UserAuthController@showLoginForm',
    ]);

    Route::post('login', [
        'as' => 'login',
        'uses' => 'UserAuthController@login'
    ]);

    Route::post('logout', [
        'as' => 'logout',
        'uses' => 'UserAuthController@logout',
    ]);

    Route::get('password/reset', [
        'as' => 'password.request',
        'uses' => 'UserAuthController@showForgotPasswordForm',
    ]);

    Route::get('register', [
        'as' => 'register',
        'uses' => 'UserAuthController@showRegistrationForm',
    ]);

    Route::post('register', [
        'as' => 'register',
        'uses' => 'UserAuthController@showRegistrationForm',
    ]);
    
    Route::get('category', [
      'as' => 'category',
      'uses' => 'UserController@showCategory',
    ]);
    Route::get('product', [
      'as' => 'product',
      'uses' => 'UserController@showProduct',
    ]);
});


//===================== Route Admin ================================

Route::group([
//    'middleware' => 'admin_redirect',
    'prefix' => 'adminTalaha',
    'namespace' => '\Admin',
], function () {

    Route::group([], function (){
        Route::get('login', [
            'as' => 'admin.login',
            'uses' => 'AuthController@showAdminLoginForm'
        ]);
        Route::post('login', [
            'as' => 'postAdminLogin',
            'uses' => 'AuthController@adminLogin'
        ]);
        Route::post('logout', [
            'as' => 'admin.logout',
            'uses' => 'AuthController@adminLogout'
        ]);
    });

    Route::group([
        'middleware' => 'admin',
    ], function () {
        Route::get('dashboard', [
            'as' => 'admin.homepage',
            'uses' => 'AdminController@getIndex',
        ]);

        Route::get('/', [
            'as'=> 'dashboard',
            'uses'=> function(){
            return redirect()->route('admin.homepage');
            }
        ]);
    });
});