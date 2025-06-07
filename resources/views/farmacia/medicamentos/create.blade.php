@extends('layouts.adminlte')

@section('title', 'Crear Nuevo Medicamento')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Formulario de Registro de Medicamento</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('farmacia.medicamentos.store') }}">
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
                    
                    <!-- Código -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="codigo">Código</label>
                            <input type="text" name="codigo" id="codigo" value="{{ old('codigo') }}" class="form-control @error('codigo') is-invalid @enderror" required>
                            @error('codigo')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Categoría -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="categoria">Categoría del Medicamento</label>
                            <select name="categoria" id="categoria" class="form-control @error('categoria') is-invalid @enderror" required>
                                <option value="">Seleccionar categoría</option>
                                <option value="analgesico" {{ old('categoria') == 'analgesico' ? 'selected' : '' }}>Analgésico</option>
                                <option value="antibiotico" {{ old('categoria') == 'antibiotico' ? 'selected' : '' }}>Antibiótico</option>
                                <option value="antialergico" {{ old('categoria') == 'antialergico' ? 'selected' : '' }}>Antialérgico</option>
                                <option value="antiinflamatorio" {{ old('categoria') == 'antiinflamatorio' ? 'selected' : '' }}>Antiinflamatorio</option>
                                <option value="antidepresivo" {{ old('categoria') == 'antidepresivo' ? 'selected' : '' }}>Antidepresivo</option>
                                <option value="vitamina" {{ old('categoria') == 'vitamina' ? 'selected' : '' }}>Vitamina</option>
                                <option value="otro" {{ old('categoria') == 'otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                            @error('categoria')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Precio -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" step="0.01" name="precio" id="precio" value="{{ old('precio') }}" class="form-control @error('precio') is-invalid @enderror" required>
                            </div>
                            @error('precio')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <!-- Descripción -->
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" id="descripcion" rows="3" class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="row">
                    <!-- Stock -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="stock">Cantidad inicial en inventario</label>
                            <input type="number" name="stock" id="stock" min="0" value="{{ old('stock') }}" class="form-control @error('stock') is-invalid @enderror" required>
                            <small class="form-text text-muted">Número de unidades disponibles</small>
                            @error('stock')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Fecha de Vencimiento -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fecha_vencimiento">Fecha de Vencimiento</label>
                            <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" value="{{ old('fecha_vencimiento') }}" class="form-control @error('fecha_vencimiento') is-invalid @enderror" required>
                            @error('fecha_vencimiento')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('farmacia.medicamentos.index') }}" class="btn btn-secondary mr-2">
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