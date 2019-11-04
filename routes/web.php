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
Route::group(['namespace' => 'Front'], function() {

  Route::get('/', 'MainController@home')->name('index');
  Route::get('client-register', 'AuthController@register');
  Route::post('client-register', 'AuthController@registerClient');
  Route::get('client-login', 'AuthController@login');
  Route::post('client-login', 'AuthController@clientLogin');
  Route::get('articles', 'MainController@articles')->name('front.articles');
  Route::get('post/{id}', 'MainController@article')->name('front.post');
  Route::get('how-we-are', 'MainController@howWeAre')->name('front.howWeAre');
  Route::get('about', 'MainController@about')->name('front.about');
  Route::get('contact-us', 'MainController@contactus');
  Route::post('contact-us', 'MainController@contact_us');
  Route::get('donations', 'MainController@donations')->name('front.donations');
  Route::get('donations/{id}', 'MainController@donationDetails')->name('front.donation');

  Route::group([ 'middleware' => 'auth:client-web'], function() {   //
      Route::get('client-logout', 'AuthController@logout');
      Route::post('toggle-favourite', 'MainController@toggleFavourite')->name('toggle-favourite');
      Route::get('donation-request', 'MainController@donationRequest')->name('front.donations');
      Route::post('donation-request', 'MainController@createDonationRequest')->name('front.donations');

  });
});
// Route::get('/city-register/{governorate_id}', 'Controllers/Api/MainController@cities');
Auth::routes();



// Admin panel
Route::group(['prefix' => LaravelLocalization::setLocale(),
'middleware' => ['localeSessionRedirect','localizationRedirect','localeViewPath']] ,  function()
{
Route::group(['middleware' => ['auth','auto-check-permission'] , 'prefix' => 'admin'] , function(){
      Route::get('/home', 'HomeController@index')->name('home');
      Route::resource('governorates', 'Admin\GovernorateController');
      Route::resource('cities', 'Admin\CityController');
      Route::resource('categories', 'Admin\CategoryController');
      Route::resource('posts', 'Admin\PostController');
      Route::resource('donations', 'Admin\DonationRequestController');
      Route::resource('contacts', 'Admin\ContactController');
      Route::resource('clients', 'Admin\ClientController');
      Route::get('active/{id}','Admin\ClientController@active');
      Route::get('disactive/{id}','Admin\ClientController@disactive');
      Route::resource('settings', 'Admin\SettingController');
      Route::resource('users', 'Admin\UserController');
      Route::resource('roles', 'Admin\RoleController');

      //  User reset  Password
      Route::get('user/change-password', 'Admin\UserController@getChangePassword');

});
});
Route::post('user/change-password', 'Admin\UserController@changePassword_save');

// Auth::routes();
//
// Route::get('/home', 'HomeController@index')->name('home');
