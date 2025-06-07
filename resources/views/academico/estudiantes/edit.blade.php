@extends('layouts.adminlte')

@section('title', 'Editar Estudiante')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Editar información del estudiante</h3>
        </div>
        
        @if (session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> ¡Éxito!</h5>
                {{ session('success') }}
            </div>
        @endif
        
        <div class="card-body">
            <form method="POST" action="{{ route('academico.estudiantes.update', $estudiante) }}">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Nombre -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre">{{ __('Nombre') }}</label>
                            <input id="nombre" name="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $estudiante->nombre) }}" required autofocus />
                            @error('nombre')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Apellido -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="apellido">{{ __('Apellido') }}</label>
                            <input id="apellido" name="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror" value="{{ old('apellido', $estudiante->apellido) }}" required />
                            @error('apellido')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Cédula -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cedula">{{ __('Cédula') }}</label>
                            <input id="cedula" name="cedula" type="text" class="form-control @error('cedula') is-invalid @enderror" value="{{ old('cedula', $estudiante->cedula) }}" required />
                            @error('cedula')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Grado -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="grado">{{ __('Grado') }}</label>
                            <select id="grado" name="grado" class="form-control @error('grado') is-invalid @enderror">
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ old('grado', $estudiante->grado) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            @error('grado')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('academico.estudiantes.index') }}" class="btn btn-secondary mr-2">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> {{ __('Guardar Cambios') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection