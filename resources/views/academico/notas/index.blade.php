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
            <!-- Aquí irá el contenido de la tabla de notas -->
        </div>
    </div>
@endsection