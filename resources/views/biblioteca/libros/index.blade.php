<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestión de Libros') }}
        </h2>
        <link rel="stylesheet" href="{{ asset('css/biblioteca.css') }}">
    </x-slot>

    <!-- Incluir el navbar específico de biblioteca -->
    @include('biblioteca.navbar')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Listado de Libros</h3>
                        <a href="{{ route('biblioteca.libros.create') }}" class="action-button bg-blue-600 text-white hover:bg-blue-700">
                            Agregar Nuevo Libro
                        </a>
                    </div>

                    <!-- Formulario de búsqueda -->
                    <form action="{{ route('biblioteca.libros.index') }}" method="GET" class="search-container">
                        <input 
                            type="text" 
                            name="search" 
                            placeholder="Buscar por título, autor, editorial o ISBN..." 
                            class="search-input"
                            value="{{ request('search') }}"
                        >
                        <button type="submit" class="search-button">Buscar</button>
                        @if(request('search'))
                            <a href="{{ route('biblioteca.libros.index') }}" class="search-reset">Limpiar</a>
                        @endif
                    </form>

                    @if(session('success'))
                        <div class="alert-success" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="libro-table">
                            <thead class="libro-table-header">
                                <tr>
                                    <th>Título</th>
                                    <th>Autor</th>
                                    <th>Editorial</th>
                                    <th>ISBN</th>
                                    <th>Año</th>
                                    <th>Disponibles</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($libros as $libro)
                                    <tr class="libro-table-row">
                                        <td class="libro-table-cell">{{ $libro->titulo }}</td>
                                        <td class="libro-table-cell">{{ $libro->autor }}</td>
                                        <td class="libro-table-cell">{{ $libro->editorial }}</td>
                                        <td class="libro-table-cell">{{ $libro->isbn }}</td>
                                        <td class="libro-table-cell">{{ $libro->anio_publicacion }}</td>
                                        <td class="libro-table-cell">{{ $libro->cantidad_disponible }}</td>
                                        <td class="libro-table-cell flex space-x-2">
                                            <a href="{{ route('biblioteca.libros.show', $libro) }}" class="action-button action-button-view">
                                                Ver
                                            </a>
                                            <a href="{{ route('biblioteca.libros.edit', $libro) }}" class="action-button action-button-edit">
                                                Editar
                                            </a>
                                            <form action="{{ route('biblioteca.libros.destroy', $libro) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="action-button action-button-delete" onclick="return confirm('¿Estás seguro de eliminar este libro?')">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="libro-table-cell text-center">
                                            @if(request('search'))
                                                No se encontraron libros que coincidan con "{{ request('search') }}"
                                            @else
                                                No hay libros registrados
                                            @endif
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $libros->links() }}
                    </div>
                    
                    <!-- Explicación del ISBN para el profesor Elias -->
                    <div class="isbn-explanation">
                        <h4>Prof. Elias: Importancia del ISBN en nuestro sistema</h4>
                        <p>El <strong>ISBN (International Standard Book Number)</strong> es un identificador único y estandarizado para libros, utilizado a nivel internacional. En el proyecto del sistema de biblioteca, este campo cumple varias funciones:</p>
                        <ul>
                            <li><strong>Identificación única:</strong> Cada libro tiene un ISBN único, lo que permite identificarlo de manera inequívoca en el sistema, evitando confusiones entre títulos similares o diferentes ediciones.</li>
                            <li><strong>Control de inventario:</strong> Disponibilidad de libros</li>
                            <li><strong>Búsqueda y catalogación:</strong> Búsquedas rápidas y precisas en el catálogo de la biblioteca.</li>
                        </ul>
                        <p>En la tabla de libros, el ISBN se muestra como una columna independiente, permitiendo a los bibliotecarios verificar rápidamente este código único para cada libro registrado.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>