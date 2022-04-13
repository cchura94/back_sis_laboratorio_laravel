<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // select * from users;
        $users = User::orwhere('email', 'like', '%'.$request->q.'%')->paginate(10);
        return response()->json($users, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validar
        $request->validate([
            "name" => "required",
            "email" => "required|unique:users",
            "password" => "required"
        ]);
        // registrar
        $usuario = new User;
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request->password);
        $usuario->save();
        // responder
        return response()->json([
            "mensaje" => "Usuario Registrado",
            "status" => 1,
            "error" => false
        ], 201);  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = User::find($id);

        return response()->json($usuario, 200);        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         // validar
         $request->validate([
            "name" => "required",
            "email" => "required|unique:users,email,$id"
        ]);
        // buscamos y modificamos
        $usuario = User::find($id);
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        if($usuario->password){
            $usuario->password = bcrypt($request->password);
        }
        $usuario->save();

        // responder
        return response()->json([
            "mensaje" => "Usuario Actualizado",
            "status" => 1,
            "error" => false
        ], 200); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::find($id);
        $usuario->delete();

        return response()->json([
            "mensaje" => "Usuario Eliminado",
            "status" => 1,
            "error" => false
        ], 200); 
    }
}
