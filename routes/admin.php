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

    Route::group(['prefix' => 'slider'], function() {
      Route::get('/', ['as' => 'admin.slider', 'uses' => 'Admin\SliderController@index']);
      Route::get('/ajax-list', ['as' => 'admin.slider.ajax-list', 'uses' => 'Admin\SliderController@ajaxList']);
      Route::get('/add', ['as' => 'admin.slider.add', 'uses' => 'Admin\SliderController@add']);
      Route::post('/add', ['as' => 'admin.slider.store', 'uses' => 'Admin\SliderController@store']);
      Route::get('/edit/{id}', ['as' => 'admin.slider.edit', 'uses' => 'Admin\SliderController@edit']);
      Route::post('/edit/{id}', ['as' => 'admin.slider.update', 'uses' => 'Admin\SliderController@update']);
      Route::post('/update-status', ['as' => 'admin.slider.update-status', 'uses' => 'Admin\SliderController@updateStatus']);   
      Route::post('/remove', ['as' => 'admin.slider.remove', 'uses' => 'Admin\SliderController@remove']);   
      Route::post('/check-display-order', ['as' => 'admin.check-display-order', 'uses' => 'Admin\SliderController@displayorder']);
  });
  
  Route::group(['prefix' => 'pages'], function() {
    Route::get('/', ['as' => 'admin.pages', 'uses' => 'Admin\PagesController@index']);
    Route::get('/ajax-list', ['as' => 'admin.pages.ajax-list', 'uses' => 'Admin\PagesController@ajaxList']);
    Route::get('/edit/{id}', ['as' => 'admin.pages.edit', 'uses' => 'Admin\PagesController@edit']);
    Route::post('/edit/{id}', ['as' => 'admin.pages.update', 'uses' => 'Admin\PagesController@update']);
    Route::post('/update-status', ['as' => 'admin.pages.update-status', 'uses' => 'Admin\PagesController@updateStatus']);   
});

Route::group(['prefix' => 'enquiry'], function() {
  Route::get('/', ['as' => 'admin.enquiry', 'uses' => 'Admin\EnquiryController@index']);
  Route::get('/ajax-list', ['as' => 'admin.enquiry.ajax-list', 'uses' => 'Admin\EnquiryController@ajaxList']);
  Route::get('/add', ['as' => 'admin.enquiry.add', 'uses' => 'Admin\EnquiryController@add']);
  Route::post('/add', ['as' => 'admin.enquiry.store', 'uses' => 'Admin\EnquiryController@store']);
  Route::get('/edit/{id}', ['as' => 'admin.enquiry.edit', 'uses' => 'Admin\EnquiryController@edit']);
  Route::post('/edit/{id}', ['as' => 'admin.enquiry.update', 'uses' => 'Admin\EnquiryController@update']);
  Route::post('/remove', ['as' => 'admin.enquiry.remove', 'uses' => 'Admin\EnquiryController@remove']); 
  Route::get('/view', ['as' => 'admin.enquiry.enuiryview', 'uses' => 'Admin\EnquiryController@view']);  
});

Route::group(['prefix' => 'product'], function() {
  Route::get('/', ['as' => 'admin.product', 'uses' => 'Admin\ProductController@index']);
  Route::get('/ajax-list', ['as' => 'admin.product.ajax-list', 'uses' => 'Admin\ProductController@ajaxList']);
  Route::get('/add', ['as' => 'admin.product.add', 'uses' => 'Admin\ProductController@add']);
  Route::post('/add', ['as' => 'admin.product.store', 'uses' => 'Admin\ProductController@store']);
  Route::get('/edit/{id}', ['as' => 'admin.product.edit', 'uses' => 'Admin\ProductController@edit']);
  Route::post('/edit/{id}', ['as' => 'admin.product.update', 'uses' => 'Admin\ProductController@update']);
  Route::post('/metainfo/edit/{id}', ['as' => 'admin.metainfo.update', 'uses' => 'Admin\ProductController@metainfoupdate']);
  Route::post('/image/edit/{id}', ['as' => 'admin.image.update', 'uses' => 'Admin\ProductController@imageupdate']); 
  Route::post('/update-status', ['as' => 'admin.product.update-status', 'uses' => 'Admin\ProductController@updateStatus']);   
  Route::post('/remove', ['as' => 'admin.product.remove', 'uses' => 'Admin\ProductController@remove']);
  Route::post('/image/remove', ['as' => 'admin.image.remove', 'uses' => 'Admin\ProductController@imageremove']);
  Route::post('/slug', ['as' => 'admin.product.slug', 'uses' => 'Admin\ProductController@slug']);
  Route::post('/image/displayorder', ['as' => 'admin.image.updateDisplayOrder', 'uses' => 'Admin\ProductController@displayorder']); 
  Route::post('/image/ismain', ['as' => 'admin.product.imagemain', 'uses' => 'Admin\ProductController@ismainimage']);
  Route::post('/technical/specifications/{id}', ['as' => 'admin.technicalspecifications.update', 'uses' => 'Admin\ProductController@technicalSpecifications']);

  Route::get('/import/old', ['as' => 'admin.product.import-old', 'uses' => 'Admin\ProductController@importOld']);
});

Route::group(['prefix' => 'gallery'], function() {
  Route::get('/', ['as' => 'admin.gallery', 'uses' => 'Admin\GalleryController@index']);
  Route::get('/ajax-list', ['as' => 'admin.gallery.ajax-list', 'uses' => 'Admin\GalleryController@ajaxList']);
  Route::get('/add', ['as' => 'admin.gallery.add', 'uses' => 'Admin\GalleryController@add']);
  Route::post('/add', ['as' => 'admin.gallery.store', 'uses' => 'Admin\GalleryController@store']);
  Route::get('/edit/{id}', ['as' => 'admin.gallery.edit', 'uses' => 'Admin\GalleryController@edit']);
  Route::post('/edit/{id}', ['as' => 'admin.gallery.update', 'uses' => 'Admin\GalleryController@update']);
  Route::post('/update-status', ['as' => 'admin.gallery.update-status', 'uses' => 'Admin\GalleryController@updateStatus']);   
  Route::post('/remove', ['as' => 'admin.gallery.remove', 'uses' => 'Admin\GalleryController@remove']);   
  Route::post('/check-display-order', ['as' => 'admin.gallery.check-display-order', 'uses' => 'Admin\GalleryController@displayorder']);
});

Route::group(['prefix' => 'logo'], function() {
  Route::get('/', ['as' => 'admin.logo', 'uses' => 'Admin\LogoController@index']);
  Route::get('/ajax-list', ['as' => 'admin.logo.ajax-list', 'uses' => 'Admin\LogoController@ajaxList']);
  Route::get('/add', ['as' => 'admin.logo.add', 'uses' => 'Admin\LogoController@add']);
  Route::post('/add', ['as' => 'admin.logo.store', 'uses' => 'Admin\LogoController@store']);
  Route::get('/edit/{id}', ['as' => 'admin.logo.edit', 'uses' => 'Admin\LogoController@edit']);
  Route::post('/edit/{id}', ['as' => 'admin.logo.update', 'uses' => 'Admin\LogoController@update']);
  Route::post('/update-status', ['as' => 'admin.logo.update-status', 'uses' => 'Admin\LogoController@updateStatus']);   
  Route::post('/remove', ['as' => 'admin.logo.remove', 'uses' => 'Admin\LogoController@remove']);   
  Route::post('/check-display-order', ['as' => 'admin.logo.check-display-order', 'uses' => 'Admin\LogoController@displayorder']);
});


Route::group(['prefix' => 'product'], function() {
  Route::group(['prefix' => 'type'], function() {
    Route::get('/', ['as' => 'admin.product.type', 'uses' => 'Admin\ProductTypeController@index']);
    Route::get('/ajax-list', ['as' => 'admin.product.type.ajax-list', 'uses' => 'Admin\ProductTypeController@ajaxList']);
    Route::get('/add', ['as' => 'admin.product.type.add', 'uses' => 'Admin\ProductTypeController@add']);
    Route::post('/add', ['as' => 'admin.product.type.store', 'uses' => 'Admin\ProductTypeController@store']);
    Route::get('/edit/{id}', ['as' => 'admin.product.type.edit', 'uses' => 'Admin\ProductTypeController@edit']);
    Route::post('/edit/{id}', ['as' => 'admin.product.type.update', 'uses' => 'Admin\ProductTypeController@update']);
    Route::post('/remove', ['as' => 'admin.product.type.remove', 'uses' => 'Admin\ProductTypeController@remove']); 
    Route::post('/update-status', ['as' => 'admin.product.type.update-status', 'uses' => 'Admin\ProductTypeController@updateStatus']);
    Route::post('/check-name', ['as' => 'admin.product.type.check-name', 'uses' => 'Admin\ProductTypeController@checkName']);
  });
  Route::group(['prefix' => 'usein'], function() {
    Route::get('/', ['as' => 'admin.product.usein', 'uses' => 'Admin\ProductUseinController@index']);
    Route::get('/ajax-list', ['as' => 'admin.product.usein.ajax-list', 'uses' => 'Admin\ProductUseinController@ajaxList']);
    Route::get('/add', ['as' => 'admin.product.usein.add', 'uses' => 'Admin\ProductUseinController@add']);
    Route::post('/add', ['as' => 'admin.product.usein.store', 'uses' => 'Admin\ProductUseinController@store']);
    Route::get('/edit/{id}', ['as' => 'admin.product.usein.edit', 'uses' => 'Admin\ProductUseinController@edit']);
    Route::post('/edit/{id}', ['as' => 'admin.product.usein.update', 'uses' => 'Admin\ProductUseinController@update']);
    Route::post('/remove', ['as' => 'admin.product.usein.remove', 'uses' => 'Admin\ProductUseinController@remove']);
    Route::post('/update-status', ['as' => 'admin.product.usein.update-status', 'uses' => 'Admin\ProductUseinController@updateStatus']);
    Route::post('/check-name', ['as' => 'admin.product.usein.check-name', 'uses' => 'Admin\ProductUseinController@checkName']); 
  });
  Route::group(['prefix' => 'usetype'], function() {
    Route::get('/', ['as' => 'admin.product.usetype', 'uses' => 'Admin\ProductUsetypeController@index']);
    Route::get('/ajax-list', ['as' => 'admin.product.usetype.ajax-list', 'uses' => 'Admin\ProductUsetypeController@ajaxList']);
    Route::get('/add', ['as' => 'admin.product.usetype.add', 'uses' => 'Admin\ProductUsetypeController@add']);
    Route::post('/add', ['as' => 'admin.product.usetype.store', 'uses' => 'Admin\ProductUsetypeController@store']);
    Route::get('/edit/{id}', ['as' => 'admin.product.usetype.edit', 'uses' => 'Admin\ProductUsetypeController@edit']);
    Route::post('/edit/{id}', ['as' => 'admin.product.usetype.update', 'uses' => 'Admin\ProductUsetypeController@update']);
    Route::post('/remove', ['as' => 'admin.product.usetype.remove', 'uses' => 'Admin\ProductUsetypeController@remove']); 
    Route::post('/update-status', ['as' => 'admin.product.usetype.update-status', 'uses' => 'Admin\ProductUsetypeController@updateStatus']);
    Route::post('/check-name', ['as' => 'admin.product.usetype.check-name', 'uses' => 'Admin\ProductUsetypeController@checkName']);
  });
  Route::group(['prefix' => 'usage'], function() {
    Route::get('/', ['as' => 'admin.product.usage', 'uses' => 'Admin\ProductUsageController@index']);
    Route::get('/ajax-list', ['as' => 'admin.product.usage.ajax-list', 'uses' => 'Admin\ProductUsageController@ajaxList']);
    Route::get('/add', ['as' => 'admin.product.usage.add', 'uses' => 'Admin\ProductUsageController@add']);
    Route::post('/add', ['as' => 'admin.product.usage.store', 'uses' => 'Admin\ProductUsageController@store']);
    Route::get('/edit/{id}', ['as' => 'admin.product.usage.edit', 'uses' => 'Admin\ProductUsageController@edit']);
    Route::post('/edit/{id}', ['as' => 'admin.product.usage.update', 'uses' => 'Admin\ProductUsageController@update']);
    Route::post('/remove', ['as' => 'admin.product.usage.remove', 'uses' => 'Admin\ProductUsageController@remove']);
    Route::post('/update-status', ['as' => 'admin.product.usage.update-status', 'uses' => 'Admin\ProductUsageController@updateStatus']);
    Route::post('/check-name', ['as' => 'admin.product.usage.check-name', 'uses' => 'Admin\ProductUsageController@checkName']); 
  });
});

Route::group(['prefix' => 'home/category'], function() {
  Route::get('/', ['as' => 'admin.home.category', 'uses' => 'Admin\HomeCategoryController@index']);
  Route::get('/ajax-list', ['as' => 'admin.home.category.ajax-list', 'uses' => 'Admin\HomeCategoryController@ajaxList']);
  Route::get('/add', ['as' => 'admin.home.category.add', 'uses' => 'Admin\HomeCategoryController@add']);
  Route::post('/add', ['as' => 'admin.home.category.store', 'uses' => 'Admin\HomeCategoryController@store']);
  Route::get('/edit/{id}', ['as' => 'admin.home.category.edit', 'uses' => 'Admin\HomeCategoryController@edit']);
  Route::post('/edit/{id}', ['as' => 'admin.home.category.update', 'uses' => 'Admin\HomeCategoryController@update']);
  Route::post('/update-status', ['as' => 'admin.home.category.update-status', 'uses' => 'Admin\HomeCategoryController@updateStatus']);   
  Route::post('/remove', ['as' => 'admin.home.category.remove', 'uses' => 'Admin\HomeCategoryController@remove']);   
  Route::post('/check-display-order', ['as' => 'admin.home.category.check-display-order', 'uses' => 'Admin\HomeCategoryController@displayorder']);
  Route::post('/check-title', ['as' => 'admin.home.category.check-title', 'uses' => 'Admin\HomeCategoryController@checkTitle']);
});

Route::group(['prefix' => 'technical/specifications'], function() {
  Route::get('/', ['as' => 'admin.technical.specifications', 'uses' => 'Admin\TechnicalSpecificationsController@index']);
  Route::get('/ajax-list', ['as' => 'admin.technical.specifications.ajax-list', 'uses' => 'Admin\TechnicalSpecificationsController@ajaxList']);
  Route::get('/add', ['as' => 'admin.technical.specifications.add', 'uses' => 'Admin\TechnicalSpecificationsController@add']);
  Route::post('/add', ['as' => 'admin.technical.specifications.store', 'uses' => 'Admin\TechnicalSpecificationsController@store']);
  Route::get('/edit/{id}', ['as' => 'admin.technical.specifications.edit', 'uses' => 'Admin\TechnicalSpecificationsController@edit']);
  Route::post('/edit/{id}', ['as' => 'admin.technical.specifications.update', 'uses' => 'Admin\TechnicalSpecificationsController@update']);
  Route::post('/remove', ['as' => 'admin.technical.specifications.remove', 'uses' => 'Admin\TechnicalSpecificationsController@remove']); 
  Route::post('/update-status', ['as' => 'admin.technical.specifications.update-status', 'uses' => 'Admin\TechnicalSpecificationsController@updateStatus']);
  Route::post('/check-name', ['as' => 'admin.technical.specifications.check-name', 'uses' => 'Admin\TechnicalSpecificationsController@checkName']);
});

});
