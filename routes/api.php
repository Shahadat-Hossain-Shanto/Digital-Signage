<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceInfoApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/search-device-info/{id}', [DeviceInfoApiController::class, 'check_device']);
Route::get('/search-playlist-info/{id}', [DeviceInfoApiController::class, 'check_playlist']);
Route::post('/send-firebase-token', [DeviceInfoApiController::class, 'send_token']);
