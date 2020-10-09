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

Route::get('logout' , 'Auth\LoginController@clientLogout')->name('client-logout');

Route::group(['namespace'=>'Front','middleware'=>'auth:web'],function () {
    Route::get('Posts', 'MainController@posts')->name('posts');
    Route::get('details-Posts/{id}', 'MainController@postDetails')->name('details-posts');
    Route::post('toggle-favourite' , 'MainController@toggleFavourite')->name('toggle-favourite');
    Route::get('contact' , 'MainController@getContact')->name('contact.me');
    Route::post('contact' , 'MainController@contact')->name('push.contact');
    Route::get('postsFavorites' , 'MainController@getPostFavorites')->name('get.post.fav');
    Route::get('profile' , 'MainController@getProfile')->name('get.client.profile');
    Route::post('editProfile' , 'MainController@editProfile')->name('edit.client.profile');
    Route::get('donation' , 'MainController@donation')->name('client.donation');
});
Route::group(['namespace'=>'Front'],function (){
    Route::get('logins','LoginController@getClientLogin')->name('get.front.login');
    Route::post('logins','LoginController@Login')->name('front.login');
    Route::get('registers','RegisterController@getClientRegister')->name('get.front.register');
    Route::post('registers','RegisterController@Register')->name('front.register');
    Route::get('/home', 'MainController@home')->name('client-home');
    Route::get('about-us', 'MainController@about')->name('about.us');


});




Auth::routes();
