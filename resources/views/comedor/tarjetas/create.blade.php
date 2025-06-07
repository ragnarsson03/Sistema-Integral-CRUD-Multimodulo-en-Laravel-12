@extends('layouts.adminlte')

@section('title', 'Crear Nueva Tarjeta de Comedor')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Formulario de Registro de Tarjeta</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('comedor.tarjetas.store') }}">
                @csrf
                
                <div class="row">
                    <!-- Código de Tarjeta -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="codigo">Código de Tarjeta</label>
                            <input type="text" name="codigo" id="codigo" value="{{ old('codigo') }}" class="form-control @error('codigo') is-invalid @enderror" required>
                            @error('codigo')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Estudiante -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="estudiante_id">Estudiante</label>
                            <select name="estudiante_id" id="estudiante_id" class="form-control @error('estudiante_id') is-invalid @enderror" required>
                                <option value="">Seleccionar estudiante</option>
                                @foreach(\App\Models\Academico\Estudiante::orderBy('apellido')->get() as $estudiante)
                                    <option value="{{ $estudiante->id }}" {{ old('estudiante_id') == $estudiante->id ? 'selected' : '' }}>
                                        {{ $estudiante->apellido }}, {{ $estudiante->nombre }} - {{ $estudiante->cedula }}
                                    </option>
                                @endforeach
                            </select>
                            @error('estudiante_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Saldo Inicial -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="saldo">Saldo Inicial</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" name="saldo" id="saldo" value="{{ old('saldo', 0) }}" step="0.01" min="0" class="form-control @error('saldo') is-invalid @enderror" required>
                            </div>
                            @error('saldo')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Estado de la Tarjeta -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Estado de la Tarjeta</label>
                            <div class="custom-control custom-switch mt-2">
                                <input type="checkbox" name="activa" id="activa" value="1" {{ old('activa') ? 'checked' : '' }} class="custom-control-input">
                                <label class="custom-control-label" for="activa">Activa</label>
                            </div>
                            @error('activa')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('comedor.tarjetas.index') }}" class="btn btn-secondary mr-2">
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