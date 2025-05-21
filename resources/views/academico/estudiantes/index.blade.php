<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('css/academico.css') }}">
        <h2 class="font-semibold text-xl text-center text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestión de Estudiantes') }}
        </h2>
    </x-slot>

    <div class="academic-background py-12">
        <div class="academic-container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Mensaje de éxito -->
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Encabezado académico -->
            <div class="academic-header">
                <h1 class="text-2xl font-bold">Sistema de Gestión Académica</h1>
                <p class="mt-2">Administración de estudiantes y seguimiento académico</p>
            </div>

            <!-- Botones de Acción Principal -->
            <div class="mb-8 flex justify-center space-x-6">
                <a href="{{ route('academico.estudiantes.create') }}" class="academic-button academic-button-primary">
                    <i class="fas fa-plus-circle mr-2"></i>Nuevo Estudiante
                </a>
                <a href="{{ route('academico.asistencias.index') }}" class="academic-button academic-button-success">
                    <i class="fas fa-clipboard-check mr-2"></i>Control de Asistencia
                </a>
                <a href="{{ route('academico.notas.index') }}" class="academic-button academic-button-purple">
                    <i class="fas fa-graduation-cap mr-2"></i>Registro de Notas
                </a>
            </div>

            <!-- Tabla de Estudiantes -->
            <div class="p-6">
                <h3 class="academic-title">Listado de Estudiantes</h3>
                
                <!-- Filtros de búsqueda -->
                <div class="academic-search-container">
                    <input type="text" 
                           placeholder="Buscar por nombre..." 
                           class="academic-search-input">
                    <select class="academic-search-select">
                        <option value="">Todos los grados</option>
                        <option value="1">Primer Grado</option>
                        <option value="2">Segundo Grado</option>
                        <option value="3">Tercer Grado</option>
                        <option value="4">Cuarto Grado</option>
                        <option value="5">Quinto Grado</option>
                        <option value="6">Sexto Grado</option>
                    </select>
                </div>

                <div class="overflow-x-auto">
                    <table class="academic-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Cédula</th>
                                <th>Grado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($estudiantes as $estudiante)
                            <tr>
                                <td>{{ $estudiante->id }}</td>
                                <td>{{ $estudiante->nombre }}</td>
                                <td>{{ $estudiante->apellido }}</td>
                                <td>{{ $estudiante->cedula }}</td>
                                <td>
                                    <span class="academic-badge">
                                        {{ $estudiante->grado }}
                                    </span>
                                </td>
                                <td>
                                    <div class="academic-action-buttons">
                                        <a href="{{ route('academico.estudiantes.show', $estudiante) }}" 
                                           class="academic-action-button bg-green-500 hover:bg-green-700 text-white">
                                            <i class="fas fa-eye"></i> Ver
                                        </a>
                                        <a href="{{ route('academico.estudiantes.index', $estudiante) }}" 
                                           class="academic-action-button bg-yellow-500 hover:bg-yellow-700 text-white">
                                            <i class="fas fa-clipboard-check"></i> Asistencia
                                        </a>
                                        <a href="{{ route('academico.notas.estudiante', $estudiante) }}" 
                                           class="academic-action-button bg-purple-500 hover:bg-purple-700 text-white">
                                            <i class="fas fa-graduation-cap"></i> Notas
                                        </a>
                                        <a href="{{ route('academico.estudiantes.edit', $estudiante) }}" 
                                           class="academic-action-button bg-blue-500 hover:bg-blue-700 text-white">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                        <form action="{{ route('academico.estudiantes.destroy', $estudiante) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="academic-action-button bg-red-500 hover:bg-red-700 text-white"
                                                    onclick="return confirm('¿Estás seguro de eliminar este estudiante?')">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Paginación -->
                <div class="mt-6">
                    {{ $estudiantes->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>