<?php

Route::group(['middleware' => ['guest:admin']], function() {
    Route::get('/', ['as' => 'admin.login', 'uses' => 'Admin\LoginController@index']);
    Route::get('/login', ['as' => 'admin.login-home', 'uses' => 'Admin\LoginController@index']);
    Route::post('/login', ['as' => 'admin.login.do', 'uses' => 'Admin\LoginController@login']);
    Route::get('/forgot-password', ['as' => 'admin.forgot-password', 'uses' => 'Admin\ForgotPasswordController@index']);
    Route::post('/password/email', ['as' => 'admin.password.email', 'uses' => 'Admin\ForgotPasswordController@sendResetLinkEmail']);
    Route::get('/password/reset/{token}', ['as' => 'admin.password.reset', 'uses' => 'Admin\ResetPasswordController@showResetForm']);
    Route::post('/password/reset', ['as' => 'admin.password.update', 'uses' => 'Admin\ResetPasswordController@reset']);
});


Route::group(['middleware' => ['auth:admin']], function () {
    Route::get('/dashboard', ['as' => 'admin.dashboard', 'uses' => 'Admin\DashboardController@index']);
    Route::get('/logout', ['as' => 'admin.logout', 'uses' => 'Admin\DashboardController@logout']);
    Route::get('/sync-permission', ['as' => 'admin.sync-permission', 'uses' => 'Admin\DashboardController@syncPermission']);

    Route::get('/profile', ['as' => 'admin.profile', 'uses' => 'Admin\ProfileController@index']);
    Route::post('/profile/update', ['as' => 'admin.profile-update', 'uses' => 'Admin\ProfileController@update']);
    Route::get('/change-password', ['as' => 'admin.change-password', 'uses' => 'Admin\ProfileController@change_password']);
    Route::post('/change-password', ['as' => 'admin.change-password-update', 'uses' => 'Admin\ProfileController@update_password']);

    Route::group(['prefix' => 'site-setting'], function() {
        Route::get('/', ['as' => 'admin.site-setting', 'uses' => 'Admin\SettingController@index']);
        Route::post('/', ['as' => 'admin.update-setting', 'uses' => 'Admin\SettingController@update']);
    });

    Route::group(['prefix' => 'roles'], function() {
        Route::get('/', ['as' => 'admin.roles', 'uses' => 'Admin\RoleController@index']);
        Route::get('/ajax-list', ['as' => 'admin.roles.ajax-list', 'uses' => 'Admin\RoleController@ajaxList']);
        Route::get('/add', ['as' => 'admin.roles.add', 'uses' => 'Admin\RoleController@add']);
        Route::post('/add', ['as' => 'admin.roles.store', 'uses' => 'Admin\RoleController@store']);
        Route::get('/edit/{id}', ['as' => 'admin.roles.edit', 'uses' => 'Admin\RoleController@edit']);
        Route::post('/edit/{id}', ['as' => 'admin.roles.update', 'uses' => 'Admin\RoleController@update']);
        Route::post('/update-status', ['as' => 'admin.roles.update-status', 'uses' => 'Admin\RoleController@updateStatus']);   
        Route::post('/remove', ['as' => 'admin.roles.remove', 'uses' => 'Admin\RoleController@remove']);   
    });
    
    Route::group(['prefix' => 'users'], function() {
        Route::get('/', ['as' => 'admin.users', 'uses' => 'Admin\UserController@index']);
        Route::get('/ajax-list', ['as' => 'admin.users.ajax-list', 'uses' => 'Admin\UserController@ajaxList']);
        Route::get('/add', ['as' => 'admin.users.add', 'uses' => 'Admin\UserController@add']);
        Route::post('/add', ['as' => 'admin.users.store', 'uses' => 'Admin\UserController@store']);
        Route::get('/edit/{id}', ['as' => 'admin.users.edit', 'uses' => 'Admin\UserController@edit']);
        Route::post('/edit/{id}', ['as' => 'admin.users.update', 'uses' => 'Admin\UserController@update']);
        Route::post('/update-status', ['as' => 'admin.users.update-status', 'uses' => 'Admin\UserController@updateStatus']);
        Route::post('/remove', ['as' => 'admin.users.remove', 'uses' => 'Admin\UserController@remove']);
        Route::post('/check-email', ['as' => 'admin.users.check-email', 'uses' => 'Admin\UserController@checkEmail']);
    });


      Route::group(['prefix' => 'spa'], function() {
        Route::get('/', ['as' => 'admin.spa', 'uses' => 'Admin\SpaController@index']);
        Route::get('/ajax-list', ['as' => 'admin.spa.ajax-list', 'uses' => 'Admin\SpaController@ajaxList']);
        Route::get('/add', ['as' => 'admin.spa.add', 'uses' => 'Admin\SpaController@add']);
        Route::post('/add', ['as' => 'admin.spa.store', 'uses' => 'Admin\SpaController@store']);
        Route::get('/edit/{id}', ['as' => 'admin.spa.edit', 'uses' => 'Admin\SpaController@edit']);
        Route::post('/edit/{id}', ['as' => 'admin.spa.update', 'uses' => 'Admin\SpaController@update']);
        Route::post('/update-status', ['as' => 'admin.spa.update-status', 'uses' => 'Admin\SpaController@updateStatus']);   
        Route::post('/remove', ['as' => 'admin.spa.remove', 'uses' => 'Admin\SpaController@remove']);   
        Route::post('/check-display-order', ['as' => 'admin.check-display-order', 'uses' => 'Admin\SpaController@displayorder']);
      });

      Route::group(['prefix' => 'spapackages'], function() {
        Route::get('/', ['as' => 'admin.spa.packages', 'uses' => 'Admin\SpaPackagesController@index']);
        Route::get('/ajax-list', ['as' => 'admin.spa.packages.ajax-list', 'uses' => 'Admin\SpaPackagesController@ajaxList']);
        Route::get('/add', ['as' => 'admin.spa.packages.add', 'uses' => 'Admin\SpaPackagesController@add']);
        Route::post('/add', ['as' => 'admin.spa.packages.store', 'uses' => 'Admin\SpaPackagesController@store']);
        Route::get('/edit/{id}', ['as' => 'admin.spa.packages.edit', 'uses' => 'Admin\SpaPackagesController@edit']);
        Route::post('/edit/{id}', ['as' => 'admin.spa.packages.update', 'uses' => 'Admin\SpaPackagesController@update']);
        Route::post('/update-status', ['as' => 'admin.spa.packages.update-status', 'uses' => 'Admin\SpaPackagesController@updateStatus']);   
        Route::post('/remove', ['as' => 'admin.spa.packages.remove', 'uses' => 'Admin\SpaPackagesController@remove']);   
      });

      Route::group(['prefix' => 'customer'], function() {
        Route::get('/', ['as' => 'admin.customer', 'uses' => 'Admin\CustomerController@index']);
        Route::get('/ajax-list', ['as' => 'admin.customer.ajax-list', 'uses' => 'Admin\CustomerController@ajaxList']);
        Route::get('/add', ['as' => 'admin.customer.add', 'uses' => 'Admin\CustomerController@add']);
        Route::post('/add', ['as' => 'admin.customer.store', 'uses' => 'Admin\CustomerController@store']);
        Route::get('/edit/{id}', ['as' => 'admin.customer.edit', 'uses' => 'Admin\CustomerController@edit']);
        Route::post('/edit/{id}', ['as' => 'admin.customer.update', 'uses' => 'Admin\CustomerController@update']);
        Route::post('/update-status', ['as' => 'admin.customer.update-status', 'uses' => 'Admin\CustomerController@updateStatus']);   
        Route::post('/remove', ['as' => 'admin.customer.remove', 'uses' => 'Admin\CustomerController@remove']);   
      });

      Route::group(['prefix' => 'customerpackages'], function() {
        Route::get('/', ['as' => 'admin.customer.packages', 'uses' => 'Admin\CustomerPackagesController@index']);
        Route::get('/ajax-list', ['as' => 'admin.customer.packages.ajax-list', 'uses' => 'Admin\CustomerPackagesController@ajaxList']);
        Route::get('/add', ['as' => 'admin.customer.packages.add', 'uses' => 'Admin\CustomerPackagesController@add']);
        Route::post('/add', ['as' => 'admin.customer.packages.store', 'uses' => 'Admin\CustomerPackagesController@store']);
        Route::get('/edit/{id}', ['as' => 'admin.customer.packages.edit', 'uses' => 'Admin\CustomerPackagesController@edit']);
        Route::post('/edit/{id}', ['as' => 'admin.customer.packages.update', 'uses' => 'Admin\CustomerPackagesController@update']);
        Route::post('/update-status', ['as' => 'admin.customer.packages.update-status', 'uses' => 'Admin\CustomerPackagesController@updateStatus']);   
        Route::post('/remove', ['as' => 'admin.customer.packages.remove', 'uses' => 'Admin\CustomerPackagesController@remove']);   
      });
      
      Route::group(['prefix' => 'spadata'], function() {
        Route::get('/', ['as' => 'admin.customer.data', 'uses' => 'Admin\SpaDataController@index']);
        Route::get('/ajax-list', ['as' => 'admin.customer.data.ajax-list', 'uses' => 'Admin\SpaDataController@ajaxList']);
        Route::post('/update-status', ['as' => 'admin.customer.data.update-status', 'uses' => 'Admin\SpaDataController@updateStatus']);   
        Route::post('/remove', ['as' => 'admin.customer.data.remove', 'uses' => 'Admin\SpaDataController@remove']);   
      });

});
