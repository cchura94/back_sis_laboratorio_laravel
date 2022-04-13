<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(["prefix" => "/v1/auth"], function(){
    Route::post("/login", [AuthController::class, "login"]);
    Route::post("/registro", [AuthController::class, "registrar"]);
    
    Route::group(["middleware" => "auth:sanctum"], function(){
        Route::get("/perfil", [AuthController::class, "perfil"]);
        Route::post("/logout", [AuthController::class, "salir"]);
    });  
});

Route::group(["middleware" => "auth:sanctum"], function(){
    // rutas seguras
    Route::apiResource("/usuario", UsuarioController::class);
}); 

// nuevo cambio
