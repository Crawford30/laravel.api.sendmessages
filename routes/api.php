<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Contacts\ContactController;
use App\Http\Controllers\Api\Messages\MessageController;

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


    //======Manage Messages ====
    Route::group(['prefix' => 'message'], function () {
        Route::post('/send-message', [MessageController::class, 'sendMessage']);

    });

    //======Manage Contacts ====
    Route::group(['prefix' => 'contact'], function () {
        Route::post('/save-contact', [ContactController::class, 'saveContactDetails']);

    });



});
