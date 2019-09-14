<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('auth.login');
Route::post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
Route::get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
Route::patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
   // Route::get('/home', 'HomeController@index');
    Route::get('/reports/sum-usage', 'Admin\ReportsController@sumUsage');
    Route::get('/home', 'HomeController@avgUsage');
    Route::get('/reports/sum-cost', 'Admin\ReportsController@sumCost');
    Route::get('/reports/avg-usage-month', 'Admin\ReportsController@avgUsageMonth');


    Route::resource('permissions', 'Admin\PermissionsController');
    Route::post('permissions_mass_destroy', ['uses' => 'Admin\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('consumptions', 'Admin\ConsumptionsController');
    Route::post('consumptions_mass_destroy', ['uses' => 'Admin\ConsumptionsController@massDestroy', 'as' => 'consumptions.mass_destroy']);
    Route::post('consumptions_restore/{id}', ['uses' => 'Admin\ConsumptionsController@restore', 'as' => 'consumptions.restore']);
    Route::delete('consumptions_perma_del/{id}', ['uses' => 'Admin\ConsumptionsController@perma_del', 'as' => 'consumptions.perma_del']);
    Route::resource('alerts', 'Admin\AlertsController');
    Route::post('alerts_mass_destroy', ['uses' => 'Admin\AlertsController@massDestroy', 'as' => 'alerts.mass_destroy']);
    Route::post('alerts_restore/{id}', ['uses' => 'Admin\AlertsController@restore', 'as' => 'alerts.restore']);
    Route::delete('alerts_perma_del/{id}', ['uses' => 'Admin\AlertsController@perma_del', 'as' => 'alerts.perma_del']);
    Route::resource('controls', 'Admin\ControlsController');
    Route::post('controls_mass_destroy', ['uses' => 'Admin\ControlsController@massDestroy', 'as' => 'controls.mass_destroy']);
    Route::post('controls_restore/{id}', ['uses' => 'Admin\ControlsController@restore', 'as' => 'controls.restore']);
    Route::delete('controls_perma_del/{id}', ['uses' => 'Admin\ControlsController@perma_del', 'as' => 'controls.perma_del']);




});
