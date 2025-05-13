<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Control de Asistencia') }}
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

            <!-- Selector de fecha -->
            <div class="mb-6 flex justify-center">
                <form action="{{ route('academico.asistencias.index') }}" method="GET" class="flex space-x-4">
                    <input type="date" name="fecha" value="{{ request('fecha', now()->format('Y-m-d')) }}" 
                           class="rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 focus:ring-2 focus:ring-blue-500">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                        Buscar
                    </button>
                </form>
            </div>

            <!-- Tabla de Asistencia -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold text-center mb-6">Registro de Asistencia - {{ request('fecha', now()->format('d/m/Y')) }}</h3>
                    
                    <form action="{{ route('academico.asistencias.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="fecha" value="{{ request('fecha', now()->format('Y-m-d')) }}">
                        
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-6 py-4 text-center text-sm font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Estudiante</th>
                                        <th class="px-6 py-4 text-center text-sm font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Grado</th>
                                        <th class="px-6 py-4 text-center text-sm font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Estado</th>
                                        <th class="px-6 py-4 text-center text-sm font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Observaciones</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-800">
                                    @foreach($estudiantes as $estudiante)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150">
                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            <input type="hidden" name="estudiante_id[]" value="{{ $estudiante->id }}">
                                            {{ $estudiante->nombre }} {{ $estudiante->apellido }}
                                        </td>
                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                                                {{ $estudiante->grado }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            <select name="estado[{{ $estudiante->id }}]" class="rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 focus:ring-2 focus:ring-blue-500">
                                                <option value="presente" {{ $asistencias[$estudiante->id] ?? '' == 'presente' ? 'selected' : '' }}>Presente</option>
                                                <option value="ausente" {{ $asistencias[$estudiante->id] ?? '' == 'ausente' ? 'selected' : '' }}>Ausente</option>
                                                <option value="tardanza" {{ $asistencias[$estudiante->id] ?? '' == 'tardanza' ? 'selected' : '' }}>Tardanza</option>
                                            </select>
                                        </td>
                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            <input type="text" name="observaciones[{{ $estudiante->id }}]" value="{{ $observaciones[$estudiante->id] ?? '' }}" 
                                                   class="rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 w-full focus:ring-2 focus:ring-blue-500">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="flex justify-center mt-6">
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                                Guardar Asistencia
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>