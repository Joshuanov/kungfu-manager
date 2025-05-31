@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Resumen de Asistencias</h3>
        <div>
            <a href="{{ route('asistencias.diaria') }}" class="btn btn-outline-primary me-2">Registro Diario</a>
            <a href="{{ route('asistencias.manual') }}" class="btn btn-outline-success me-2">Registro Manual</a>
            <a href="{{ route('asistencias.inasistencia') }}" class="btn btn-outline-danger">Registrar Inasistencia</a>
        </div>
    </div>

    {{-- Filtro por alumno y mes --}}
    <x-filtro-asistencias
        :alumnos="$alumnos"
        :asistenciasFiltradas="$asistenciasFiltradas"
        :filtroAlumno="$filtroAlumno"
        :filtroMes="$filtroMes"
    />

</div>
@endsection
