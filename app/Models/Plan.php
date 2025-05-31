<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = ['nombre', 'monto_mensual', 'duracion_meses', 'asistencias_semanales'];

    public function alumnos()
    {
        return $this->hasMany(Alumno::class);
    }
}
