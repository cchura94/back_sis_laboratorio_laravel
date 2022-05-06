<?php

namespace App\Http\Controllers;

use App\Models\Tipoexamen;
use Illuminate\Http\Request;

class TipoexamenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Tipoexamen::all(), 200);
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
            "examen" => "required"
        ]);

        //guardar
        $te = new Tipoexamen();
        $te->examen = $request->examen;
        $te->precio = $request->precio;
        $te->save();

        // respuesta
        return response()->json(["mensaje" => "Tipo examen registrado"], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Tipoexamen::find($id), 200);
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
            "examen" => "required"
        ]);

        //guardar
        $te = Tipoexamen::find($id);
        $te->examen = $request->examen;
        $te->precio = $request->precio;
        $te->save();

        // respuesta
        return response()->json(["mensaje" => "Tipo examen modificado"], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $te = Tipoexamen::find($id);
        $te->delete();

        return response()->json(["mensaje" => "Tipo examen eliminado"], 200);
    }
}
