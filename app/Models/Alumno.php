<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $fillable = ['nombre', 'apellido', 'rut', 'telefono', 'nivel', 'plan_id', 'fecha_inicio_plan', 'congelado'];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }

    public function reuniones()
    {
        return $this->hasMany(Reunion::class);
    }

    public function examenes()
    {
        return $this->hasMany(Examen::class);
    }
}
