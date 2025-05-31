<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Registro de Notas') }}
        </h2>
    </x-slot>
        <!-- Incluir el navbar específico de estudiantes -->
        @include('academico.estudiantes.navbar')


    <!-- Agregar referencia al archivo CSS de alertas -->
    <link rel="stylesheet" href="{{ asset('css/alerts.css') }}">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Agregar alerta cuando no hay cursos -->
            @if($cursos->isEmpty())
                <div class="alert-container">
                    <div class="alert-warning" role="alert">
                        <p>Necesitas crear un curso antes de añadir notas.</p>
                        <a href="{{ route('academico.cursos.create') }}" class="alert-action-button">Crear un curso ahora</a>
                    </div>
                </div>
            @endif
            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium">Listado de Notas</h3>
                    
                    <div class="mt-4">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">Notas</h3>
                            <div class="space-x-2">
                                @if($cursos->isEmpty())
                                    <a href="{{ route('academico.cursos.create') }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                        </svg>
                                        Crear Curso
                                    </a>
                                @endif
                                <a href="{{ route('academico.notas.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Nueva Nota
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>