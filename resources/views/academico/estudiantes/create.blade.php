@extends('layouts.adminlte')

@section('title', 'Crear Estudiante')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Formulario de Registro de Estudiante</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('academico.estudiantes.store') }}">
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
                    
                    <!-- Grado -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="grado">Grado</label>
                            <select name="grado" id="grado" class="form-control @error('grado') is-invalid @enderror" required>
                                <option value="">Seleccionar grado</option>
                                <option value="1" {{ old('grado') == '1' ? 'selected' : '' }}>Primer Grado</option>
                                <option value="2" {{ old('grado') == '2' ? 'selected' : '' }}>Segundo Grado</option>
                                <option value="3" {{ old('grado') == '3' ? 'selected' : '' }}>Tercer Grado</option>
                                <option value="4" {{ old('grado') == '4' ? 'selected' : '' }}>Cuarto Grado</option>
                                <option value="5" {{ old('grado') == '5' ? 'selected' : '' }}>Quinto Grado</option>
                                <option value="6" {{ old('grado') == '6' ? 'selected' : '' }}>Sexto Grado</option>
                            </select>
                            @error('grado')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
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
                    
                    <!-- Teléfono -->
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
                
                <!-- Dirección -->
                <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <textarea name="direccion" id="direccion" rows="3" class="form-control @error('direccion') is-invalid @enderror">{{ old('direccion') }}</textarea>
                    @error('direccion')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('academico.estudiantes.index') }}" class="btn btn-secondary mr-2">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection