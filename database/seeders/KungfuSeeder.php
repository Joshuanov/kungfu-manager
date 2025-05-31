<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plan;
use App\Models\Alumno;
use App\Models\Reunion;
use App\Models\Examen;
use Carbon\Carbon;

class KungfuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear planes
        $planBasico = Plan::create([
            'nombre' => 'Básico',
            'monto_mensual' => 20000,
            'duracion_meses' => 3,
            'asistencias_semanales' => 2,
        ]);

        $planAvanzado = Plan::create([
            'nombre' => 'Avanzado',
            'monto_mensual' => 30000,
            'duracion_meses' => 6,
            'asistencias_semanales' => 3,
        ]);

        // Crear alumnos
        $alumno1 = Alumno::create([
            'nombre' => 'Carlos',
            'apellido' => 'Pérez',
            'rut' => '12345678-9',
            'telefono' => '912345678',
            'nivel' => 'Adulto',
            'plan_id' => $planBasico->id,
            'fecha_inicio_plan' => Carbon::now()->subMonths(4),
        ]);

        $alumno2 = Alumno::create([
            'nombre' => 'Ana',
            'apellido' => 'Lagos',
            'rut' => '87654321-0',
            'telefono' => '987654321',
            'nivel' => 'Junior',
            'plan_id' => $planAvanzado->id,
            'fecha_inicio_plan' => Carbon::now()->subMonths(1),
        ]);

        // Crear reuniones
        Reunion::create([
            'alumno_id' => $alumno2->id,
            'fecha' => Carbon::now()->addDays(3),
            'motivo' => 'Evaluación de avance',
        ]);

        // Crear examen
        Examen::create([
            'alumno_id' => $alumno2->id,
            'tipo' => 'Tradicional',
            'categoria' => 'Junior',
            'nivel' => 'Básico',
            'fecha_examen' => Carbon::now()->addDays(5),
            'aprobado' => false,
        ]);
    }
}
