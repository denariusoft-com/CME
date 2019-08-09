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
    //settings
    Route::post('/settings/companysetting', 'SettingController@saveCompanysetting');
    Route::get('settings/themesettings', 'SettingController@themesettings');
    Route::post('/settings/themesettingsave', 'SettingController@themesettingsave');
    Route::resource('settings','SettingController');
   
    //Reports
    Route::resource('reports','ReportController');

    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
  
});
Route::resource('clients', 'ClientController')->except([
    'create', 'show', 'edit', 'update'
]);
Route::post('get_client_list', 'ClientController@get_client_list');
Route::get('get_client_detail', 'ClientController@get_client_detail');
Route::get('findClientNameExists', 'ClientController@findNameExists');

Route::resource('rates', 'RateController')->except([
    'create', 'show', 'edit', 'update'
]);
Route::post('get_rate_list', 'RateController@get_rate_list');
Route::get('get_rate_detail', 'RateController@get_rate_detail');
Route::get('findRateNameExists', 'RateController@findNameExists');

Route::resource('categories', 'CategoryController')->except([
    'create', 'show', 'edit', 'update'
]);
Route::post('get_category_list', 'CategoryController@get_category_list');
Route::get('get_category_detail', 'CategoryController@get_category_detail');
Route::get('findCategoryNameExists', 'CategoryController@findNameExists');

Route::resource('statuses', 'StatusController')->except([
    'create', 'show', 'edit', 'update'
]);
Route::post('get_status_list', 'StatusController@get_status_list');
Route::get('get_status_detail', 'StatusController@get_status_detail');
Route::get('findStatusNameExists', 'StatusController@findNameExists');

Route::resource('ratemasters', 'RatemasterController')->except([
    'create', 'show', 'edit', 'update'
]);
Route::post('get_ratemaster_list', 'RatemasterController@get_ratemaster_list');
Route::get('get_ratemaster_detail', 'RatemasterController@get_ratemaster_detail');
Route::get('findRatemasterNameExists', 'RatemasterController@findNameExists');

Route::resource('mooring_masters', 'MooringMasterController')->except([
    'show', 'edit', 'update'
]);
Route::post('get_mooringmaster_list', 'MooringMasterController@get_mooringmaster_list');
Route::get('get_mooringmaster_detail', 'MooringMasterController@get_mooringmaster_detail');
Route::get('findMooringMasterNameExists', 'MooringMasterController@findNameExists');
Route::get('get-rate-list', 'MooringMasterController@getRateList');
