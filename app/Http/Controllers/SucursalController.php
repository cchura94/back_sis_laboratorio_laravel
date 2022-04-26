<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sucursal;

class SucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lista_sucursal = Sucursal::get();
        return response()->json($lista_sucursal, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "nombre" => "required",
            "direccion" => "required",
            "ciudad" => "required",
            "user_id" => "required"
        ]);

        $sucursal = new Sucursal();
        $sucursal->nombre = $request->nombre;
        $sucursal->telefono = $request->telefono;
        $sucursal->direccion = $request->direccion;
        $sucursal->ciudad = $request->ciudad;
        $sucursal->user_id = $request->user_id;
        $sucursal->save();
        
        return response()->json(["Mensaje" => "Sucursal Registrado"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $sucursal = Sucursal::find($id);
       return response()->json($sucursal);
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
        $request->validate([
            "nombre" => "required",
            "direccion" => "required",
            "ciudad" => "required",
            "user_id" => "required"
        ]);

        $sucursal = Sucursal::find($id);
        $sucursal->nombre = $request->nombre;
        $sucursal->telefono = $request->telefono;
        $sucursal->direccion = $request->direccion;
        $sucursal->ciudad = $request->ciudad;
        $sucursal->user_id = $request->user_id;
        $sucursal->save();
        
        return response()->json(["Mensaje" => "Sucursal Modificado"]);
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sucursal = Sucursal::find($id);
        $sucursal->delete();
        return response()->json(["Mensaje" => "Sucursal Eliminado"]);
    }
}
