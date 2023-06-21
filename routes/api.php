<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\UserController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users',[ApiController::class,'users']);
Route::post('/login',[UserController::class,'login']);
Route::get('/create',[ApiController::class,'create']);
Route::post('/crear-permiso',[ApiController::class,'crearPermiso']);


Route::post('/asignar-permisos',[ApiController::class,'asignarPermiso']);
Route::post('/asignar-roles',[ApiController::class,'asignarRol']);


Route::get('/roles',[ApiController::class,'roles']);
Route::get('/permisos',[ApiController::class,'permisos']);
Route::post('/crear-usuario',[ApiController::class,'crearUsuario']);
Route::post('/eliminar-usuario/{id}',[ApiController::class,'eliminarUsuario']);
Route::post('/eliminar-roles/{id}',[ApiController::class,'eliminarRoles']);
Route::post('/eliminar-permisos/{id}',[ApiController::class,'eliminarPermisos']);
Route::post('/crear-roles',[ApiController::class,'crearRole']);
Route::get('/logout',[ApiController::class,'logout']);
Route::get('/chektoken',[ApiController::class,'chektoken']);