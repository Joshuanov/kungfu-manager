<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Kung Fu Manager</a>

        <!-- Botón de colapso en dispositivos pequeños -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Contenido del navbar -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a href="{{ route('alumnos.index') }}" class="nav-link">Alumnos</a></li>
                <li class="nav-item"><a href="{{ route('planes.index') }}" class="nav-link">Planes</a></li>
                <li class="nav-item"><a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a></li>

                <!-- Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownAsistencias" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Asistencias
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownAsistencias">
                        <li><a class="dropdown-item" href="{{ route('asistencias.index') }}">Resumen General</a></li>
                        <li><a class="dropdown-item" href="{{ route('asistencias.diaria') }}">Registro Diario</a></li>
                        <li><a class="dropdown-item" href="{{ route('asistencias.manual') }}">Registro Manual</a></li>
                        <li><a class="dropdown-item" href="{{ route('asistencias.inasistencia') }}">Registrar Inasistencia</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
