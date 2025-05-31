@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Registro de Inasistencia</h3>
            <div>
                <a href="{{ route('asistencias.diaria') }}" class="btn btn-outline-primary me-2">Registro Diario</a>
                <a href="{{ route('asistencias.manual') }}" class="btn btn-outline-success me-2">Registro Manual</a>
                <a href="{{ route('asistencias.inasistencia') }}" class="btn btn-outline-danger">Registrar Inasistencia</a>
            </div>
        </div>

        <x-filtro-asistencias :alumnos="$alumnos" :asistenciasFiltradas="$asistenciasFiltradas ?? collect()" :filtroAlumno="$filtroAlumno ?? null" :filtroMes="$filtroMes ?? now()->format('Y-m')" />

        {{-- Aquí agregarías el formulario específico para asistencia diaria --}}
        <h5>Registrar Inasistencia Manual</h5>

        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger mt-3">
                {{ session('error') }}
            </div>
        @endif


        <form method="POST" action="{{ route('asistencias.store') }}">
            @csrf

            <div class="mb-3">
                <label for="alumno_id_inasistencia" class="form-label">Alumno</label>
                <select name="alumno_id_inasistencia" class="form-select" required>
                    <option value="">Selecciona un alumno</option>
                    @foreach ($alumnos as $alumno)
                        <option value="{{ $alumno->id }}">{{ $alumno->nombre }} {{ $alumno->apellido }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="fecha_inasistencia" class="form-label">Fecha</label>
                <input type="date" name="fecha_inasistencia" class="form-control" max="{{ now()->format('Y-m-d') }}"
                    required>
            </div>
            <!-- Campo oculto para indicar que es una inasistencia -->
            <input type="hidden" name="registro_inasistencia" value="1">

            <button type="submit" class="btn btn-outline-danger">Registrar Inasistencia</button>
        </form>


    </div>
@endsection
