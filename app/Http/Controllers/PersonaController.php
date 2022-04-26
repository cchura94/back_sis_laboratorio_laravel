<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\User;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // paginación
        $personas = Persona::paginate(10);
        return response()->json($personas, 200);
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
            "nombres" => "required|string",
            "apellidos" => "required|string",
            "ci_dni" => "required",
            "fecha_nacimiento" => "required"
        ]);
        // registrar en la BD
        $persona = new Persona();
        $persona->nombres = $request->nombres;
        $persona->apellidos = $request->apellidos;
        $persona->ci_dni = $request->ci_dni;
        $persona->telefono = $request->telefono;
        $persona->fecha_nacimiento = $request->fecha_nacimiento;
        $persona->direccion = $request->direccion;
        $persona->ciudad = $request->ciudad;
        $persona->pais = $request->pais;
        $persona->save();

        // responder
        return response()->json(["mensaje" => "Persona Registrada"], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $persona = Persona::FindOrFail($id);
        return response()->json($persona);
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
            "nombres" => "required|string",
            "apellidos" => "required|string",
            "ci_dni" => "required",
            "fecha_nacimiento" => "required"
        ]);

        $persona = Persona::FindOrFail($id);
        // modificamos en la BD
        $persona->nombres = $request->nombres;
        $persona->apellidos = $request->apellidos;
        $persona->ci_dni = $request->ci_dni;
        $persona->telefono = $request->telefono;
        $persona->fecha_nacimiento = $request->fecha_nacimiento;
        $persona->direccion = $request->direccion;
        $persona->ciudad = $request->ciudad;
        $persona->pais = $request->pais;
        $persona->save();

        // responder
        return response()->json(["mensaje" => "Persona Modificada"], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $persona = Persona::FindOrFail($id);
        $persona->delete();

        return response()->json(["mensaje" => "Persona Eliminada"], 200);
    }

    public function asignarCuentaUsuario(Request $request, $id)
    {
        $persona = Persona::FindOrFail($id);

        $user = new User();
        $user->name = $persona->nombres;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        // asignar el user a la persona (Paciente/Medico)
        $persona->user_id = $user->id;
        $persona->save();
        return response()->json(["mensaje" => "Cuenta Asignada Correctamente"], 200);
    }
}
