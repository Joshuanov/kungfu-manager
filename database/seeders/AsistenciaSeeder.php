<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Alumno;
use App\Models\Asistencia;
use Carbon\Carbon;

class AsistenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run()
    {
        $fechaHoy = Carbon::now()->toDateString();

        $alumnos = Alumno::all();

        foreach ($alumnos as $alumno) {
            // Evita duplicados
            $existe = Asistencia::where('alumno_id', $alumno->id)
                                ->where('fecha', $fechaHoy)
                                ->exists();

            if (!$existe) {
                Asistencia::create([
                    'alumno_id' => $alumno->id,
                    'fecha' => $fechaHoy,
                    'estado' => 'asistio',
                ]);
            }
        }

        $this->command->info('Asistencias generadas correctamente.');
    }
}


