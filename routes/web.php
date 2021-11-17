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
Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');

Route::redirect('home', '/');
Route::view('/', 'home');

Route::get('contact-us', 'ContactUsController@show');
Route::post('contact-us', 'ContactUsController@sendEmail');

Route::get('watch', 'WatchController@show');

Route::get('profile/', 'ProfileController@index');
Route::put('profile/update', 'ProfileController@update');
Route::get('profile/resetpassword', 'ProfileController@resetpassword');

// Reservaties
Route::get('reservation', 'ReservationController@show');
Route::post('reservation', 'ReservationController@store');

Route::prefix('admin')->group(function(){
    Route::get('zwemles/', 'Admin\zwemles@index');
    Route::delete('zwemles/', 'Admin\zwemles@destroy');
    Route::post('zwemles/', 'Admin\zwemles@store');
    Route::put('zwemles/edit', 'Admin\zwemles@edit');
    Route::put('zwemles/update', 'Admin\zwemles@update');

    Route::get('zwemmers/', 'Admin\zwemmers@index');
    Route::get('zwemmers/detail-zwemles', 'Admin\zwemmers@detailPage');
    Route::delete('zwemmers/', 'Admin\zwemmers@destroy');
    Route::post('zwemmers/', 'Admin\zwemmers@store');
    Route::post('zwemmers/new', 'Admin\zwemmers@storeUser');
    Route::get('zwemmers/lijst', 'Admin\zwemmers@allUsers');
    Route::get('zwemmers/edit', 'Admin\zwemmers@edit');
    Route::put('zwemmers/update', 'Admin\zwemmers@update');
    Route::post('zwemmers/resetpassword', 'Admin\zwemmers@resetpassword');

    Route::resource('meals', 'Admin\MealController');
    Route::resource('schools', 'Admin\SchoolController');
    Route::resource('rates', 'Admin\RateController');

    Route::get('zwemfeest', 'Admin\SwimmingPartyController@index');
    Route::post('zwemfeest', 'Admin\SwimmingPartyController@store');
    Route::put('zwemfeest/edit', 'Admin\SwimmingPartyController@edit');
    Route::put('zwemfeest/update', 'Admin\SwimmingPartyController@update');
    Route::delete('zwemfeest', 'Admin\SwimmingPartyController@destroy');
    Route::post('zwemfeest/sendEmail', 'admin\SwimmingPartyController@sendEmail');

    Route::resource('teachers', 'Admin\TeacherController');


});
