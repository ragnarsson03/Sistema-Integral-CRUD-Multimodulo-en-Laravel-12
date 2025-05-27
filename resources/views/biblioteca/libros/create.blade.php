<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Agregar Nuevo Libro') }}
            </h2>
            <a href="{{ route('biblioteca.libros.index') }}" class="btn-back">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Volver al Listado
            </a>
        </div>
        <link rel="stylesheet" href="{{ asset('css/biblioteca.css') }}">
        <link rel="stylesheet" href="{{ asset('css/biblioteca-forms.css') }}">
        <link rel="stylesheet" href="{{ asset('css/biblioteca-buttons.css') }}">
    </x-slot>

    <!-- Incluir el navbar específico de biblioteca -->
    @include('biblioteca.navbar')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="form-container">
                        <h3 class="form-title">Información del Libro</h3>
                        <form method="POST" action="{{ route('biblioteca.libros.store') }}" id="libro-form">
                            @csrf

                            <div class="form-grid">
                                <!-- Título -->
                                <div class="form-group">
                                    <label for="titulo" class="form-label">Título</label>
                                    <input id="titulo" class="form-input" type="text" name="titulo" value="{{ old('titulo') }}" required autofocus />
                                    @error('titulo')
                                        <p class="form-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Autor -->
                                <div class="form-group">
                                    <label for="autor" class="form-label">Autor</label>
                                    <input id="autor" class="form-input" type="text" name="autor" value="{{ old('autor') }}" required />
                                    @error('autor')
                                        <p class="form-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Editorial -->
                                <div class="form-group">
                                    <label for="editorial" class="form-label">Editorial</label>
                                    <input id="editorial" class="form-input" type="text" name="editorial" value="{{ old('editorial') }}" required />
                                    @error('editorial')
                                        <p class="form-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- ISBN -->
                                <div class="form-group">
                                    <label for="isbn" class="form-label">ISBN</label>
                                    <input id="isbn" class="form-input" type="text" name="isbn" value="{{ old('isbn') }}" required />
                                    <div id="isbn-validation" class="validation-message"></div>
                                    @error('isbn')
                                        <p class="form-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Año de Publicación -->
                                <div class="form-group">
                                    <label for="anio_publicacion" class="form-label">Año de Publicación</label>
                                    <input id="anio_publicacion" class="form-input" type="number" name="anio_publicacion" value="{{ old('anio_publicacion') }}" required min="1000" max="{{ date('Y') }}" />
                                    @error('anio_publicacion')
                                        <p class="form-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Cantidad Disponible -->
                                <div class="form-group">
                                    <label for="cantidad_disponible" class="form-label">Cantidad Disponible</label>
                                    <input id="cantidad_disponible" class="form-input" type="number" name="cantidad_disponible" value="{{ old('cantidad_disponible', 1) }}" required min="0" />
                                    @error('cantidad_disponible')
                                        <p class="form-error">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-buttons">
                                <a href="{{ route('biblioteca.libros.index') }}" class="btn btn-cancel">
                                    Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    Guardar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
</x-app-layout>