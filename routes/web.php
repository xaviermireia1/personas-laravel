<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Mostrar*/
Route::get('/mostrar',[PersonaController::class,'mostrarPersonas']);
/*CREAR*/
Route::get('/crear',[PersonaController::class,'crearPersonas']);
Route::post('/crear',[PersonaController::class,'crearPersonasPost']);
/*Eliminar*/
Route::delete('/eliminarPersona/{id}',[PersonaController::class,'eliminarPersona']);
/*Actualizar*/
Route::get('/modificarPersona/{id}',[PersonaController::class,'modificarPersonas']);
Route::put('/modificarPersona',[PersonaController::class,'modificarPersonasPut']);
/*LOGIN Y LOGOUT*/
Route::get('',[PersonaController::class,'login']);
Route::post('login',[PersonaController::class,'loginPost']);
Route::get("logout",[PersonaController::class,'logout']);
/*CORREO*/
Route::get("correoPersona/{correo_persona}",[PersonaController::class,'correoPersona2']);
Route::post("recibirCorreo",[PersonaController::class,'correoPersona']);