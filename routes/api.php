<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:passport')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group(['namespace' => 'Api', 'middleware' => 'return-json'], function () {


    //======Manage Users ====
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/logout', [AuthController::class, 'logout']);

    });


    // //======Manage Paients ====
    // Route::group(['prefix' => 'patient'], function () {
    //     Route::post('/patients', [PatientController::class, 'createPatient']);
    //     Route::post('/activate-deactivate', [PatientController::class, 'activateAndDeactivatePaitentData']);
    //     Route::post('/delete-patient', [PatientController::class, 'deletePatient']);
    // });







});
