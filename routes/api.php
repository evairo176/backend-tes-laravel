<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ProfileController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/post', [PostController::class, "index"]);
Route::get('/post/{id}', [PostController::class, "detail"]);
Route::post('/post/create', [PostController::class, "create"]);
Route::put('/post/update/{id}', [PostController::class, "update"]);
Route::delete('/post/delete/{id}', [PostController::class, "delete"]);

Route::resource('profile', ProfileController::class);


// jwt
Route::middleware(['api'])->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/getaccount', [AuthController::class, 'getaccount']);
});
Route::get('/refresh', [AuthController::class, 'refresh']);
