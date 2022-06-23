<?php

use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/', 'HomeController@index')->name('home');

// Login
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Register
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Reset Password
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Confirm Password
Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');
Route::group(['prefix' => '/trips','middleware' => 'agent.auth'],function() {
    Route::get('/duplicate/{trip}', [\App\Http\Controllers\Agent\TripController::class,'duplicate'])->name('mange.trip.duplicate');

    Route::get('/', [\App\Http\Controllers\Agent\TripController::class,'index'])->name('mange.trip.index');
    Route::get('/company-trips', [\App\Http\Controllers\Agent\TripController::class,'othersIndex'])->name('mange.trip.others.index');
    Route::get('/search', [\App\Http\Controllers\Agent\TripController::class,'search'])->name('mange.trip.search');
    Route::get('/othersSearch', [\App\Http\Controllers\Agent\TripController::class,'othersSearch'])->name('mange.trip.othersSearch');
    Route::get('/trip-types', [\App\Http\Controllers\Agent\TripController::class,'tripReservationTypeList'])->name('mange.types.list');
    Route::get('/create', [\App\Http\Controllers\Agent\TripController::class,'create'])->name('mange.trip.create');
    Route::post('/store', [\App\Http\Controllers\Agent\TripController::class,'store'])->name('mange.trip.store');
    Route::get('/edit/{trip}', [\App\Http\Controllers\Agent\TripController::class,'edit'])->name('mange.trip.edit');
    Route::post('/update',  [\App\Http\Controllers\Agent\TripController::class,'update'])->name('mange.trip.update');
    Route::delete('/destroy/{trip?}',[\App\Http\Controllers\Agent\TripController::class,'destroy'])->name('mange.trip.destroy');
});


Route::group(['prefix' => '/customers'],function() {
   Route::get('/list', [\App\Http\Controllers\Admin\CustomersController::class,'customerList'])->name('customers.list');

});

Route::group(['prefix' => '/vehicles'],function() {
    Route::get('/list', [\App\Http\Controllers\Admin\VehicleController::class,'list'])->name('vehicles.list');

});

Route::group(['prefix' => '/drivers'],function() {
    Route::get('/list', [\App\Http\Controllers\Admin\DriverController::class,'list'])->name('drivers.list');
});

Route::group(['prefix' => '/states'],function() {
    Route::get('/list', [\App\Http\Controllers\Admin\StateController::class,'stateList'])->name('states.list');

});

// Verify Email
// Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
// Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
// Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
