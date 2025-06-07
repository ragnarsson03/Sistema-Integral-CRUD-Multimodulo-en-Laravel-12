@extends('layouts.adminlte')

@section('title', 'Control de Asistencia')

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

    <!-- Selector de fecha -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Seleccionar Fecha</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('academico.asistencias.index') }}" method="GET" class="form-inline justify-content-center">
                <div class="input-group date" id="datepicker" data-target-input="nearest">
                    <div class="input-group-prepend" data-target="#datepicker" data-toggle="datetimepicker">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input type="text" name="fecha" value="{{ request('fecha', now()->format('Y-m-d')) }}" class="form-control datetimepicker-input" data-target="#datepicker">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabla de Asistencia -->
    <div class="card">
        <div class="card-header bg-primary">
            <h3 class="card-title">Registro de Asistencia - {{ \Carbon\Carbon::parse(request('fecha', now()))->format('d/m/Y') }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('academico.asistencias.store') }}" method="POST">
                @csrf
                <input type="hidden" name="fecha" value="{{ request('fecha', now()->format('Y-m-d')) }}">
                
                <!-- Añadir campos ocultos para los IDs de estudiantes -->
                @foreach($estudiantes as $estudiante)
                    <input type="hidden" name="estudiante_id[]" value="{{ $estudiante->id }}">
                @endforeach
                
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Estudiante</th>
                                <th>Grado</th>
                                <th>Asistencia</th>
                                <th>Observaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($estudiantes as $estudiante)
                                <tr>
                                    <td>{{ $estudiante->id }}</td>
                                    <td>{{ $estudiante->apellido }}, {{ $estudiante->nombre }}</td>
                                    <td>{{ $estudiante->grado }}</td>
                                    <td class="text-center">
                                        <div class="form-group clearfix mb-0">
                                            <div class="icheck-primary d-inline mr-3">
                                                <input type="radio" id="presente_{{ $estudiante->id }}" name="estado[{{ $estudiante->id }}]" value="presente" {{ isset($asistencias[$estudiante->id]) && $asistencias[$estudiante->id] == 'presente' ? 'checked' : '' }}>
                                                <label for="presente_{{ $estudiante->id }}">Presente</label>
                                            </div>
                                            <div class="icheck-danger d-inline mr-3">
                                                <input type="radio" id="ausente_{{ $estudiante->id }}" name="estado[{{ $estudiante->id }}]" value="ausente" {{ isset($asistencias[$estudiante->id]) && $asistencias[$estudiante->id] == 'ausente' ? 'checked' : '' }}>
                                                <label for="ausente_{{ $estudiante->id }}">Ausente</label>
                                            </div>
                                            <div class="icheck-warning d-inline">
                                                <input type="radio" id="tardanza_{{ $estudiante->id }}" name="estado[{{ $estudiante->id }}]" value="tardanza" {{ isset($asistencias[$estudiante->id]) && $asistencias[$estudiante->id] == 'tardanza' ? 'checked' : '' }}>
                                                <label for="tardanza_{{ $estudiante->id }}">Tardanza</label>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="observaciones[{{ $estudiante->id }}]" value="{{ isset($observaciones[$estudiante->id]) ? $observaciones[$estudiante->id] : '' }}" placeholder="Observaciones">
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No hay estudiantes registrados</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(function () {
        //Initialize Datetimepicker
        $('#datepicker').datetimepicker({
            format: 'YYYY-MM-DD',
            icons: {
                time: 'far fa-clock',
                date: 'far fa-calendar',
                up: 'fas fa-arrow-up',
                down: 'fas fa-arrow-down',
                previous: 'fas fa-chevron-left',
                next: 'fas fa-chevron-right',
                today: 'fas fa-calendar-check',
                clear: 'far fa-trash-alt',
                close: 'far fa-times-circle'
            }
        });
    });
</script>
@endsection