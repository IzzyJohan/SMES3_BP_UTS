<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AuthController;
use GuzzleHttp\Middleware;

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

#Route autentikasi Sanctum
Route::middleware(['auth:sanctum'])->group(function(){

    # Method GET
    Route::get('/patients', [PatientController::class, 'index']);

    # Method POST
    Route::post('/patients', [PatientController::class, 'store']);

    #Method GET by id
    Route::get('/patients/{id}', [PatientController::class, 'show']);

    #Method PUT
    Route::put('/patients/{id}', [PatientController::class, 'update']);

    #Method DELETE
    Route::delete('/patients/{id}', [PatientController::class, 'destroy']);

    #Method GET by name
    Route::get('/patients/search/{name}', [PatientController::class, 'search']);

    #Methhod GET by status positive
    Route::get('/patients/status/{status}', [PatientController::class, 'status']);
    
});

#Endpoint register dan login
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

