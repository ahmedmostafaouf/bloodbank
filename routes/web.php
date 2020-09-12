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


Route::group(['namespace'=>'Front','middleware'=>'auth:web'],function () {
    Route::get('Posts', 'MainController@posts')->name('posts');
    Route::get('details-Posts/{id}', 'MainController@postDetails')->name('details-posts');

});
Route::group(['namespace'=>'Front'],function (){
    Route::get('logins','LoginController@getClientLogin')->name('get.front.login');
    Route::post('logins','LoginController@Login')->name('front.login');
    Route::get('/home', 'MainController@home')->name('client-home');
    Route::get('about-us', 'MainController@about')->name('about.us');


});




Auth::routes();
