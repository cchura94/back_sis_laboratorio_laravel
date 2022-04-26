<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function paciente()
    {
        return $this->belongsTo(Persona::class);
    }

    public function tipoexamenes()
    {
        return $this->belongsToMany(Tipoexamen::class);
    }
}
