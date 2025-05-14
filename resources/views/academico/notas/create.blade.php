<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Registrar Nueva Nota') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('academico.notas.store') }}">
                        @csrf
                        
                        <!-- Estudiante -->
                        <div class="mb-4">
                            <label for="estudiante_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Estudiante</label>
                            <select name="estudiante_id" id="estudiante_id" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="">Seleccionar estudiante</option>
                                @foreach($estudiantes as $estudiante)
                                    <option value="{{ $estudiante->id }}" {{ old('estudiante_id') == $estudiante->id ? 'selected' : '' }}>
                                        {{ $estudiante->apellido }}, {{ $estudiante->nombre }} - {{ $estudiante->grado }}
                                    </option>
                                @endforeach
                            </select>
                            @error('estudiante_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Asignatura -->
                        <div class="mb-4">
                            <label for="asignatura" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Asignatura</label>
                            <input type="text" name="asignatura" id="asignatura" value="{{ old('asignatura') }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                            @error('asignatura')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Calificación -->
                        <div class="mb-4">
                            <label for="calificacion" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Calificación (0-20)</label>
                            <input type="number" name="calificacion" id="calificacion" min="0" max="20" step="0.01" value="{{ old('calificacion') }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                            @error('calificacion')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Período -->
                        <div class="mb-4">
                            <label for="periodo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Período</label>
                            <select name="periodo" id="periodo" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="">Seleccionar período</option>
                                <option value="Primer Lapso" {{ old('periodo') == 'Primer Lapso' ? 'selected' : '' }}>Primer Lapso</option>
                                <option value="Segundo Lapso" {{ old('periodo') == 'Segundo Lapso' ? 'selected' : '' }}>Segundo Lapso</option>
                                <option value="Tercer Lapso" {{ old('periodo') == 'Tercer Lapso' ? 'selected' : '' }}>Tercer Lapso</option>
                                <option value="Final" {{ old('periodo') == 'Final' ? 'selected' : '' }}>Final</option>
                            </select>
                            @error('periodo')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Fecha de Evaluación -->
                        <div class="mb-4">
                            <label for="fecha" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fecha de Evaluación</label>
                            <input type="date" name="fecha" id="fecha" value="{{ old('fecha') ?? date('Y-m-d') }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                            @error('fecha')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Observaciones -->
                        <div class="mb-6">
                            <label for="observaciones" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Observaciones</label>
                            <textarea name="observaciones" id="observaciones" rows="3" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('observaciones') }}</textarea>
                            @error('observaciones')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('academico.notas.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-400 dark:hover:bg-gray-600 active:bg-gray-500 dark:active:bg-gray-500 focus:outline-none focus:border-gray-500 focus:ring ring-gray-300 dark:ring-gray-700 disabled:opacity-25 transition ease-in-out duration-150 mr-2">
                                Cancelar
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>