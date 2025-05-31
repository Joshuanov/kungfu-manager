<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FiltroAsistencias extends Component
{
  public $alumnos;
    public $asistenciasFiltradas;
    public $filtroAlumno;
    public $filtroMes;

    public function __construct($alumnos, $asistenciasFiltradas, $filtroAlumno, $filtroMes)
    {
        $this->alumnos = $alumnos;
        $this->asistenciasFiltradas = $asistenciasFiltradas;
        $this->filtroAlumno = $filtroAlumno;
        $this->filtroMes = $filtroMes;
    }

    public function render()
    {
        return view('components.filtro-asistencias');
    }
}
