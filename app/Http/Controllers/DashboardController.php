<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Reunion;
use App\Models\Examen;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $hoy = Carbon::now();

        // Morosos: alumnos con fecha de inicio de plan + duración vencida
        $morosos = Alumno::whereDate(DB::raw("DATE_ADD(fecha_inicio_plan, INTERVAL plans.duracion_meses MONTH)"), '<', $hoy)
            ->join('plans', 'alumnos.plan_id', '=', 'plans.id')
            ->select('alumnos.*')
            ->get();

        // Reuniones programadas (fecha futura)
        $reuniones = Reunion::where('fecha', '>=', $hoy)->orderBy('fecha')->get();

        // Exámenes próximos (en los próximos 7 días)
        $examenes = Examen::whereBetween('fecha_examen', [$hoy, $hoy->copy()->addDays(7)])->get();

        return view('dashboard.index', compact('morosos', 'reuniones', 'examenes'));
    }
}
