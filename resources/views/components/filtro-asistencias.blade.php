<h3>Filtrar asistencias por alumno y mes</h3>

<form method="GET" action="" class="row g-3 mb-4">
    <div class="col-md-5">
        <label>Alumno</label>
        <select name="alumno_id" class="form-select" required>
            <option value="">Seleccione un alumno</option>
            @foreach($alumnos as $alumno)
                <option value="{{ $alumno->id }}" {{ (isset($filtroAlumno) && $filtroAlumno == $alumno->id) ? 'selected' : '' }}>
                    {{ $alumno->nombre }} {{ $alumno->apellido }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label>Mes</label>
        <input type="month" name="mes" value="{{ $filtroMes ?? now()->format('Y-m') }}" class="form-control" required>
    </div>

    <div class="col-md-2 d-flex align-items-end">
        <button class="btn btn-primary w-100" type="submit">Filtrar</button>
    </div>
</form>

@if(isset($asistenciasFiltradas) && $asistenciasFiltradas->isNotEmpty())
    <h5>Asistencias de {{ $asistenciasFiltradas->first()->alumno->nombre }} {{ $asistenciasFiltradas->first()->alumno->apellido }} en {{ \Carbon\Carbon::parse($filtroMes . '-01')->translatedFormat('F Y') }}</h5>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($asistenciasFiltradas as $a)
                @php
                    $fechaAsistencia = \Carbon\Carbon::parse($a->fecha);
                    $esManual = $fechaAsistencia->isBefore(now()->startOfDay());
                @endphp
                <tr>
                    <td>
                        {{ $fechaAsistencia->format('d-m-Y') }}
                        <br>
                        <small class="text-muted">
                            {{ $esManual ? 'Manual' : 'Diaria' }}
                        </small>
                    </td>
                    <td>
                        @if($a->estado === 'asistio')
                            <span class="text-success">Asistió</span>
                        @elseif($a->estado === 'ausente')
                            <span class="text-danger">Ausente</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="alert alert-info mt-4">
        No hay asistencias seleccionadas ó registradas para este alumno en el mes seleccionado.
    </div>
@endif
