<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('css/academico.css') }}">
        <link rel="stylesheet" href="{{ asset('css/academico-estudiante-detalle.css') }}">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalles del Estudiante') }}
        </h2>
    </x-slot>

    <!-- Incluir el navbar específico de estudiantes -->
    @include('academico.estudiantes.navbar')

    <div class="py-12 academic-background">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="estudiante-detalle-container">
                <h3 class="estudiante-detalle-titulo">Información del Estudiante</h3>

                <div class="estudiante-info-card">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="estudiante-campo-etiqueta">Nombre:</p>
                            <p class="estudiante-campo-valor">{{ $estudiante->nombre }}</p>
                        </div>
                        <div>
                            <p class="estudiante-campo-etiqueta">Apellido:</p>
                            <p class="estudiante-campo-valor">{{ $estudiante->apellido }}</p>
                        </div>
                        <div>
                            <p class="estudiante-campo-etiqueta">Cédula:</p>
                            <p class="estudiante-campo-valor">{{ $estudiante->cedula }}</p>
                        </div>
                        <div>
                            <p class="estudiante-campo-etiqueta">Grado:</p>
                            <p class="estudiante-campo-valor">{{ $estudiante->grado }}</p>
                        </div>
                    </div>
                </div>

                <div class="estudiante-acciones-container">
                    <a href="{{ route('academico.asistencias.estudiante', $estudiante) }}" class="estudiante-accion-btn btn-asistencias">
                        <i class="fas fa-clipboard-check mr-2"></i>Ver Asistencias
                    </a>
                    <a href="{{ route('academico.notas.estudiante', $estudiante) }}" class="estudiante-accion-btn btn-notas">
                        <i class="fas fa-graduation-cap mr-2"></i>Ver Notas
                    </a>
                    <a href="{{ route('academico.estudiantes.edit', $estudiante) }}" class="estudiante-accion-btn btn-editar">
                        <i class="fas fa-edit mr-2"></i>Editar
                    </a>
                    <a href="{{ route('academico.estudiantes.index') }}" class="estudiante-accion-btn btn-volver">
                        <i class="fas fa-arrow-left mr-2"></i>Volver
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>