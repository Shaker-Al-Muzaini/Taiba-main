<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'admin.auth:admin'],function(){
    Route::get('/dashboard', 'HomeController@index')->name('home');
    Route::group(['prefix' => '/mangers'],function() {
        Route::get('/', [\App\Http\Controllers\Admin\AdminController::class,'adminIndex'])->name('mange.admin.index');
        Route::get('/search', [\App\Http\Controllers\Admin\AdminController::class,'adminSearch'])->name('mange.admin.search');
        Route::post('/changeStatus',  [\App\Http\Controllers\Admin\AdminController::class,'changeStatus'])->name('mange.user.change.status');
        Route::post('/create', [\App\Http\Controllers\Admin\AdminController::class,'store'])->name('mange.user.store');
        Route::post('/update',  [\App\Http\Controllers\Admin\AdminController::class,'update'])->name('mange.user.update');
        Route::delete('/{user}',[\App\Http\Controllers\Admin\AdminController::class,'destroy'])->name('mange.user.destroy');
    });

    Route::group(['prefix' => '/agents'],function() {
        Route::get('/', [\App\Http\Controllers\Admin\AgentController::class,'adminIndex'])->name('mange.agent.index');
        Route::get('/list', [\App\Http\Controllers\Admin\AgentController::class,'list'])->name('mange.agent.list');
        Route::get('/search', [\App\Http\Controllers\Admin\AgentController::class,'adminSearch'])->name('mange.agent.search');
        Route::post('/changeStatus',  [\App\Http\Controllers\Admin\AgentController::class,'changeStatus'])->name('mange.agent.change.status');
        Route::post('/create', [\App\Http\Controllers\Admin\AgentController::class,'store'])->name('mange.agent.store');
        Route::post('/update',  [\App\Http\Controllers\Admin\AgentController::class,'update'])->name('mange.agent.update');
        Route::delete('/destroy/{user}',[\App\Http\Controllers\Admin\AgentController::class,'destroy'])->name('mange.agent.destroy');
    });

    Route::group(['prefix' => '/customers'],function() {
        Route::get('/', [\App\Http\Controllers\Admin\CustomersController::class,'adminIndex'])->name('mange.customers.index');
        Route::get('/list', [\App\Http\Controllers\Admin\CustomersController::class,'customerList'])->name('customers.list');
        Route::get('/search', [\App\Http\Controllers\Admin\CustomersController::class,'adminSearch'])->name('mange.customers.search');
        Route::post('/create', [\App\Http\Controllers\Admin\CustomersController::class,'store'])->name('mange.customers.store');
        Route::post('/update',  [\App\Http\Controllers\Admin\CustomersController::class,'update'])->name('mange.customers.update');
        Route::delete('/destroy/{user}',[\App\Http\Controllers\Admin\CustomersController::class,'destroy'])->name('mange.customers.destroy');
    });

    Route::group(['prefix' => '/vehicles'],function() {
        Route::get('/', [\App\Http\Controllers\Admin\VehicleController::class,'index'])->name('mange.vehicles.index');
        Route::get('/list', [\App\Http\Controllers\Admin\VehicleController::class,'list'])->name('vehicles.list');
        Route::get('/search', [\App\Http\Controllers\Admin\VehicleController::class,'search'])->name('mange.vehicles.search');
        Route::post('/create', [\App\Http\Controllers\Admin\VehicleController::class,'store'])->name('mange.vehicles.store');
        Route::post('/update',  [\App\Http\Controllers\Admin\VehicleController::class,'update'])->name('mange.vehicles.update');
        Route::delete('/destroy/{user}',[\App\Http\Controllers\Admin\VehicleController::class,'destroy'])->name('mange.vehicles.destroy');
    });

    Route::group(['prefix' => '/drivers'],function() {
        Route::get('/', [\App\Http\Controllers\Admin\DriverController::class,'adminIndex'])->name('mange.drivers.index');
        Route::get('/list', [\App\Http\Controllers\Admin\DriverController::class,'list'])->name('drivers.list');
        Route::get('/search', [\App\Http\Controllers\Admin\DriverController::class,'adminSearch'])->name('mange.drivers.search');
        Route::post('/create', [\App\Http\Controllers\Admin\DriverController::class,'store'])->name('mange.drivers.store');
        Route::post('/update',  [\App\Http\Controllers\Admin\DriverController::class,'update'])->name('mange.drivers.update');
        Route::delete('/destroy/{user}',[\App\Http\Controllers\Admin\DriverController::class,'destroy'])->name('mange.drivers.destroy');
    });

    Route::group(['prefix' => '/trips'],function() {
        Route::get('/', [\App\Http\Controllers\Admin\TripController::class,'index'])->name('mange.trip.index');
        Route::get('/search', [\App\Http\Controllers\Admin\TripController::class,'search'])->name('mange.trip.search');
        Route::get('/trip-types', [\App\Http\Controllers\Admin\TripController::class,'tripReservationTypeList'])->name('mange.types.list');
        Route::get('/create', [\App\Http\Controllers\Admin\TripController::class,'create'])->name('mange.trip.create');
        Route::get('/edit/{trip}', [\App\Http\Controllers\Admin\TripController::class,'edit'])->name('mange.trip.edit');
        Route::get('/duplicate/{trip}', [\App\Http\Controllers\Admin\TripController::class,'duplicate'])->name('mange.trip.duplicate');
        Route::post('/store', [\App\Http\Controllers\Admin\TripController::class,'store'])->name('mange.trip.store');
        Route::post('/update',  [\App\Http\Controllers\Admin\TripController::class,'update'])->name('mange.trip.update');
        Route::delete('/destroy/{trip?}',[\App\Http\Controllers\Admin\TripController::class,'destroy'])->name('mange.trip.destroy');
    });
    Route::group(['prefix' => '/reports'],function() {
        Route::get('/', [\App\Http\Controllers\Admin\ReportController::class,'index'])->name('report.index');
        Route::get('/export-excel', [\App\Http\Controllers\Admin\ReportController::class,'exportExcel'])->name('report.export');
        Route::get('/export-excel-file', [\App\Http\Controllers\Admin\ReportController::class,'exportExcelFile'])->name('report.export.file');
     });
    Route::group(['prefix' => '/states'],function() {
        Route::get('/', [\App\Http\Controllers\Admin\StateController::class,'index'])->name('mange.states.index');
        Route::get('/list', [\App\Http\Controllers\Admin\StateController::class,'stateList'])->name('states.list');
        Route::get('/search', [\App\Http\Controllers\Admin\StateController::class,'search'])->name('mange.states.search');
        Route::post('/create', [\App\Http\Controllers\Admin\StateController::class,'store'])->name('mange.states.store');
        Route::post('/update',  [\App\Http\Controllers\Admin\StateController::class,'update'])->name('mange.states.update');
        Route::delete('/destroy/{user}',[\App\Http\Controllers\Admin\StateController::class,'destroy'])->name('mange.states.destroy');
    });
});
// Dashboard


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

// Verify Email
// Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
// Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
// Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
