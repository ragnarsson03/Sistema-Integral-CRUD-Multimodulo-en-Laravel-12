<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Notas de') }} {{ $estudiante->nombre }} {{ $estudiante->apellido }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Información del estudiante -->
                    <div class="mb-6 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg">
                        <h3 class="text-lg font-semibold mb-2">Información del Estudiante</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Nombre completo</p>
                                <p>{{ $estudiante->nombre }} {{ $estudiante->apellido }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Cédula</p>
                                <p>{{ $estudiante->cedula }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Grado</p>
                                <p>{{ $estudiante->grado }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Tabla de notas -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-700">
                                    <th class="py-3 px-4 text-left">Asignatura</th>
                                    <th class="py-3 px-4 text-left">Calificación</th>
                                    <th class="py-3 px-4 text-left">Período</th>
                                    <th class="py-3 px-4 text-left">Fecha</th>
                                    <th class="py-3 px-4 text-left">Observaciones</th>
                                    <th class="py-3 px-4 text-left">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($notas as $nota)
                                    <tr class="border-t border-gray-300 dark:border-gray-700">
                                        <td class="py-3 px-4">{{ $nota->asignatura }}</td>
                                        <td class="py-3 px-4">
                                            <span class="px-2 py-1 rounded {{ $nota->calificacion >= 10 ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                                {{ $nota->calificacion }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-4">{{ $nota->periodo }}</td>
                                        <td class="py-3 px-4">{{ $nota->fecha->format('d/m/Y') }}</td>
                                        <td class="py-3 px-4">{{ $nota->observaciones }}</td>
                                        <td class="py-3 px-4">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('academico.notas.edit', $nota) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('academico.notas.destroy', $nota) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300" onclick="return confirm('¿Estás seguro de eliminar esta nota?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-4 px-4 text-center text-gray-500 dark:text-gray-400">No hay notas registradas para este estudiante.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación -->
                    <div class="mt-4">
                        {{ $notas->links() }}
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('academico.estudiantes.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-400 dark:hover:bg-gray-600 active:bg-gray-500 dark:active:bg-gray-500 focus:outline-none focus:border-gray-500 focus:ring ring-gray-300 dark:ring-gray-700 disabled:opacity-25 transition ease-in-out duration-150">
                            Volver a Estudiantes
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>