@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Listado de Alumnos</h2>
    <a href="{{ route('alumnos.create') }}" class="btn btn-success mb-3">Registrar Alumno</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>RUT</th>
                <th>Nivel</th>
                <th>Plan</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($alumnos as $alumno)
                <tr>
                    <td>{{ $alumno->nombre }} {{ $alumno->apellido }}</td>
                    <td>{{ $alumno->rut }}</td>
                    <td>{{ $alumno->nivel }}</td>
                    <td>{{ $alumno->plan->nombre ?? 'Sin plan' }}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-primary">Editar</a>
                        <a href="#" class="btn btn-sm btn-danger">Eliminar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
