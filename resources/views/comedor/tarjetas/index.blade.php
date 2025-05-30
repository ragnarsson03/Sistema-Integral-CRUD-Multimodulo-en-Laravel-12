<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestión de Tarjetas de Comedor') }}
        </h2>
        <link rel="stylesheet" href="{{ asset('css/comedor.css') }}">
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Encabezado del módulo -->
            <div class="comedor-header mb-6">
                <h1 class="comedor-title">Sistema de Tarjetas de Comedor</h1>
                <p class="comedor-subtitle">Gestión de tarjetas para el servicio de alimentación universitaria</p>
            </div>
            
            <!-- Botones de Acción Principal -->
            <div class="mb-6 flex justify-center space-x-4">
                <a href="{{ route('comedor.tarjetas.create') }}" class="comedor-button comedor-button-success">
                    <i class="fas fa-plus-circle mr-2"></i>Nueva Tarjeta
                </a>
            </div>

            <!-- Mensajes de éxito -->
            @if(session('success'))
                <div class="comedor-alert comedor-alert-success mb-4" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <!-- Tabla de Tarjetas -->
            <div class="comedor-container">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold text-center mb-6">Tarjetas Registradas</h3>
                    
                    <div class="overflow-x-auto">
                        <table class="comedor-table min-w-full">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Estudiante</th>
                                    <th>Saldo</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tarjetas as $tarjeta)
                                    <tr>
                                        <td>{{ $tarjeta->codigo }}</td>
                                        <td>
                                            {{ $tarjeta->estudiante->nombre }} {{ $tarjeta->estudiante->apellido }}
                                        </td>
                                        <td>
                                            ${{ number_format($tarjeta->saldo, 2) }}
                                        </td>
                                        <td>
                                            @if($tarjeta->activa)
                                                <span class="estado-badge estado-activo">
                                                    Activa
                                                </span>
                                            @else
                                                <span class="estado-badge estado-inactivo">
                                                    Inactiva
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="flex justify-center space-x-2">
                                                <a href="{{ route('comedor.tarjetas.show', $tarjeta) }}" class="comedor-button comedor-button-primary py-1 px-3 text-xs">
                                                    Ver
                                                </a>
                                                <a href="{{ route('comedor.tarjetas.edit', $tarjeta) }}" class="comedor-button comedor-button-warning py-1 px-3 text-xs">
                                                    Editar
                                                </a>
                                                <form action="{{ route('comedor.tarjetas.destroy', $tarjeta) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="comedor-button comedor-button-danger py-1 px-3 text-xs" onclick="return confirm('¿Estás seguro de eliminar esta tarjeta?')">
                                                        Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4">
                                            No hay tarjetas registradas
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Paginación -->
                    <div class="mt-4">
                        {{ $tarjetas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>