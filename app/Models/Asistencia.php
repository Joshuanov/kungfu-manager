<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $fillable = ['alumno_id', 'fecha', 'estado'];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }
}
