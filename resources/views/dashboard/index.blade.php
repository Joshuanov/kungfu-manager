@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Panel de Control - Alertas</h2>

    <div class="row mt-4">
        <div class="col-md-4">
            <h4 class="text-danger">Alumnos Morosos</h4>
            <ul class="list-group">
                @forelse($morosos as $a)
                    <li class="list-group-item">{{ $a->nombre }} {{ $a->apellido }} – Plan vencido</li>
                @empty
                    <li class="list-group-item">Sin alumnos morosos</li>
                @endforelse
            </ul>
        </div>

        <div class="col-md-4">
            <h4 class="text-warning">Reuniones Próximas</h4>
            <ul class="list-group">
                @forelse($reuniones as $r)
                    <li class="list-group-item">{{ $r->alumno->nombre }} – {{ $r->fecha }} – {{ $r->motivo }}</li>
                @empty
                    <li class="list-group-item">Sin reuniones próximas</li>
                @endforelse
            </ul>
        </div>

        <div class="col-md-4">
            <h4 class="text-primary">Exámenes Próximos</h4>
            <ul class="list-group">
                @forelse($examenes as $e)
                    <li class="list-group-item">{{ $e->alumno->nombre }} – {{ $e->fecha_examen }} – {{ $e->nivel }}</li>
                @empty
                    <li class="list-group-item">Sin exámenes próximos</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection
