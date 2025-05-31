
@extends('layouts.app')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Registro de Asistencia Diaria</h3>
        <div>
            <a href="{{ route('asistencias.diaria') }}" class="btn btn-outline-primary me-2">Registro Diario</a>
            <a href="{{ route('asistencias.manual') }}" class="btn btn-outline-success me-2">Registro Manual</a>
            <a href="{{ route('asistencias.inasistencia') }}" class="btn btn-outline-danger">Registrar Inasistencia</a>
        </div>
    </div>

    <x-filtro-asistencias
        :alumnos="$alumnos"
        :asistenciasFiltradas="$asistenciasFiltradas ?? collect()"
        :filtroAlumno="$filtroAlumno ?? null"
        :filtroMes="$filtroMes ?? now()->format('Y-m')"
    />

    {{-- Aquí agregarías el formulario específico para asistencia diaria --}}
    <h2>Registro de Asistencias</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('asistencias.store') }}">
        @csrf
        <div class="mb-3">
            <label for="alumno_id" class="form-label">Seleccionar Alumno</label>
            <select class="form-select" name="alumno_id" required>
                <option value="">-- Selecciona un alumno --</option>
                @foreach($alumnos as $alumno)
                    <option value="{{ $alumno->id }}">
                        {{ $alumno->nombre }} {{ $alumno->apellido }} ({{ $alumno->plan->nombre }} – {{ $alumno->plan->asistencias_semanales }} asist/sem)
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Registrar Asistencia de Hoy</button>
    </form>


</div>
@endsection
