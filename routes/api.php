<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Frontend\AreaController;
use App\Http\Controllers\Frontend\DoctorListController;
use App\Http\Controllers\Frontend\DoctorProfileController;
use App\Http\Controllers\Frontend\MedicineController as FrontendMedicineController;
use App\Http\Controllers\Frontend\OfflineCallController as FrontendOfflineCallController;
use App\Http\Controllers\Frontend\OnlineCallController as FrontendOnlineCallController;
use App\Http\Controllers\Frontend\SettingController as FrontendSettingController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\OfflineCallController;
use App\Http\Controllers\OnlineCallController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceAreaController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TransectionController;
use App\Http\Controllers\Frontend\UserProfileController;
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


Route::post('/user/register', [AuthController::class, 'register']);
Route::post('/user/login', [AuthController::class, 'login']);

// protected route for user

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'user'], function(){
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [UserProfileController::class, 'profile']);
    Route::post('/update', [UserProfileController::class, 'update']);
});

// protected route for doctor
Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'doctor'], function(){
    Route::get('/profile', [DoctorProfileController::class, 'profile']);
    Route::post('/update', [DoctorProfileController::class, 'update']);
});

// protected route for app user 

Route::group(['middleware' => 'guest'], function(){

    // front areas routes
    Route::get('/areas', [AreaController::class, 'index']);
    Route::get('/area/{id}', [AreaController::class, 'show']);
    Route::get('/area/search', [AreaController::class, 'search']);

    // get doctor by category
    Route::get('/doctor/{cat}', [DoctorListController::class, 'index']);

    // get setting
    Route::get('/setting', [FrontendSettingController::class, 'index']);

    // online call route
    Route::post('/online-call', [FrontendOnlineCallController::class, 'create']);
    Route::get('/online-calls', [FrontendOnlineCallController::class, 'index']);
    Route::get('/online-calls/accept/{id}', [FrontendOnlineCallController::class, 'accept']);
    Route::post('/online-calls/complete/{id}', [FrontendOnlineCallController::class, 'complete']);

    // offline call route
    Route::post('/offline-call', [FrontendOfflineCallController::class, 'create']);
    Route::get('/offline-calls', [FrontendOfflineCallController::class, 'index']);

    // front medicine routes
    Route::get('/medicines', [FrontendMedicineController::class, 'index']);
    Route::get('/medicine/{id}', [FrontendMedicineController::class, 'show']);
    Route::get('/medicine/search', [FrontendMedicineController::class, 'search']);

});

Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function(){
    Route::resource('/online-calls', OnlineCallController::class);
    Route::resource('/offline-calls', OfflineCallController::class);
    Route::resource('/services', ServiceController::class);
    Route::resource('/areas', ServiceAreaController::class);
    Route::resource('/transections', TransectionController::class);
    Route::resource('/medicines', MedicineController::class);
    Route::resource('/settings', SettingController::class);
});






