<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


//Authentication
//Auth::routes();
Route::get('login', 'UserAuth\LoginController@showLoginForm');
Route::post('login', 'UserAuth\LoginController@login');
Route::post('logout', 'UserAuth\LoginController@logout');
Route::post('password/email', 'UserAuth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset', 'UserAuth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/reset', 'UserAuth\ResetPasswordController@reset');
Route::get('password/reset/{token}', 'UserAuth\ResetPasswordController@showResetForm');
Route::get('register', 'UserAuth\RegisterController@showRegistrationForm');
Route::post('register', 'UserAuth\RegisterController@register');


Route::get('nshop-login', 'AdminAuth\LoginController@showLoginForm');
Route::post('nshop-login', 'AdminAuth\LoginController@login');
Route::post('nshop-logout', 'AdminAuth\LoginController@logout');
Route::post('nshop-password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail');
Route::get('nshop-password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm');
Route::post('nshop-password/reset', 'AdminAuth\ResetPasswordController@reset');
Route::get('nshop-password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');

//Admin Management
Route::group(['middleware' => 'admin'], function () {
    Route::group(['prefix' => 'nshop-admin', 'namespace' => 'Admin'], function () {
        Route::get('/', ['as' => 'getDashboard', 'uses' => 'DashboardController@getDashboard']);
        //user management
        Route::group(['prefix' => 'user'], function () {
            //admin
            Route::get('add', ['as' => 'getAdminAdd', 'uses' => 'UserController@getAdminAdd']);
            Route::post('add', ['as' => 'postAdminAdd', 'uses' => 'UserController@postAdminAdd']);
            Route::get('list-admin', ['as' => 'getAdminList', 'uses' => 'UserController@getAdminList']);
            Route::get('delete-admin/{id}', ['as' => 'getAdminDel', 'uses' => 'UserController@getAdminDel'])->where('id', '[0-9]+');
            Route::get('edit/{id}', ['as' => 'getAdminEdit', 'uses' => 'UserController@getAdminEdit'])->where('id', '[0-9]+');
            Route::post('edit/{id}', ['as' => 'postAdminEdit', 'uses' => 'UserController@postAdminEdit'])->where('id', '[0-9]+');
            Route::get('view/{id}', ['as' => 'getAdmin', 'uses' => 'UserController@getAdmin'])->where('id', '[0-9]+');
            //guest
            Route::get('list-guest', ['as' => 'getGuestList', 'uses' => 'UserController@getGuestList']);
            Route::get('delete-guest/{id}', ['as' => 'getGuestDel', 'uses' => 'UserController@getGuestDel'])->where('id', '[0-9]+');
            Route::get('user-detail/{id}', ['as' => 'getUserDetail', 'uses' => 'UserController@getUserDetail'])->where('id' , '[0-9]+');


        });
        //category management
        Route::group(['prefix' => 'category'], function () {
            Route::get('add', ['as' => 'getCateAdd', 'uses' => 'CategoryController@getCateAdd']);
            Route::post('add', ['as' => 'postCateAdd', 'uses' => 'CategoryController@postCateAdd']);
            Route::get('list', ['as' => 'getCateList', 'uses' => 'CategoryController@getCateList']);
            Route::get('delete/{id}', ['as' => 'getCateDel', 'uses' => 'CategoryController@getCateDel'])->where('id', '[0-9]+');
            Route::get('edit/{id}', ['as' => 'getCateEdit', 'uses' => 'CategoryController@getCateEdit'])->where('id', '[0-9]+');
            Route::post('edit/{id}', ['as' => 'postCateEdit', 'uses' => 'CategoryController@postCateEdit'])->where('id', '[0-9]+');
        });
        //product management
        Route::group(['prefix' => 'product'], function () {
            Route::get('add', ['as' => 'getProductAdd', 'uses' => 'ProductController@getProductAdd']);
            Route::post('add', ['as' => 'postProductAdd', 'uses' => 'ProductController@postProductAdd']);
            Route::get('list', ['as' => 'getProductList', 'uses' => 'ProductController@getProductList']);
            Route::get('delete/{id}', ['as' => 'getProductDel', 'uses' => 'ProductController@getProductDel'])->where('id', '[0-9]+');
            Route::get('edit/{id}', ['as' => 'getProductEdit', 'uses' => 'ProductController@getProductEdit'])->where('id', '[0-9]+');
            Route::post('edit/{id}', ['as' => 'postProductEdit', 'uses' => 'ProductController@postProductEdit'])->where('id', '[0-9]+');
            Route::get('delete-image-product/{id}/{image}', ['as' => 'delImageProduct', 'uses' => 'ProductController@delImageProduct'])->where('id', '[0-9]+');
        });
        //news management
        Route::group(['prefix' => 'news'], function () {
            Route::get('add', ['as' => 'getNewsAdd', 'uses' => 'NewsController@getNewsAdd']);
            Route::post('add', ['as' => 'postNewsAdd', 'uses' => 'NewsController@postNewsAdd']);
            Route::get('list', ['as' => 'getNewsList', 'uses' => 'NewsController@getNewsList']);
            Route::get('delete/{id}', ['as' => 'getNewsDel', 'uses' => 'NewsController@getNewsDel'])->where('id', '[0-9]+');
            Route::get('edit/{id}', ['as' => 'getNewsEdit', 'uses' => 'NewsController@getNewsEdit'])->where('id', '[0-9]+');
            Route::post('edit/{id}', ['as' => 'postNewsEdit', 'uses' => 'NewsController@postNewsEdit'])->where('id', '[0-9]+');
        });
        //order management
        Route::group(['prefix' => 'order'], function () {
            Route::get('list', ['as' => 'getOrderList', 'uses' => 'OrderController@getOrderList']);
            Route::get('detail/{id}', ['as' => 'getOrderDetail', 'uses' => 'OrderController@getOrderDetail'])->where('id', '[0-9]+');
            Route::get('update/{id}', ['as' => 'updateOrder', 'uses' => 'OrderController@updateOrder'])->where('id', '[0-9]+');
            Route::get('delete/{id}', ['as' => 'deleleOrder', 'uses' => 'OrderController@deleleOrder'])->where('id', '[0-9]+');
            Route::get('process-payment/{id}', ['as' => 'ProcessPayment', 'uses' => 'OrderController@ProcessPayment'])->where('id', '[0-9A-Za-z]+');
        });
        Route::group(['prefix' => 'slider'], function () {
            Route::post('add', ['as' => 'postSliderAdd', 'uses' => 'SliderController@postSliderAdd']);
            Route::get('list', ['as' => 'getSliderList', 'uses' => 'SliderController@getSliderList']);
            Route::get('delete/{id}', ['as' => 'getSliderDel', 'uses' => 'SliderController@getSliderDel'])->where('id', '[0-9]+');
            Route::get('edit/{id}', ['as' => 'getSliderEdit', 'uses' => 'SliderController@getSliderEdit'])->where('id', '[0-9]+');
            Route::post('edit/{id}', ['as' => 'postSliderEdit', 'uses' => 'SliderController@postSliderEdit'])->where('id', '[0-9]+');
        });
        Route::group(['prefix' => 'comment'], function () {
            Route::get('list', ['as' => 'getCommentList', 'uses' => 'CommentController@getCommentList']);
            Route::get('delete/{id}', ['as' => 'getCommentDel', 'uses' => 'CommentController@getCommentDel'])->where('id', '[0-9]+');
        });

        //email subscribe
        Route::group(['prefix' => 'subscribe'], function () {
            Route::get('list', ['as' => 'getSubscribeList', 'uses' => 'SubscribeController@getSubscribeList']);
            Route::get('delete/{id}', ['as' => 'getSubscribeDel', 'uses' => 'SubscribeController@getSubscribeDel'])->where('id', '[0-9]+');
            Route::get('send-mail', ['as' => 'getSendMail', 'uses' => 'SubscribeController@getSendMail']);
            Route::post('send-mail', ['as' => 'postSendMail', 'uses' => 'SubscribeController@postSendMail']);
        });
        Route::group(['prefix' => 'manage'], function () {
            //thông tin page
            Route::get('edit-info-page', ['as' => 'getInfoPageEdit', 'uses' => 'ManageController@getInfoPageEdit']);
            Route::post('edit-info-page', ['as' => 'postInfoPageEdit', 'uses' => 'ManageController@postInfoPageEdit']);
            //điều khoản
            Route::get('edit-provision', ['as' => 'getProvisionEdit', 'uses' => 'ManageController@getProvisionEdit']);
            Route::post('edit-provision', ['as' => 'postProvisionEdit', 'uses' => 'ManageController@postProvisionEdit']);
            //chính sách
            Route::get('edit-policy', ['as' => 'getPolicyEdit', 'uses' => 'ManageController@getPolicyEdit']);
            Route::post('edit-policy', ['as' => 'postPolicyEdit', 'uses' => 'ManageController@postPolicyEdit']);
            //hướng dẫn
            Route::get('edit-guide', ['as' => 'getGuideEdit', 'uses' => 'ManageController@getGuideEdit']);
            Route::post('edit-guide', ['as' => 'postGuideEdit', 'uses' => 'ManageController@postGuideEdit']);
        });
    });
});


Route::group(['prefix' => '/', 'namespace' => 'User'], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'MainController@getIndex']);
    Route::get('category/{id}-{slug}', ['as' => 'getCategory', 'uses' => 'MainController@getCategory'])->where('id', '[0-9]+');
    Route::get('product/{id}-{slug}', ['as' => 'getProduct', 'uses' => 'MainController@getProduct'])->where('id', '[0-9]+');
    Route::get('news-list', ['as' => 'getNews', 'uses' => 'MainController@getNews']);
    Route::get('news/{id}-{slug}', ['as' => 'getNewsDetail', 'uses' => 'MainController@getNewsDetail'])->where('id', '[0-9]+');
    Route::get('search-product', ['as' => 'getSearchProduct', 'uses' => 'MainController@getSearchProduct']);
//    Route::get('search-price/{id}', ['as' => 'getSearchOfPrice', 'uses' => 'MainController@getSearchOfPrice'])->where('id', '[0-9]+');

    Route::post('add-cart/{id}', ['as' => 'addCart', 'uses' => 'MainController@addCart'])->where('id', '[0-9]+');
    Route::get('cart', ['as' => 'getCart', 'uses' => 'MainController@getCart']);
    Route::get('remove-item-cart/{id}', ['as' => 'delItemCart', 'uses' => 'MainController@delItemCart']);
    Route::get('update-item-cart/{id}/{qty}', ['as' => 'updateItemCart', 'uses' => 'MainController@updateItemCart']);
    Route::get('checkout', ['as' => 'checkOut', 'uses' => 'MainController@checkOut']);
    Route::post('checkout', ['as' => 'saveOrder', 'uses' => 'MainController@saveOrder']);
    Route::get('detail/{id}', ['as' => 'OrderDetail', 'uses' => 'MainController@getOrderDetail'])->where('id', '[0-9]+');
    Route::get('customer-profile/{id}', ['as' => 'getCustomerProfile', 'uses' => 'MainController@getCustomerProfile'])->where('id', '[0-9]+');
    Route::get('customer-profile-edit/{id}', ['as' => 'getCustomerProfileEdit', 'uses' => 'MainController@getCustomerProfileEdit'])->where('id', '[0-9]+');
    Route::post('customer-profile-edit-info', ['as' => 'postCustomerProfileEdit', 'uses' => 'MainController@postCustomerProfileEdit']);
    Route::post('customer-profile-edit-avatar', ['as' => 'postCustomerProfileEditAvatar', 'uses' => 'MainController@postCustomerProfileEditAvatar']);
    Route::post('customer-profile-edit-password', ['as' => 'postCustomerProfileEditPassword', 'uses' => 'MainController@postCustomerProfileEditPassword']);
    Route::post('product/{id}-{slug}', ['as' => 'postComment', 'uses' => 'MainController@postComment'])->where('id', '[0-9]+');
    Route::post('subscribe', ['as' => 'postSubscribe', 'uses' => 'MainController@postSubscribe'])->where('id', '[0-9]+');


    //single page
    Route::get('dieu-khoan-dich-vu', ['as' => 'getDKDV', 'uses' => 'MainController@getDKDV']);
    Route::get('dieu-khoan-mua-hang', ['as' => 'getDKMH', 'uses' => 'MainController@getDKMH']);
    Route::get('dieu-khoan-thanh-toan', ['as' => 'getDKTT', 'uses' => 'MainController@getDKTT']);
    Route::get('dieu-khoan-van-chuyen', ['as' => 'getDKVC', 'uses' => 'MainController@getDKVC']);
    Route::get('chinh-sach-bao-mat', ['as' => 'getCSBM', 'uses' => 'MainController@getCSBM']);
    Route::get('chinh-sach-van-chuyen', ['as' => 'getCSVC', 'uses' => 'MainController@getCSVC']);
    Route::get('chinh-sach-doi-tra', ['as' => 'getCSDT', 'uses' => 'MainController@getCSDT']);
    Route::get('chinh-sach-mua-hang', ['as' => 'getCSMH', 'uses' => 'MainController@getCSMH']);
    Route::get('huong-dan-mua-hang', ['as' => 'getHDMH', 'uses' => 'MainController@getHDMH']);
    Route::get('huong-dan-thanh-toan', ['as' => 'getHDTT', 'uses' => 'MainController@getHDTT']);
    Route::get('huong-dan-giao-nhan', ['as' => 'getHDGN', 'uses' => 'MainController@getHDGN']);
    Route::get('huong-dan-doi-tra', ['as' => 'getHDDT', 'uses' => 'MainController@getHDDT']);


    Route::get('thanh-toan-bao-kim-thanh-cong/{id}', ['as' => 'getCheckoutBaoKimSC', 'uses' => 'CartController@getCheckoutBaoKimSC']);
//    Route::get('thanh-toan-ngan-luong-thanh-cong/{id}', ['as' => 'getCheckoutNganLuongSC', 'uses' => 'CartController@getCheckoutNganLuongSC']);
//    Route::get('thanh-toan-khong-thanh-cong', ['as' => 'getCheckoutFail', 'uses' => 'CartController@getCheckoutFail']);
});