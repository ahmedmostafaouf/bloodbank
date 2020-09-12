<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware'=>['api','checkPassword'],'namespace'=>'Api'],function (){
   Route::post('get-cities','MainController@getCities');
   Route::post('test-notify','MainController@test_notification');
   Route::get('get-governorate','MainController@getGovernorate');
    Route::group(['prefix'=>'client','namespace'=>'Client'],function (){
        Route::post('register','AuthController@register');
        Route::post('login','AuthController@login');
        Route::post('me','AuthController@me');
        Route::post('rest-password','AuthController@rest_password');
        Route::post('forget-password','AuthController@forget_password');
        Route::post('register_token','AuthController@register_token');
        Route::post('remove-token','AuthController@remove_token');
    });
});
Route::group(['middleware'=>['api','checkPassword','checkClientToken:clients-api'],'namespace'=>'Api'],function (){
    Route::post('posts','MainController@posts');
    Route::post('profile','MainController@profile');
    Route::post('notificationSetting','MainController@notificationSetting');
    Route::post('PostFavorites','MainController@PostFavorites');
    Route::post('myFavorites','MainController@myFavorites');
    Route::post('notifications','MainController@notifications');
    Route::post('contacts','MainController@contacts');
    Route::post('donationRequest','MainController@donation_request');

});


