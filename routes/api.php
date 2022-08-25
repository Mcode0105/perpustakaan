<?php

use App\Http\Controllers\API\Authcontroller;
use App\Http\Controllers\API\KelasController;
use App\Models\User;
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
    // return $request->user();

});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('logout', [Authcontroller::class, 'logout']);
    Route::get('/alluser', [Authcontroller::class, 'alluser']);
    Route::get('/showkelas', [KelasController::class, 'showkelas']);
    Route::post('addkelas', [KelasController::class, 'addkelas']);
    Route::post('editkelas', [KelasController::class, 'editkelas']);
    Route::post('deletekelas', [KelasController::class, 'deletekelas']);
});
Route::post('/login', [Authcontroller::class, 'login'])->name('login');
Route::post('/register', [Authcontroller::class, 'register']);
