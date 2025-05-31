<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    protected $table = 'examenes';

    protected $fillable = ['alumno_id', 'tipo', 'categoria', 'nivel', 'fecha_examen', 'aprobado'];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }
}
