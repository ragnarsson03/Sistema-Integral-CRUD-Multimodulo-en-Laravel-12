@extends('layouts.adminlte')

@section('title', 'Agregar Nuevo Libro')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">Información del Libro</h3>
                <a href="{{ route('biblioteca.libros.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-1"></i> Volver al Listado
                </a>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('biblioteca.libros.store') }}" id="libro-form">
                @csrf

                <div class="row">
                    <!-- Título -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input id="titulo" class="form-control @error('titulo') is-invalid @enderror" type="text" name="titulo" value="{{ old('titulo') }}" required autofocus />
                            @error('titulo')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Autor -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="autor">Autor</label>
                            <input id="autor" class="form-control @error('autor') is-invalid @enderror" type="text" name="autor" value="{{ old('autor') }}" required />
                            @error('autor')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Editorial -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="editorial">Editorial</label>
                            <input id="editorial" class="form-control @error('editorial') is-invalid @enderror" type="text" name="editorial" value="{{ old('editorial') }}" required />
                            @error('editorial')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- ISBN -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="isbn">ISBN</label>
                            <input id="isbn" class="form-control @error('isbn') is-invalid @enderror" type="text" name="isbn" value="{{ old('isbn') }}" required />
                            <div id="isbn-validation" class="text-muted small"></div>
                            @error('isbn')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Año de Publicación -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="anio_publicacion">Año de Publicación</label>
                            <input id="anio_publicacion" class="form-control @error('anio_publicacion') is-invalid @enderror" type="number" name="anio_publicacion" value="{{ old('anio_publicacion') }}" required min="1000" max="{{ date('Y') }}" />
                            @error('anio_publicacion')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Cantidad Disponible -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cantidad_disponible">Cantidad Disponible</label>
                            <input id="cantidad_disponible" class="form-control @error('cantidad_disponible') is-invalid @enderror" type="number" name="cantidad_disponible" value="{{ old('cantidad_disponible', 1) }}" required min="0" />
                            @error('cantidad_disponible')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('biblioteca.libros.index') }}" class="btn btn-secondary mr-2">
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const isbnInput = document.getElementById('isbn');
        const isbnValidation = document.getElementById('isbn-validation');
        
        isbnInput.addEventListener('blur', function() {
            const isbn = this.value.trim();
            if (isbn === '') {
                isbnValidation.innerHTML = '';
                return;
            }
            
            // Verificar si el ISBN ya existe
            fetch(`/biblioteca/libros/check-isbn?isbn=${encodeURIComponent(isbn)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.available) {
                        isbnValidation.className = 'validation-message valid';
                        isbnValidation.innerHTML = '<span class="validation-icon">✓</span> ISBN disponible';
                    } else {
                        isbnValidation.className = 'validation-message invalid';
                        isbnValidation.innerHTML = '<span class="validation-icon">✗</span> Este ISBN ya está en uso';
                    }
                })
                .catch(error => {
                    console.error('Error al verificar ISBN:', error);
                });
        });
    });
</script>