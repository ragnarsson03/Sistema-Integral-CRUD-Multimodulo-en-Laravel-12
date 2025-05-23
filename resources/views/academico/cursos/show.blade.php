<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detalles del Curso') }}: {{ $curso->nombre }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('academico.cursos.edit', $curso) }}" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
                    {{ __('Editar') }}
                </a>
                <a href="{{ route('academico.cursos.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition">
                    {{ __('Volver') }}
                </a>
                <!-- Botón de eliminar -->
                <form action="{{ route('academico.cursos.destroy', $curso) }}" method="POST" class="inline" id="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="confirmDelete()" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">
                        {{ __('Eliminar') }}
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg">
                        <h3 class="text-lg font-semibold mb-4">Información del Curso</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Nombre</p>
                                <p class="text-lg">{{ $curso->nombre }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Nivel</p>
                                <p class="text-lg">{{ $curso->nivel ?? 'No especificado' }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Estado</p>
                                <p>
                                    @if($curso->activo)
                                        <span class="px-2 py-1 bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 rounded">
                                            Activo
                                        </span>
                                    @else
                                        <span class="px-2 py-1 bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 rounded">
                                            Inactivo
                                        </span>
                                    @endif
                                </p>
                            </div>
                            
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Fecha de creación</p>
                                <p>{{ $curso->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Descripción</p>
                            <p class="mt-1">{{ $curso->descripcion ?? 'Sin descripción' }}</p>
                        </div>
                    </div>
                    
                    <!-- Estadísticas del curso -->
                    <div class="mb-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-blue-100 dark:bg-blue-900 p-4 rounded-lg">
                            <h4 class="font-semibold text-blue-800 dark:text-blue-200">Estudiantes</h4>
                            <p class="text-2xl font-bold text-blue-800 dark:text-blue-200">{{ $curso->estudiantes()->count() }}</p>
                            <p class="text-sm text-blue-700 dark:text-blue-300">Estudiantes matriculados</p>
                        </div>
                        
                        <div class="bg-purple-100 dark:bg-purple-900 p-4 rounded-lg">
                            <h4 class="font-semibold text-purple-800 dark:text-purple-200">Asistencias</h4>
                            <p class="text-2xl font-bold text-purple-800 dark:text-purple-200">{{ $curso->asistencias()->count() }}</p>
                            <p class="text-sm text-purple-700 dark:text-purple-300">Registros de asistencia</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script de confirmación (movido aquí, antes del cierre de x-app-layout) -->
    <script>
    function confirmDelete() {
        if ({{ $curso->asistencias()->count() }} > 0) {
            if (confirm('Este curso tiene {{ $curso->asistencias()->count() }} asistencias asociadas. ¿Estás seguro de que deseas eliminar el curso y todas sus asistencias?')) {
                document.getElementById('delete-form').submit();
            }
        } else {
            if (confirm('¿Estás seguro de que deseas eliminar este curso?')) {
                document.getElementById('delete-form').submit();
            }
        }
    }
    </script>
</x-app-layout>