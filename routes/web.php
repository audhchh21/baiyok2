<?php
/**
 *  Main Route
 */
Route::get('/', function () {
    return redirect()->route('login');
})->middleware('CheckLogin');

/**
* Admin Route
*/
Route::group(['prefix' => 'admin','middleware' => ['auth', 'AdminLogin']], function () {
    Route::get('dashboard', 'HomeController@adminDashboard')->name('admin.dashboard');
    Route::group(['prefix' => 'city'], function () {
        Route::group(['prefix' => 'province'], function () {
            Route::get('', 'ProvinceController@provinceMain')->name('admin.province');
            Route::get('edit/{id}', 'ProvinceController@provinceEdit')->name('admin.province.edit');
        });
        Route::group(['prefix' => 'district'], function () {
            Route::get('', 'DistrictController@districtMain')->name('admin.district');
            Route::get('edit/{id}', 'DistrictController@districtEdit')->name('admin.district.edit');
        });
        Route::group(['prefix' => 'subdistrict'], function () {
            Route::get('', 'SubdistrictConttroller@subdistrictMain')->name('admin.subdistrict');
            Route::get('edit/{id}', 'SubdistrictConttroller@subdistrictEdit')->name('admin.subdistrict.edit');
        });
    });
    Route::group(['prefix' => 'office'], function () {
        Route::get('', 'OfficeController@officeMain')->name('admin.office');
        Route::get('create', 'OfficeController@officeCreate')->name('admin.office.create');
        Route::get('edit/{id}', 'OfficeController@officeEdit')->name('admin.office.edit');
    });
    Route::group(['prefix' => 'profile'], function () {
        Route::get('', 'ProfileController@profileMain')->name('admin.profile');
        Route::get('edit/{id}', 'ProfileController@profileEdit')->name('admin.profile.edit');
    });
    Route::group(['prefix' => 'titlename'], function () {
        Route::get('', 'TitlenameController@titlenameMain')->name('admin.titlename');
        Route::get('create', 'TitlenameController@titlenameCreate')->name('admin.titlename.create');
        Route::get('edit/{id}', 'TitlenameController@titlenameEdit')->name('admin.titlename.edit');
    });
    Route::group(['prefix' => 'user'], function () {
        Route::get('', 'UserController@userMain')->name('admin.user');
        Route::get('create', 'UserController@userCreate')->name('admin.user.create');
        Route::get('edit/{id}', 'UserController@userEdit')->name('admin.user.edit');
    });
    // Route::group(['prefix' => ''], function () {
    //     Route::get('', '')->name('');
    // });
});

/**
* Manager Route
*/
Route::group(['prefix' => 'manager','middleware' => ['auth', 'ManagerLogin']], function () {
    Route::get('dashboard', 'HomeController@managerDashboard')->name('manager.dashboard');
    Route::group(['prefix' => 'profile'], function () {
        Route::get('', 'ProfileController@profileMain')->name('manager.profile');
        Route::get('', 'ProfileController@profileEdit')->name('manager.profile.edit');
    });
    // Route::group(['prefix' => ''], function () {
    //     Route::get('', '')->name('');
    // });
});

/**
* Member Route
*/
Route::group(['prefix' => 'member','middleware' => ['auth', 'MemberLogin']], function () {
    Route::get('dashboard', 'HomeController@memberDashboard')->name('member.dashboard');
    Route::group(['prefix' => 'foodsample'], function () {
        Route::get('', 'FoodsampleController@foodsampleMain')->name('member.foodsample');
        Route::get('edit/{id}', 'FoodsampleController@foodsampleEdit')->name('member.foodsample.edit');
    });
    Route::group(['prefix' => 'foodsamplesource'], function () {
        Route::get('', 'FoodsamplesourceController@foodsamplesourceMain')->name('member.foodsamplesource');
        Route::get('edit/{id}', 'FoodsamplesourceController@foodsamplesourceEdit')->name('member.foodsamplesource.edit');
    });
    Route::group(['prefix' => 'foodtestkit'], function () {
        Route::get('', 'FoodtestkitController@foodtestkitMain')->name('member.foodtestkit');
        Route::get('edit/{id}', 'FoodtestkitController@foodtestkitEdit')->name('member.foodtestkit.edit');
    });
    Route::group(['prefix' => 'inspection'], function () {
        Route::get('', 'InspectionConntroller@inspectionMain')->name('member.inspection');
        Route::get('create', 'InspectionConntroller@inspectionCreate')->name('member.inspection.create');
        Route::get('edit/{id}', 'InspectionConntroller@inspectionEdit')->name('member.inspection.edit');
    });
    Route::group(['prefix' => 'plan'], function () {
        Route::get('', 'PlanController@planMain')->name('member.plan');
        Route::get('create', 'PlanController@planCreate')->name('member.plan.create');
        Route::get('edit/{id}', 'PlanController@planEdit')->name('member.plan.edit');
    });
    Route::group(['prefix' => 'profile'], function () {
        Route::get('', 'ProfileController@profileMain')->name('member.profile');
        Route::get('edit/{id}', 'ProfileController@profileEdit')->name('member.profile.edit');
    });
    Route::group(['prefix' => 'shop'], function () {
        Route::get('', 'ShopController@shopMain')->name('member.shop');
        Route::get('create', 'ShopController@shopCreate')->name('member.shop.create');
        Route::get('edit/{id}', 'ShopController@shopEdit')->name('member.shop.edit');
    });
    // Route::group(['prefix' => ''], function () {
    //     Route::get('', '')->name('');
    // });
});

/**
 * Login Route
 */
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

/**
 * Register Route
 */
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

/**
 * Password Reset Route
 */
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

/**
 * Email Verification Route
 */
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
