<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Curso') }}: {{ $curso->nombre }}
        </h2>
    </x-slot>

    <!-- Enlazar el archivo CSS del toggle -->
    <link rel="stylesheet" href="{{ asset('css/toggle.css') }}">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('academico.cursos.update', $curso) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre del Curso</label>
                            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $curso->nombre) }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            @error('nombre')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="descripcion" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descripción</label>
                            <textarea name="descripcion" id="descripcion" rows="3" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('descripcion', $curso->descripcion) }}</textarea>
                            @error('descripcion')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="nivel" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nivel</label>
                            <input type="text" name="nivel" id="nivel" value="{{ old('nivel', $curso->nivel) }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('nivel')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Estado del Curso</label>
                            <div class="flex items-center">
                                <label class="toggle-switch">
                                    <input type="checkbox" name="activo" id="activo" value="1" {{ $curso->activo ? 'checked' : '' }}>
                                    <span class="toggle-slider"></span>
                                </label>
                                <span class="toggle-label {{ $curso->activo ? 'toggle-active' : 'toggle-inactive' }}" id="estado-texto">
                                    {{ $curso->activo ? 'Activo' : 'Inactivo' }}
                                </span>
                            </div>
                            <!-- Campo oculto para asegurar que el controlador reciba información sobre el estado del toggle -->
                            <input type="hidden" name="activo_submitted" value="1">
                        </div>
                        
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('academico.cursos.index') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition mr-2">
                                Cancelar
                            </a>
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                                Actualizar Curso
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Script para actualizar el texto y la clase según el estado del toggle
        document.addEventListener('DOMContentLoaded', function() {
            const toggleCheckbox = document.getElementById('activo');
            const estadoTexto = document.getElementById('estado-texto');
            
            toggleCheckbox.addEventListener('change', function() {
                if(this.checked) {
                    estadoTexto.textContent = 'Activo';
                    estadoTexto.classList.remove('toggle-inactive');
                    estadoTexto.classList.add('toggle-active');
                } else {
                    estadoTexto.textContent = 'Inactivo';
                    estadoTexto.classList.remove('toggle-active');
                    estadoTexto.classList.add('toggle-inactive');
                }
            });
        });
    </script>
</x-app-layout>