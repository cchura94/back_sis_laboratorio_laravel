<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consulta;
use App\Models\Persona;
use App\Models\Sucursal;

class ConsultaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consultas = Consulta::orderBy('id', 'desc')->with("sucursal")
                                ->with("paciente")
                                ->with("profesional")
                                ->paginate(2);
        return response()->json($consultas);
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
            "paciente_id" => "required",
            "profesional_id" => "required",
            "sucursal_id" => "required"
        ]);
        // buscar paciente
        $paciente = Persona::FindOrFail($request->paciente_id);
        // buscar profesional
        $profesional = Persona::FindOrFail($request->profesional_id);
        // buscar sucursal
        $sucursal = Sucursal::FindOrFail($request->sucursal_id);


        // guardar
        $consulta = new Consulta();
        $consulta->paciente_id = $paciente->id;
        $consulta->profesional_id = $profesional->id;
        $consulta->sucursal_id = $sucursal->id;
        $consulta->fecha_consulta = date("Y-m-d H:i:s");
        $consulta->save();

        // respuesta
        return response()->json(["mensaje" => "Consulta registrada"], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
