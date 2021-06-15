<?php

use App\Http\Controllers\Api\PasswordResetController;
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

Route::resource('users', \App\Http\Controllers\Api\UserController::class, ['only' => ['store']]);
Route::post('forgot', sprintf('%s@%s', PasswordResetController::class, 'forgot'))
    ->name('password.forgot');
Route::put('reset', sprintf('%s@%s', PasswordResetController::class, 'reset'))
    ->name('password.reset');
