<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Asistencias de') }} {{ $estudiante->nombre }} {{ $estudiante->apellido }}
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

                    <!-- Estadísticas de asistencia -->
                    <div class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                        @php
                            $total = $asistencias->count();
                            $presentes = $asistencias->where('estado', 'presente')->count();
                            $ausentes = $asistencias->where('estado', 'ausente')->count();
                            $tardanzas = $asistencias->where('estado', 'tardanza')->count();
                            
                            $porcentajePresentes = $total > 0 ? round(($presentes / $total) * 100) : 0;
                            $porcentajeAusentes = $total > 0 ? round(($ausentes / $total) * 100) : 0;
                            $porcentajeTardanzas = $total > 0 ? round(($tardanzas / $total) * 100) : 0;
                        @endphp
                        
                        <div class="bg-green-100 dark:bg-green-900 p-4 rounded-lg">
                            <h4 class="font-semibold text-green-800 dark:text-green-200">Presentes</h4>
                            <p class="text-2xl font-bold text-green-800 dark:text-green-200">{{ $porcentajePresentes }}%</p>
                            <p class="text-sm text-green-700 dark:text-green-300">{{ $presentes }} de {{ $total }} días</p>
                        </div>
                        
                        <div class="bg-red-100 dark:bg-red-900 p-4 rounded-lg">
                            <h4 class="font-semibold text-red-800 dark:text-red-200">Ausentes</h4>
                            <p class="text-2xl font-bold text-red-800 dark:text-red-200">{{ $porcentajeAusentes }}%</p>
                            <p class="text-sm text-red-700 dark:text-red-300">{{ $ausentes }} de {{ $total }} días</p>
                        </div>
                        
                        <div class="bg-yellow-100 dark:bg-yellow-900 p-4 rounded-lg">
                            <h4 class="font-semibold text-yellow-800 dark:text-yellow-200">Tardanzas</h4>
                            <p class="text-2xl font-bold text-yellow-800 dark:text-yellow-200">{{ $porcentajeTardanzas }}%</p>
                            <p class="text-sm text-yellow-700 dark:text-yellow-300">{{ $tardanzas }} de {{ $total }} días</p>
                        </div>
                    </div>

                    <!-- Tabla de asistencias -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-700">
                                    <th class="py-3 px-4 text-left">Fecha</th>
                                    <th class="py-3 px-4 text-left">Estado</th>
                                    <th class="py-3 px-4 text-left">Observaciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($asistencias as $asistencia)
                                    <tr class="border-t border-gray-300 dark:border-gray-700">
                                        <td class="py-3 px-4">{{ $asistencia->fecha->format('d/m/Y') }}</td>
                                        <td class="py-3 px-4">
                                            @if($asistencia->estado == 'presente')
                                                <span class="px-2 py-1 bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 rounded">
                                                    Presente
                                                </span>
                                            @elseif($asistencia->estado == 'ausente')
                                                <span class="px-2 py-1 bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 rounded">
                                                    Ausente
                                                </span>
                                            @elseif($asistencia->estado == 'tardanza')
                                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 rounded">
                                                    Tardanza
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-3 px-4">{{ $asistencia->observaciones }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>