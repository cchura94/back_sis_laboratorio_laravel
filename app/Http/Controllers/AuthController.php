<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // validar datos (email, password)
        $credentials = $request->validate([
            "email" => "required|email|string",
            "password" => "required|string"
        ]);
        // verificar en la base de datos
        if (!Auth::attempt($credentials)) {
            return response()->json([
                "mensaje" => "Credenciales incorrectas"
            ], 401);
        }
        // authenticar
        $user = $request->user();
        // generar token
        $tokenResult = $user->createToken('Token de acceso');
        $token = $tokenResult->plainTextToken;
        // responder
        return response()->json([
            "accessToken" => $token,
            "token_type" => "Bearer",
            "user" => $user
        ]);
    }

    public function registrar(Request $request)
    {
        // validar
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required"
        ]);
        // guardar
        $usuario = new User;
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request->password);
        $usuario->save();
        // responder
        return response()->json([
            "mensaje" => "Usuario Registrado",
            "status" => 1
        ], 201);        
    }

    public function perfil(Request $request)
    {
        return response()->json($request->user());
        
    }

    public function salir(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            "mensaje" => "Logout"
        ]);        
    }
}
