<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reunion extends Model
{
    protected $table = 'reuniones';

    protected $fillable = ['alumno_id', 'fecha', 'motivo'];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }
}
