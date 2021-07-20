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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('systems', 'SystemController');
Route::post('company-settings', 'SystemController@saveCompanySettings')->name('company.settings');
Route::get('company-setting', 'SystemController@companyIndex')->name('company.setting');
Route::get('profile', 'UserController@profile')->name('profile');
Route::put('edit-profile', 'UserController@editprofile')->name('update.account');
Route::put('change-password', 'UserController@updatePassword')->name('update.password-profile');
Route::resource('module', 'ModuleController');
Route::post('detach-permission/{role_id}', 'PermissionController@detachPermission')->name('permission.detach');
Route::post('attach-permission/{role_id}', 'PermissionController@attachPermission')->name('permission.attach');
Route::resource('permission', 'PermissionController');
Route::get('user/{user}/update-passowrd', 'UserController@reset_password')->name('reset.password');
Route::post('user/update-password/{user}', 'UserController@updatePass')->name('update.password');
Route::resource('user', 'UserController');
Route::resource('nasabah', 'NasabahController');
Route::resource('role', 'RoleController');
