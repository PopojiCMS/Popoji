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

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth']], function () {
	Route::get('dashboard', 'Backend\BackendController@index');
	Route::get('forbidden', 'Backend\BackendController@forbidden');
	
	Route::get('dashboard/users/index', 'Backend\UsersController@index');
	Route::get('dashboard/users/table', 'Backend\UsersController@getIndex');
	Route::get('dashboard/users/data', 'Backend\UsersController@anyData');
	Route::get('dashboard/users/get-user','Backend\UsersController@getUser');
	Route::get('dashboard/users/get-user-not-me','Backend\UsersController@getUserNotMe');
	Route::post('dashboard/users/deleteall', 'Backend\UsersController@deleteAll');
	Route::resource('dashboard/users', 'Backend\UsersController');
	
	Route::get('dashboard/roles/index','Backend\RolesController@index');
	Route::get('dashboard/roles/table','Backend\RolesController@getIndex');
	Route::get('dashboard/roles/data','Backend\RolesController@anyData');
	Route::post('dashboard/roles/deleteall', 'Backend\RolesController@deleteAll');
	Route::resource('dashboard/roles', 'Backend\RolesController');
	
	Route::get('dashboard/permissions/index','Backend\PermissionsController@index');
	Route::get('dashboard/permissions/table','Backend\PermissionsController@getIndex');
	Route::get('dashboard/permissions/data','Backend\PermissionsController@anyData');
	Route::post('dashboard/permissions/deleteall', 'Backend\PermissionsController@deleteAll');
	Route::resource('dashboard/permissions', 'Backend\PermissionsController');
	
	Route::get('dashboard/settings/index','Backend\SettingsController@getIndex');
	Route::get('dashboard/settings/table','Backend\SettingsController@getIndex');
	Route::get('dashboard/settings/data','Backend\SettingsController@anyData');
	Route::post('dashboard/settings/deleteall', 'Backend\SettingsController@deleteAll');
	Route::resource('dashboard/settings', 'Backend\SettingsController');
});
