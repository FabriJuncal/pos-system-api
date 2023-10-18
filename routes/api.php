<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImagenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
// Se definen las rutas que no estarán protegidas por Sanctum, ya que no son requeridas.
// En esta instancia recien se obtendrá el API TOKEN para poder acceder a las rutas protegidas por Sanctum.
Route::post('auth/register',[AuthController::class, 'create']);
Route::post('auth/login',[AuthController::class, 'login']);
Route::post('auth/forgot-password',[AuthController::class, 'sendResetLink']);

Route::middleware(['auth:sanctum'])->group(function(){
    // Endpoint que se encarga de obtener los datos del usuario logeado
    Route::get('auth/me', [AuthController::class, 'me']);

    // Endpoint que se encarga de subir las imagenes al servidor
    Route::post('/upload-image', [ImagenController::class, 'store']);
    // Endpoint que se encarga de eliminar las imagenes del servidor
    Route::post('/delete-image', [ImagenController::class, 'destroy']);
});
