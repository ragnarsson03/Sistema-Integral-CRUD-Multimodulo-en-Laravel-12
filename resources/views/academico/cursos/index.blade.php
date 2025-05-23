<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Gestión de Cursos') }}
            </h2>
            <a href="{{ route('academico.cursos.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                {{ __('Nuevo Curso') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Mensaje de éxito -->
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($cursos->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700">
                                <thead>
                                    <tr class="bg-gray-100 dark:bg-gray-700">
                                        <th class="py-3 px-4 text-left">Nombre</th>
                                        <th class="py-3 px-4 text-left">Nivel</th>
                                        <th class="py-3 px-4 text-left">Estado</th>
                                        <th class="py-3 px-4 text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cursos as $curso)
                                        <tr class="border-t border-gray-300 dark:border-gray-700">
                                            <td class="py-3 px-4">{{ $curso->nombre }}</td>
                                            <td class="py-3 px-4">{{ $curso->nivel ?? 'No especificado' }}</td>
                                            <td class="py-3 px-4">
                                                @if($curso->activo)
                                                    <span class="px-2 py-1 bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 rounded">
                                                        Activo
                                                    </span>
                                                @else
                                                    <span class="px-2 py-1 bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 rounded">
                                                        Inactivo
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="py-3 px-4 text-center">
                                                <div class="flex justify-center space-x-2">
                                                    <a href="{{ route('academico.cursos.show', $curso) }}" class="px-2 py-1 bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 rounded hover:bg-blue-200 dark:hover:bg-blue-800 transition">
                                                        Ver
                                                    </a>
                                                    <a href="{{ route('academico.cursos.edit', $curso) }}" class="px-2 py-1 bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 rounded hover:bg-yellow-200 dark:hover:bg-yellow-800 transition">
                                                        Editar
                                                    </a>
                                                    <form action="{{ route('academico.cursos.destroy', $curso) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este curso?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="px-2 py-1 bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 rounded hover:bg-red-200 dark:hover:bg-red-800 transition">
                                                            Eliminar
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $cursos->links() }}
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500 dark:text-gray-400">No hay cursos registrados.</p>
                            <a href="{{ route('academico.cursos.create') }}" class="mt-4 inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                                Crear el primer curso
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>