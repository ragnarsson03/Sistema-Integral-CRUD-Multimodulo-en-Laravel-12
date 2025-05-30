<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalles de Tarjeta de Comedor') }}
        </h2>
        <link rel="stylesheet" href="{{ asset('css/comedor.css') }}">
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Encabezado de la vista de detalles -->
            <div class="comedor-header mb-6">
                <h1 class="comedor-title">Información de Tarjeta</h1>
                <p class="comedor-subtitle">Detalles completos de la tarjeta y su historial de transacciones</p>
            </div>
            
            <div class="comedor-container">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <h3 class="info-card-title">Información de la Tarjeta</h3>
                        
                        <div class="info-card">
                            <div class="info-card-content">
                                <div class="info-item">
                                    <p class="info-label">Código:</p>
                                    <p class="info-value">{{ $tarjeta->codigo }}</p>
                                </div>
                                
                                <div class="info-item">
                                    <p class="info-label">Estado:</p>
                                    <p class="info-value">
                                        @if($tarjeta->activa)
                                            <span class="estado-badge estado-activo">
                                                Activa
                                            </span>
                                        @else
                                            <span class="estado-badge estado-inactivo">
                                                Inactiva
                                            </span>
                                        @endif
                                    </p>
                                </div>
                                
                                <div class="info-item">
                                    <p class="info-label">Saldo Actual:</p>
                                    <p class="info-value">${{ number_format($tarjeta->saldo, 2) }}</p>
                                </div>
                                
                                <div class="info-item">
                                    <p class="info-label">Fecha de Creación:</p>
                                    <p class="info-value">{{ $tarjeta->created_at->format('d/m/Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <h3 class="info-card-title">Información del Estudiante</h3>
                        
                        <div class="info-card">
                            <div class="info-card-content">
                                <div class="info-item">
                                    <p class="info-label">Nombre Completo:</p>
                                    <p class="info-value">{{ $tarjeta->estudiante->nombre }} {{ $tarjeta->estudiante->apellido }}</p>
                                </div>
                                
                                <div class="info-item">
                                    <p class="info-label">Cédula:</p>
                                    <p class="info-value">{{ $tarjeta->estudiante->cedula }}</p>
                                </div>
                                
                                <div class="info-item">
                                    <p class="info-label">Grado:</p>
                                    <p class="info-value">{{ $tarjeta->estudiante->grado }}</p>
                                </div>
                                
                                <div class="info-item">
                                    <p class="info-label">Curso:</p>
                                    <p class="info-value">{{ $tarjeta->estudiante->curso ? $tarjeta->estudiante->curso->nombre : 'No asignado' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Historial de Transacciones (si existe) -->
                    @if($tarjeta->transacciones && $tarjeta->transacciones->count() > 0)
                    <div class="mb-6 transacciones-section">
                        <h3 class="info-card-title">Historial de Transacciones</h3>
                        
                        <div class="overflow-x-auto">
                            <table class="comedor-table min-w-full">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Tipo</th>
                                        <th>Monto</th>
                                        <th>Descripción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tarjeta->transacciones as $transaccion)
                                    <tr>
                                        <td>{{ $transaccion->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            @if($transaccion->tipo == 'recarga')
                                                <span class="estado-badge estado-activo transaccion-tipo-recarga">
                                                    Recarga
                                                </span>
                                            @else
                                                <span class="estado-badge estado-inactivo transaccion-tipo-consumo">
                                                    Consumo
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            ${{ number_format($transaccion->monto, 2) }}
                                        </td>
                                        <td>{{ $transaccion->descripcion }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                    
                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('comedor.tarjetas.index') }}" class="comedor-button comedor-button-danger mr-2">
                            Volver
                        </a>
                        <a href="{{ route('comedor.tarjetas.edit', $tarjeta) }}" class="comedor-button comedor-button-primary">
                            Editar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>