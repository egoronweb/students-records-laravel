<?php

use App\Http\Controllers\api\StudentController;
use App\Http\Controllers\Controller;
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

Route::post('/register', [Controller::class, 'create']);
Route::post('/login', [Controller::class, 'userLogin']);
Route::get('/dashboard', [StudentController::class, 'index']);
Route::post('/dashboard/create', [StudentController::class, 'create']);
Route::get('/dashboard/edit/{id}', [StudentController::class, 'edit']);
Route::put('/dashboard/edit/update/{id}', [StudentController::class, 'update']);
Route::delete('/dashboard/delete/{id}', [StudentController::class, 'destroy']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
