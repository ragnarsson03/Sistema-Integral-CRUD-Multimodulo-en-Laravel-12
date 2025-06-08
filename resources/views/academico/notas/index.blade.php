@extends('layouts.adminlte')

@section('title', 'Registro de Notas')

@section('content')
    <!-- Incluir el navbar específico de estudiantes como parte del contenido -->
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">Navegación de Estudiantes</h3>
            </div>
        </div>
        <div class="card-body">
            <div class="btn-group">
                <a href="{{ route('academico.estudiantes.index') }}" class="btn btn-primary {{ request()->routeIs('academico.estudiantes.index') ? 'active' : '' }}">
                    <i class="fas fa-list mr-1"></i> Listado de Estudiantes
                </a>
                <a href="{{ route('academico.estudiantes.create') }}" class="btn btn-success {{ request()->routeIs('academico.estudiantes.create') ? 'active' : '' }}">
                    <i class="fas fa-plus-circle mr-1"></i> Nuevo Estudiante
                </a>
                <a href="{{ route('academico.asistencias.index') }}" class="btn btn-info {{ request()->routeIs('academico.asistencias.index') ? 'active' : '' }}">
                    <i class="fas fa-check-circle mr-1"></i> Asistencias
                </a>
                <a href="{{ route('academico.notas.index') }}" class="btn btn-warning {{ request()->routeIs('academico.notas.index') ? 'active' : '' }}">
                    <i class="fas fa-graduation-cap mr-1"></i> Notas
                </a>
            </div>
        </div>
    </div>

    <!-- Mensaje de éxito -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> ¡Éxito!</h5>
            {{ session('success') }}
        </div>
    @endif

    <!-- Agregar alerta cuando no hay cursos -->
    @if($cursos->isEmpty())
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-exclamation-triangle"></i> Atención</h5>
            <p>Necesitas crear un curso antes de añadir notas.</p>
            <a href="{{ route('academico.cursos.create') }}" class="btn btn-warning btn-sm">
                <i class="fas fa-plus-circle"></i> Crear un curso ahora
            </a>
        </div>
    @endif
    
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Listado de Notas</h3>
            <div class="card-tools">
                <div class="btn-group">
                    @if($cursos->isEmpty())
                        <a href="{{ route('academico.cursos.create') }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-plus-circle"></i> Crear Curso
                        </a>
                    @endif
                    <a href="{{ route('academico.notas.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus-circle"></i> Nueva Nota
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <!-- Filtros de búsqueda -->
            <div class="mb-3">
                <form action="{{ route('academico.notas.index') }}" method="GET" class="form-inline">
                    <div class="form-group mr-2">
                        <label for="curso_id" class="mr-2">Curso:</label>
                        <select name="curso_id" id="curso_id" class="form-control form-control-sm">
                            <option value="">Todos los cursos</option>
                            @foreach($cursos as $curso)
                                <option value="{{ $curso->id }}" {{ request('curso_id') == $curso->id ? 'selected' : '' }}>
                                    {{ $curso->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mr-2">
                        <label for="grado" class="mr-2">Grado:</label>
                        <select name="grado" id="grado" class="form-control form-control-sm">
                            <option value="">Todos los grados</option>
                            @for($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ request('grado') == $i ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group mr-2">
                        <label for="periodo" class="mr-2">Período:</label>
                        <select name="periodo" id="periodo" class="form-control form-control-sm">
                            <option value="">Todos los períodos</option>
                            <option value="Primer Trimestre" {{ request('periodo') == 'Primer Trimestre' ? 'selected' : '' }}>Primer Trimestre</option>
                            <option value="Segundo Trimestre" {{ request('periodo') == 'Segundo Trimestre' ? 'selected' : '' }}>Segundo Trimestre</option>
                            <option value="Tercer Trimestre" {{ request('periodo') == 'Tercer Trimestre' ? 'selected' : '' }}>Tercer Trimestre</option>
                            <option value="Final" {{ request('periodo') == 'Final' ? 'selected' : '' }}>Final</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">
                        <i class="fas fa-search"></i> Filtrar
                    </button>
                </form>
            </div>

            <!-- Tabla de notas -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Estudiante</th>
                            <th>Curso</th>
                            <th>Calificación</th>
                            <th>Período</th>
                            <th>Fecha Evaluación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($notas as $nota)
                            <tr>
                                <td>{{ $nota->id }}</td>
                                <td>{{ $nota->estudiante->apellido }}, {{ $nota->estudiante->nombre }}</td>
                                <td>{{ $nota->curso->nombre }}</td>
                                <td>{{ $nota->calificacion }}</td>
                                <td>{{ $nota->periodo }}</td>
                                <td>{{ $nota->fecha_evaluacion->format('d/m/Y') }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('academico.notas.edit', $nota) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('academico.notas.destroy', $nota) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Está seguro de eliminar esta nota?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No hay notas registradas</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="mt-3">
                {{ $notas->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection