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

Route::group(['namespace' => '\User'], function () {
    Route::get('/', [
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
        'uses' => 'UserAuthController@register',
    ]);
    Route::get('category', [
      'as' => 'newProduct',
      'uses' => 'UserController@showNewProduct',
    ]);
    Route::get('category/{id}', [
        'as' => 'category',
        'uses' => 'UserController@showCategory',
    ]);
    Route::get('product/{id}', [
        'as' => 'product',
        'uses' => 'UserController@showProduct',
    ]);
    Route::resource('cart', 'UserCartController');
    Route::delete('emptyCart', 'UserCartController@emptyCart');
    Route::post('switchToWishlist/{id}', 'UserCartController@switchToWishlist');

    Route::resource('wishlist', 'UserWishlistController');
    Route::delete('emptyWishlist', 'UserWishlistController@emptyWishlist');
    Route::post('switchToCart/{id}', 'UserWishlistController@switchToCart');
    Route::resource('order', 'UserOrderController');
    Route::get('allOrders',[
        'as' => 'allOrders',
        'uses' => 'UserOrderController@showAll']
    );
    Route::get('search', [
      'as' => 'search',
      'uses' => 'UserController@search',
    ]);
    Route::get('news/{id}', [
      'as' => 'news',
      'uses' => 'UserController@showNews',
    ]);
    Route::get('news', [
      'as' => 'allNews',
      'uses' => 'UserController@showAllNews',
    ]);
    Route::post('product/comment','UserController@addCommentToProduct');
    Route::post('news/comment','UserController@addCommentToNewst');
    Route::post('feedback','UserController@addFeedback');
    Route::get('feedback','UserController@showFeedbackForm');
});


//===================== Route Admin ================================

Route::group([
//    'middleware' => 'admin_redirect',
    'prefix' => 'adminTalaha',
    'namespace' => '\Admin',
], function () {

    Route::group([], function () {
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
            'as' => 'dashboard',
            'uses' => function () {
                return redirect()->route('admin.homepage');
            }
        ]);

        // loai san pham
        Route::group(['prefix' => 'categories'], function () {
            Route::get('/', [
                'as' => 'admin.categories.list',
                'uses' => 'CategoriesController@listCategories',
            ]);

            Route::get('create', [
                'as' => 'admin.categories.create',
                'uses' => 'CategoriesController@showCreateCateForm',
            ]);

            Route::post('create', [
                'as' => 'admin.categories.postCreate',
                'uses' => 'CategoriesController@storeCategory',
            ]);

            Route::get('update/{id}', [
                'as' => 'admin.categories.update',
                'uses' => 'CategoriesController@showUpdateCategoryForm',
            ]);

            Route::post('update/{id}', [
                'as' => 'admin.categories.postUpdate',
                'uses' => 'CategoriesController@updateCategory'
            ]);

            Route::post('detete', [
                'as' => 'admin.categories.delete',
                'uses' => 'CategoriesController@deleteCategory',
            ]);
        });
        //end loai san pham

        //user
        Route::resource('users', 'UsersController', ['except' => ['destroy', 'create', 'edit', 'show']]);
        Route::post('users/delete', [
            'as' => 'admin.users.delete',
            'uses' => 'UsersController@destroy',
            'middleware' => 'adminRole',
        ]);
        Route::get('users/create', [
            'middleware' => 'adminRole',
            'as' => 'users.create',
            'uses' => 'UsersController@create',
        ]);

        Route::get('profile', [
            'as' => 'admin.users.profile',
            'uses' => 'UsersController@edit',
        ]);

        Route::resource('products', 'ProductsController', ['except' => ['destroy', 'show']]);
        Route::post('products/delete', [
            'as' => 'admin.products.delete',
            'uses' => 'ProductsController@destroy',
        ]);

        //quang cao
        Route::resource('advertisments', 'AdvertismentsController', ['except' => ['destroy', 'show']]);
        Route::post('advertisments/delete', [
            'as' => 'admin.advertisments.delete',
            'uses' => 'AdvertismentsController@destroy',
        ]);

        Route::get('users/customer', [
            'as' => 'admin.users.customer',
            'uses' => 'UsersController@getCustomer',
        ]);

        Route::get('users/customer/{id}', [
            'as' => 'admin.users.customer.detail',
            'uses' => 'UsersController@customerDetail',
        ]);

        Route::get('orders', [
            'as' => 'admin.orders.index',
            'uses' => 'OrdersController@index',
        ]);

        Route::post('orders/delete', [
            'as' => 'admin.orders.delete',
            'uses' => 'OrdersController@delete',
        ]);

        Route::get('orders/detail/{id}', [
            'uses' => 'OrdersController@detail',
        ]);
        Route::get('orders/detail/{id}/product', [
            'as' => 'admin.orders.detail',
            'uses' => 'OrdersController@detailProduct',
        ]);

        Route::get('orders/update/{id}', [
            'as' => 'admin.orders.update',
            'uses' => 'OrdersController@update',
        ]);

        Route::post('orders/update/{id}/update', [
            'as' => 'admin.orders.update.post',
            'uses' => 'OrdersController@postUpdate',
        ]);

        Route::get('product-orders/index', [
            'as' => 'admin.productorder.index',
            'uses' => 'OrdersController@getProductOrders',
        ]);

        Route::get('sale', [
            'as' => 'admin.sale',
            'uses' => 'AdminController@getSale',
        ]);

        Route::get('slides/create', [
            'as' => 'admin.news.getslides',
            'uses' => 'AdminController@showCreateSlidesForm',
        ]);

        Route::post('slides/create', [
            'as' => "admin.news.postslides",
            'uses' => 'AdminController@postSlide',
        ]);

        Route::get('feedbacks/list', [
            'as' => 'admin.news.feedbacks',
            'uses' => function () {
                $feedbacks = \App\Responsitory\Feedbacks::paginate(5);
                return view('admin.pages.news.feedbacks', compact('feedbacks'));
            }
        ]);

        Route::post('feedbacks/list/{id}', [
            'as' => 'admin.feedbacks.changestatus',
            'uses' => 'AdminController@changeFeedbackStatus'
        ]);
        Route::resource('news', 'NewsController', ['except' => ['show']]);

        Route::get('slides/list', [
            'as' => 'admin.slides.list',
            'uses' => 'AdminController@getListSlides',
        ]);

        Route::post('slides/delete/', [
            'as' => 'admin.slides.destroy',
            'uses' => 'AdminController@deleteSlide'
        ]);

        Route::get('slides/changestatus/{id}', [
            'as' => 'admin.slide.changestatus',
            'uses' => 'AdminController@slideChangeStatus',
        ]);
    });
});

Route::get('/sendmail', [
    'as' => 'sendmail',
    'uses' => 'MailController@sendMail'
]);