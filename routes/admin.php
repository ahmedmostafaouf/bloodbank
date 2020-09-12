<?php

use Illuminate\Support\Facades\Route;


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

Route::get('logout' , 'Auth\LoginController@userLogout')->name('admin-logout');

  Route::group(['namespace'=>'Admin','middleware'=>'auth:admin','name'=>'dashboard.'],function (){
      Route::group(['prefix'=>'dashboard'],function (){
          Route::get('/','DashboardController@index')->name('admin.dashboard');
          Route::resource('governorates','GovernorateController')->except(['show']);
          Route::resource('cities','CityController')->except(['show']);
          Route::resource('blood-types','BloodTypeController')->except(['show']);
          Route::resource('category','CategoryController')->except(['show']);
          Route::resource('setting','SettingController')->except(['show','create','story','destroy']);
          Route::resource('reports','ContactController')->except(['show','create','story','edit','update']);
          Route::resource('post','PostController')->except(['show']);
          Route::resource('donation','DonationController')->except(['create'.'edit','story'.'update']);
          Route::resource('users','UserController')->except(['show']);
          Route::resource('clients','ClientController')->except(['show','edit','update','create','store']);
          Route::get('clients/{id}/status','ClientController@changeStatus')->name('clients.status');
          Route::get('changePassword','ChangePassController@change')->name('admin.change');
          Route::post('changePassword','ChangePassController@updateChange')->name('admin.update.change');

      });
  });


    Route::group(['namespace'=>'Admin','middleware'=>'guest:admin'],function (){
        Route::get('login','LoginController@getLogin')->name('get.admin.login');
        Route::post('login','LoginController@Login')->name('admin.login');

    });

