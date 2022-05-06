<?php

namespace Database\Seeders;

use App\Models\Sucursal;
use Illuminate\Database\Seeder;

class SucursalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $s = new Sucursal();
        $s->nombre = "Casa matriz";
        $s->telefono = 342342;
        $s->direccion = "Av 123 Z abc";
        $s->ciudad = "prueba";
        $s->user_id = 1;
    }
}
