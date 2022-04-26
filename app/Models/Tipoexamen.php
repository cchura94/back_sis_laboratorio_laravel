<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipoexamen extends Model
{
    use HasFactory;

    public function consultas()
    {
        return $this->belongsToMany(Consulta::class);
    }

    public function enfermedades()
    {
        return $this->belongsToMany(Enfermedad::class);
    }
}
