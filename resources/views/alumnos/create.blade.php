@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Registrar Nuevo Alumno</h2>
    <form action="{{ route('alumnos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Apellido</label>
            <input type="text" name="apellido" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>RUT</label>
            <input type="text" name="rut" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Teléfono</label>
            <input type="text" name="telefono" class="form-control">
        </div>

        <div class="mb-3">
            <label>Nivel</label>
            <select name="nivel" class="form-control" required>
                <option value="">Seleccione nivel</option>
                <option value="Tiger">Tiger</option>
                <option value="Junior">Junior</option>
                <option value="Adulto">Adulto</option>
                <option value="Senior">Senior</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Plan</label>
            <select name="plan_id" class="form-control" required>
                <option value="">Seleccione plan</option>
                @foreach ($planes as $plan)
                    <option value="{{ $plan->id }}">{{ $plan->nombre }} ({{ $plan->duracion_meses }} meses)</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Fecha inicio del plan</label>
            <input type="date" name="fecha_inicio_plan" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Registrar Alumno</button>
    </form>
</div>
@endsection
