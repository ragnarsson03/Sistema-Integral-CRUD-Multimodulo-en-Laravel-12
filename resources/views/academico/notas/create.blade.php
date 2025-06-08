@extends('layouts.adminlte')

@section('title', 'Registrar Nueva Nota')

@section('content')
    @if(session('warning'))
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-exclamation-triangle"></i> ¡Advertencia!</h5>
            {{ session('warning') }}
        </div>
    @endif

    @if($cursos->isEmpty())
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-exclamation-triangle"></i> ¡Advertencia!</h5>
            <p>No hay cursos disponibles. Por favor, <a href="{{ route('academico.cursos.create') }}" class="text-bold">cree un curso</a> primero.</p>
        </div>
    @endif

    @if($estudiantes->isEmpty())
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-exclamation-triangle"></i> ¡Advertencia!</h5>
            <p>No hay estudiantes registrados. Por favor, <a href="{{ route('academico.estudiantes.create') }}" class="text-bold">registre un estudiante</a> primero.</p>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Formulario de Registro de Nota</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('academico.notas.store') }}">
                @csrf
                
                <div class="row">
                    <!-- Estudiante -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="estudiante_id">Estudiante</label>
                            <select name="estudiante_id" id="estudiante_id" class="form-control @error('estudiante_id') is-invalid @enderror" required>
                                <option value="">Seleccionar estudiante</option>
                                @foreach($estudiantes as $estudiante)
                                    <option value="{{ $estudiante->id }}" {{ old('estudiante_id') == $estudiante->id ? 'selected' : '' }}>
                                        {{ $estudiante->apellido }}, {{ $estudiante->nombre }} - {{ $estudiante->grado }}
                                    </option>
                                @endforeach
                            </select>
                            @error('estudiante_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Curso -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="curso_id">Curso</label>
                            <select name="curso_id" id="curso_id" class="form-control @error('curso_id') is-invalid @enderror" required>
                                <option value="">Seleccionar curso</option>
                                @foreach($cursos as $curso)
                                    <option value="{{ $curso->id }}" {{ old('curso_id') == $curso->id ? 'selected' : '' }}>
                                        {{ $curso->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('curso_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Fecha de Evaluación (NUEVO CAMPO) -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fecha_evaluacion">Fecha de Evaluación</label>
                            <div class="input-group date" id="fechaEvaluacion" data-target-input="nearest">
                                <div class="input-group-prepend" data-target="#fechaEvaluacion" data-toggle="datetimepicker">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" name="fecha_evaluacion" id="fecha_evaluacion" value="{{ old('fecha_evaluacion', now()->format('Y-m-d')) }}" 
                                       class="form-control datetimepicker-input @error('fecha_evaluacion') is-invalid @enderror" 
                                       data-target="#fechaEvaluacion" required>
                            </div>
                            @error('fecha_evaluacion')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Calificación -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="calificacion">Calificación</label>
                            <input type="number" name="calificacion" id="calificacion" 
                                   class="form-control @error('calificacion') is-invalid @enderror" 
                                   value="{{ old('calificacion') }}" step="0.01" min="0" max="20" required>
                            @error('calificacion')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!-- Añadir después del campo de calificación y antes de observaciones -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="periodo">Período</label>
                            <input type="text" name="periodo" id="periodo" 
                                   class="form-control @error('periodo') is-invalid @enderror" 
                                   value="{{ old('periodo') }}" required>
                            @error('periodo')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <!-- Observaciones -->
                <div class="form-group">
                    <label for="observaciones">Observaciones</label>
                    <textarea name="observaciones" id="observaciones" rows="3" class="form-control @error('observaciones') is-invalid @enderror">{{ old('observaciones') }}</textarea>
                    @error('observaciones')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('academico.notas.index') }}" class="btn btn-secondary mr-2">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
@section('scripts')
<script>
    $(function () {
        // Inicializar Datetimepicker para fecha de evaluación
        $('#fechaEvaluacion').datetimepicker({
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
@endsection