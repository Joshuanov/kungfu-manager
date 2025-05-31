<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Asistencia;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $alumnos = Alumno::with('plan')->get();

            // Listado total
        $ultimasAsistencias = Asistencia::with('alumno')
        ->orderBy('fecha', 'desc')
        ->get();

        // Filtro personalizado
        $filtroAlumno = $request->input('alumno_id');
        $filtroMes = $request->input('mes') ?? now()->format('Y-m');

        $asistenciasFiltradas = collect();

        if ($filtroAlumno) {
            $asistenciasFiltradas = Asistencia::with('alumno')
            ->where('alumno_id', $filtroAlumno)
            ->whereBetween('fecha', [
            $filtroMes . '-01',
                Carbon::parse($filtroMes . '-01')->endOfMonth()->format('Y-m-d')
            ])
            ->orderBy('fecha')
            ->get();
        }

        return view('asistencias.index', compact('alumnos', 'ultimasAsistencias', 'asistenciasFiltradas', 'filtroAlumno', 'filtroMes'));
    }

    public function formDiaria(Request $request)
    {
    return $this->renderAsistenciaView('diaria', $request);
    }

    public function formManual(Request $request)
    {
    return $this->renderAsistenciaView('manual', $request);
    }

    public function formInasistencia(Request $request)
    {
    return $this->renderAsistenciaView('inasistencias', $request);
    }

// Método común para cargar datos base
    private function renderAsistenciaView($vista, Request $request)
    {
        $alumnos = Alumno::with('plan')->get();

        $filtroAlumno = $request->input('alumno_id');
        $filtroMes = $request->input('mes') ?? now()->format('Y-m');
        $asistenciasFiltradas = collect();

        if ($filtroAlumno) {
            $asistenciasFiltradas = Asistencia::with('alumno')
                ->where('alumno_id', $filtroAlumno)
                ->whereBetween('fecha', [
                    $filtroMes . '-01',
                    Carbon::parse($filtroMes . '-01')->endOfMonth()->format('Y-m-d')
                ])
                ->orderBy('fecha')
                ->get();
        }

        return view("asistencias.$vista", compact('alumnos', 'asistenciasFiltradas', 'filtroAlumno', 'filtroMes'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // 🟥 1. Si viene desde el formulario de inasistencia
    if ($request->filled('registro_inasistencia')) {
        $request->validate([
            'alumno_id_inasistencia' => 'required|exists:alumnos,id',
            'fecha_inasistencia' => 'required|date|before_or_equal:today',
        ]);

        $fecha = Carbon::parse($request->fecha_inasistencia);
        if ($fecha->month !== now()->month) {
            return back()->with('error', 'Solo puedes registrar inasistencias dentro del mes actual.');
        }

        $alumnoId = $request->alumno_id_inasistencia;

        $yaExiste = Asistencia::where('alumno_id', $alumnoId)
            ->where('fecha', $fecha->toDateString())
            ->exists();

        if ($yaExiste) {
            return back()->with('error', 'Ya existe un registro para esa fecha.');
        }

        Asistencia::create([
            'alumno_id' => $alumnoId,
            'fecha' => $fecha->toDateString(),
            'estado' => 'ausente',
        ]);

        return back()->with('success', 'Inasistencia registrada correctamente.');
    }

    // 🟦 2. Lógica existente para asistencia automática o manual
        $modoManual = $request->filled('modo_manual');

        // Validación condicional
        $rules = $modoManual
            ? [
                'alumno_id_manual' => 'required|exists:alumnos,id',
                'fecha_manual' => 'required|date',
            ]
            : [
                'alumno_id' => 'required|exists:alumnos,id',
            ];

        $request->validate($rules);

        // Tomar alumno y fecha correctos según el tipo
        $alumnoId = $modoManual ? $request->input('alumno_id_manual') : $request->input('alumno_id');
        $alumno = Alumno::with('plan')->findOrFail($alumnoId);
        $fecha = $modoManual
            ? Carbon::parse($request->fecha_manual)->toDateString()
            : now()->toDateString();

        // Validación fecha válida si es manual
        if ($modoManual) {
            $fechaManual = Carbon::parse($fecha);
            if (
                $fechaManual->month !== now()->month ||
                $fechaManual->isFuture()
            ) {
                return back()->with('error', 'Solo puedes registrar fechas pasadas dentro del mes actual.');
            }
        }

        // Validación semanal solo si es de hoy
        if (!$modoManual) {
            $inicioSemana = now()->startOfWeek();
            $finSemana = now()->endOfWeek();

            $asistenciasSemana = Asistencia::where('alumno_id', $alumnoId)
                ->whereBetween('fecha', [$inicioSemana->toDateString(), $finSemana->toDateString()])
                ->count();

            if ($asistenciasSemana >= $alumno->plan->asistencias_semanales) {
                return back()->with('error', 'El alumno ya alcanzó su límite semanal de asistencias.');
            }
        }

        // Validación duplicado exacto
        $yaExiste = Asistencia::where('alumno_id', $alumnoId)
            ->where('fecha', $fecha)
            ->exists();

        if ($yaExiste) {
            return back()->with('error', 'Ya existe una asistencia registrada para esa fecha.');
        }

        // Guardar
        Asistencia::create([
            'alumno_id' => $alumnoId,
            'fecha' => $fecha,
            'estado' => 'asistio',
        ]);

        return back()->with('success', 'Asistencia registrada exitosamente.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
