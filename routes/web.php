<?php
/**
 *  Main Route
 */
Route::get('/', function () {
    return redirect()->route('login');
})->middleware('CheckLogin');

Route::get('unlogin', function () {
    return view('auth.unlogin');
})->name('unlogin');

/**
* Admin Route
*/
Route::group(['prefix' => 'admin','middleware' => ['auth', 'AdminLogin']], function () {
    Route::get('dashboard', 'HomeController@adminDashboard')->name('admin.dashboard');
    Route::post('up/status', 'HomeController@userSuccess')->name('admin.up.status');
    Route::post('down/status', 'HomeController@userUnsuccess')->name('admin.down.status');
    Route::group(['prefix' => 'city'], function () {
        Route::group(['prefix' => 'province'], function () {
            Route::get('', 'ProvinceController@provinceMain')->name('admin.province');
            Route::get('edit/{id}', 'ProvinceController@provinceEdit')->name('admin.province.edit');
            Route::post('store', 'ProvinceController@provinceStore')->name('admin.province.store');
            Route::post('update/{id}', 'ProvinceController@provinceUpdate')->name('admin.province.update');
            Route::get('delete/{id}', 'ProvinceController@provinceDelete')->name('admin.province.delete');
        });
        Route::group(['prefix' => 'district'], function () {
            Route::get('', 'DistrictController@districtMain')->name('admin.district');
            Route::get('edit/{id}', 'DistrictController@districtEdit')->name('admin.district.edit');
            Route::post('store', 'DistrictController@districtStore')->name('admin.district.store');
            Route::post('update/{id}', 'DistrictController@districtUpdate')->name('admin.district.update');
            Route::get('delete/{id}', 'DistrictController@districtDelete')->name('admin.district.delete');
        });
        Route::group(['prefix' => 'subdistrict'], function () {
            Route::get('', 'SubdistrictController@subdistrictMain')->name('admin.subdistrict');
            Route::get('edit/{id}', 'SubdistrictController@subdistrictEdit')->name('admin.subdistrict.edit');
            Route::post('store', 'SubdistrictController@subdistrictStore')->name('admin.subdistrict.store');
            Route::post('update/{id}', 'SubdistrictController@subdistrictUpdate')->name('admin.subdistrict.update');
            Route::get('delete/{id}', 'SubdistrictController@subdistrictDelete')->name('admin.subdistrict.delete');
        });
    });
    Route::group(['prefix' => 'office'], function () {
        Route::get('', 'OfficeController@officeMain')->name('admin.office');
        Route::get('create', 'OfficeController@officeCreate')->name('admin.office.create');
        Route::get('edit/{id}', 'OfficeController@officeEdit')->name('admin.office.edit');
        Route::post('store', 'OfficeController@officeStore')->name('admin.office.store');
        Route::post('update/{id}', 'OfficeController@officeUpdate')->name('admin.office.update');
        Route::get('delete/{id}', 'OfficeController@officeDelete')->name('admin.office.delete');
    });
    Route::group(['prefix' => 'profile'], function () {
        Route::get('', 'ProfileController@profileMain')->name('admin.profile');
        Route::get('edit', 'ProfileController@profileEdit')->name('admin.profile.edit');
        Route::get('password', 'ProfileController@profilePassword')->name('admin.profile.password');
        Route::post('update/{id}', 'ProfileController@profileUpdate')->name('admin.profile.update');
        Route::post('password/re', 'ProfileController@profilePasswordReset')->name('admin.profile.password.update');
    });
    Route::group(['prefix' => 'titlename'], function () {
        Route::get('', 'TitlenameController@titlenameMain')->name('admin.titlename');
        Route::get('create', 'TitlenameController@titlenameCreate')->name('admin.titlename.create');
        Route::get('edit/{id}', 'TitlenameController@titlenameEdit')->name('admin.titlename.edit');
        Route::post('store', 'TitlenameController@titlenameStore')->name('admin.titlename.store');
        Route::post('update/{id}', 'TitlenameController@titlenameUpdate')->name('admin.titlename.update');
        Route::get('delete/{id}', 'TitlenameController@titlenameDelete')->name('admin.titlename.delete');
    });
    Route::group(['prefix' => 'user'], function () {
        Route::get('', 'UserController@userMain')->name('admin.user');
        Route::get('create', 'UserController@userCreate')->name('admin.user.create');
        Route::get('edit/{id}', 'UserController@userEdit')->name('admin.user.edit');
        Route::post('store', 'UserController@userStore')->name('admin.user.store');
        Route::post('update/{id}', 'UserController@userUpdate')->name('admin.user.update');
        Route::get('delete/{id}', 'UserController@userDelete')->name('admin.user.delete');
    });
    // New Route Group
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
    // New Route Group
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
        Route::post('store', 'FoodsampleController@foodsampleStore')->name('member.foodsample.store');
        Route::post('update/{id}', 'FoodsampleController@foodsampleUpdate')->name('member.foodsample.update');
        Route::get('delete/{id}', 'FoodsampleController@foodsampleDelete')->name('member.foodsample.delete');
    });
    Route::group(['prefix' => 'foodsamplesource'], function () {
        Route::get('', 'FoodsamplesourceController@foodsamplesourceMain')->name('member.foodsamplesource');
        Route::get('edit/{id}', 'FoodsamplesourceController@foodsamplesourceEdit')->name('member.foodsamplesource.edit');
        Route::post('store', 'FoodsamplesourceController@foodsamplesourceStore')->name('member.foodsamplesource.store');
        Route::post('update/{id}', 'FoodsamplesourceController@foodsamplesourceUpdate')->name('member.foodsamplesource.update');
        Route::get('delete/{id}', 'FoodsamplesourceController@foodsamplesourceDelete')->name('member.foodsamplesource.delete');
    });
    Route::group(['prefix' => 'foodtestkit'], function () {
        Route::get('', 'FoodtestkitController@foodtestkitMain')->name('member.foodtestkit');
        Route::get('edit/{id}', 'FoodtestkitController@foodtestkitEdit')->name('member.foodtestkit.edit');
        Route::post('store', 'FoodtestkitController@foodtestkitStore')->name('member.foodtestkit.store');
        Route::post('update/{id}', 'FoodtestkitController@foodtestkitUpdate')->name('member.foodtestkit.update');
        Route::get('delete/{id}', 'FoodtestkitController@foodtestkitDelete')->name('member.foodtestkit.delete');
    });
    Route::group(['prefix' => 'inspection'], function () {
        Route::get('', 'InspectionController@inspectionAll')->name('member.inspection');
        Route::get('create', 'InspectionController@inspectionCreate')->name('member.inspection.create');
        Route::get('edit/{id}', 'InspectionController@inspectionEdit')->name('member.inspection.edit');
        Route::post('store', 'InspectionController@inspectionStore')->name('member.inspection.store');
        Route::post('update/{id}', 'InspectionController@inspectionUpdate')->name('member.inspection.update');
        Route::get('delete/{id}', 'InspectionController@inspectionDelete')->name('member.inspection.delete');
    });
    Route::group(['prefix' => 'inspectiondetail'], function () {
        Route::get('{id}/check', 'InspectiondetailController@inspectiondetailCheck')->name('member.inspectiondetail.check');
        Route::get('{id}/edit', 'InspectiondetailController@inspectiondetailEdit')->name('member.inspectiondetail.edit');
        Route::post('{id}/confirm', 'InspectiondetailController@inspectiondetailConfirm')->name('member.inspectiondetail.confirm');
        Route::post('{id}/update', 'InspectiondetailController@inspectiondetailUpdate')->name('member.inspectiondetail.update');
    });
    Route::group(['prefix' => 'plan'], function () {
        Route::get('', 'PlanController@planMain')->name('member.plan');
        Route::get('create', 'PlanController@planCreate')->name('member.plan.create');
        Route::get('edit/{id}', 'PlanController@planEdit')->name('member.plan.edit');
        Route::post('store', 'PlanController@planStore')->name('member.plan.store');
        Route::post('update/{id}', 'PlanController@planUpdate')->name('member.plan.update');
        Route::get('delete/{id}', 'PlanController@planDelete')->name('member.plan.delete');
    });
    Route::group(['prefix' => 'profile'], function () {
        Route::get('', 'ProfileController@profileMain')->name('member.profile');
        Route::get('edit/{id}', 'ProfileController@profileEdit')->name('member.profile.edit');
        Route::post('store', 'ProfileController@profileStore')->name('member.profile.store');
        Route::post('update/{id}', 'ProfileController@profileUpdate')->name('member.profile.update');
        Route::get('delete/{id}', 'ProfileController@profileDelete')->name('member.profile.delete');
    });
    Route::group(['prefix' => 'shop'], function () {
        Route::get('', 'ShopController@shopMain')->name('member.shop');
        Route::get('create', 'ShopController@shopCreate')->name('member.shop.create');
        Route::get('edit/{id}', 'ShopController@shopEdit')->name('member.shop.edit');
        Route::post('store', 'ShopController@shopStore')->name('member.shop.store');
        Route::post('update/{id}', 'ShopController@shopUpdate')->name('member.shop.update');
        Route::get('delete/{id}', 'ShopController@shopDelete')->name('member.shop.delete');

    });
    // New Route Group
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
