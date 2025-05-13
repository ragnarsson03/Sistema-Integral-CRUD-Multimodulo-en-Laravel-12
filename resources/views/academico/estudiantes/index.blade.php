<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestión de Estudiantes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Mensaje de éxito -->
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Botones de Acción Principal -->
            <div class="mb-6 flex justify-center space-x-4">
                <a href="{{ route('academico.estudiantes.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg text-center transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-plus-circle mr-2"></i>Nuevo Estudiante
                </a>
                <a href="{{ route('academico.asistencias.index') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg text-center transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-clipboard-check mr-2"></i>Control de Asistencia
                </a>
                <a href="{{ route('academico.notas.index') }}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-3 px-6 rounded-lg text-center transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-graduation-cap mr-2"></i>Registro de Notas
                </a>
            </div>

            <!-- Tabla de Estudiantes -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold text-center mb-6">Listado de Estudiantes</h3>
                    
                    <!-- Filtros de búsqueda -->
                    <div class="mb-6 flex justify-center space-x-4">
                        <input type="text" 
                               placeholder="Buscar por nombre..." 
                               class="rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 w-1/3 focus:ring-2 focus:ring-blue-500">
                        <select class="rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 w-1/4 focus:ring-2 focus:ring-blue-500">
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
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nombre</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Apellido</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">DNI</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Grado</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-800">
                                @foreach($estudiantes as $estudiante)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150">
                                    <td class="px-6 py-4 text-center whitespace-nowrap">{{ $estudiante->id }}</td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">{{ $estudiante->nombre }}</td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">{{ $estudiante->apellido }}</td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">{{ $estudiante->dni }}</td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ $estudiante->grado }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        <div class="flex justify-center space-x-2">
                                            <a href="{{ route('academico.estudiantes.show', $estudiante) }}" 
                                               class="bg-green-500 hover:bg-green-700 text-white px-3 py-1 rounded-lg transition duration-300">
                                                <i class="fas fa-eye"></i> Ver
                                            </a>
                                            <a href="{{ route('academico.asistencias.estudiante', $estudiante) }}" 
                                               class="bg-yellow-500 hover:bg-yellow-700 text-white px-3 py-1 rounded-lg transition duration-300">
                                                <i class="fas fa-clipboard-check"></i> Asistencia
                                            </a>
                                            <a href="{{ route('academico.notas.estudiante', $estudiante) }}" 
                                               class="bg-purple-500 hover:bg-purple-700 text-white px-3 py-1 rounded-lg transition duration-300">
                                                <i class="fas fa-graduation-cap"></i> Notas
                                            </a>
                                            <a href="{{ route('academico.estudiantes.edit', $estudiante) }}" 
                                               class="bg-blue-500 hover:bg-blue-700 text-white px-3 py-1 rounded-lg transition duration-300">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                            <form action="{{ route('academico.estudiantes.destroy', $estudiante) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="bg-red-500 hover:bg-red-700 text-white px-3 py-1 rounded-lg transition duration-300"
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
                    <div class="mt-4">
                        {{ $estudiantes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>