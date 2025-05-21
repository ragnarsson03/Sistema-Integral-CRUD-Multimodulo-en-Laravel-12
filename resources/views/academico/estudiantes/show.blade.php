<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalles del Estudiante') }}
        </h2>
    </x-slot>

    <div class="py-12 academic-background">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="academic-container p-6">
                <h3 class="academic-title">Información del Estudiante</h3>

                <div class="bg-gray-800 rounded-lg shadow-lg p-6 mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-gray-400 text-sm">Nombre:</p>
                            <p class="text-white text-lg font-semibold">{{ $estudiante->nombre }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">Apellido:</p>
                            <p class="text-white text-lg font-semibold">{{ $estudiante->apellido }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">Cédula:</p>
                            <p class="text-white text-lg font-semibold">{{ $estudiante->cedula }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">Grado:</p>
                            <p class="text-white text-lg font-semibold">{{ $estudiante->grado }}</p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4 justify-center">
                    <a href="{{ route('academico.asistencias.estudiante', $estudiante) }}" class="academic-action-button action-asistencia text-center py-3 px-6">
                        <i class="fas fa-clipboard-check mr-2"></i>Ver Asistencias
                    </a>
                    <a href="{{ route('academico.notas.estudiante', $estudiante) }}" class="academic-action-button action-notas text-center py-3 px-6">
                        <i class="fas fa-graduation-cap mr-2"></i>Ver Notas
                    </a>
                    <a href="{{ route('academico.estudiantes.edit', $estudiante) }}" class="academic-action-button action-editar text-center py-3 px-6">
                        <i class="fas fa-edit mr-2"></i>Editar
                    </a>
                    <a href="{{ route('academico.estudiantes.index') }}" class="academic-action-button bg-blue-600 text-white text-center py-3 px-6">
                        <i class="fas fa-arrow-left mr-2"></i>Volver
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>