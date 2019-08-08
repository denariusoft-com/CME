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


Route::group(['middleware' => ['auth']], function() {
    Route::post('/settings/companysetting', 'SettingController@saveCompanysetting');
    Route::get('settings/themesettings', 'SettingController@themesettings');
    Route::resource('settings','SettingController');
   
  //  Route::resource('settings/themesettings', 'SettingController@themesettings');
   
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
  
});
Route::resource('clients', 'ClientController');