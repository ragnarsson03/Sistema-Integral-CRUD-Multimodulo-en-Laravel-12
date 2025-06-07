@extends('layouts.adminlte')

@section('title', 'Crear Nuevo Paciente')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Formulario de Registro de Paciente</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('medico.pacientes.store') }}">
                @csrf
                
                <div class="row">
                    <!-- Nombre -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" class="form-control @error('nombre') is-invalid @enderror" required>
                            @error('nombre')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Apellido -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="apellido">Apellido</label>
                            <input type="text" name="apellido" id="apellido" value="{{ old('apellido') }}" class="form-control @error('apellido') is-invalid @enderror" required>
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
                            <label for="cedula">Cédula</label>
                            <input type="text" name="cedula" id="cedula" value="{{ old('cedula') }}" class="form-control @error('cedula') is-invalid @enderror" required>
                            @error('cedula')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Fecha de Nacimiento -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" class="form-control @error('fecha_nacimiento') is-invalid @enderror" required>
                            @error('fecha_nacimiento')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Género -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="genero">Género</label>
                            <select name="genero" id="genero" class="form-control @error('genero') is-invalid @enderror" required>
                                <option value="">Seleccionar</option>
                                <option value="masculino" {{ old('genero') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                                <option value="femenino" {{ old('genero') == 'femenino' ? 'selected' : '' }}>Femenino</option>
                                <option value="otro" {{ old('genero') == 'otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                            @error('genero')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Teléfono (opcional) -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="text" name="telefono" id="telefono" value="{{ old('telefono') }}" class="form-control @error('telefono') is-invalid @enderror">
                            @error('telefono')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <!-- Dirección (opcional) -->
                <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <input type="text" name="direccion" id="direccion" value="{{ old('direccion') }}" class="form-control @error('direccion') is-invalid @enderror">
                    @error('direccion')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Email (opcional) -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('medico.pacientes.index') }}" class="btn btn-secondary mr-2">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                    <button type="submit" id="guardar-paciente" class="btn btn-primary">
                        <i class="fas fa-save"></i> Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection