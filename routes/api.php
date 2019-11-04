<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1', 'namespace' => 'Api'],function(){

              Route::post('register', 'AuthController@register');
              Route::post('login', 'AuthController@login');
              Route::post('reset-password', 'AuthController@resetPassword');
              Route::post('new-password', 'AuthController@newPassword');

              Route::get('governorates', 'MainController@governorates');
              Route::get('cities', 'MainController@cities');


Route::group(['middleware' => 'auth:api'], function () {
               Route::post('toggle-favourite', 'MainController@toggleFavourites');
               Route::post('profile-edit', 'MainController@profileEdit');
               Route::post('notification_setting', 'MainController@notification_setting');
               Route::post('favourites', 'MainController@favourites');
               Route::post('donation-request-create', 'MainController@donationRequest');
               Route::post('search-by-category', 'MainController@searchByCategory');
               Route::post('post-details', 'MainController@postDetails');
               Route::post('contact-us', 'MainController@contactUs');
               Route::get('settings', 'MainController@settings');
               Route::get('posts', 'MainController@posts');
               Route::get('categories', 'MainController@categories');
               Route::get('donations', 'MainController@donations');
               Route::post('donation-details', 'MainController@donationDetails');
               Route::post('registerToken', 'AuthController@registerToken');
               Route::post('removeToken', 'AuthController@removeToken');
    });
});
