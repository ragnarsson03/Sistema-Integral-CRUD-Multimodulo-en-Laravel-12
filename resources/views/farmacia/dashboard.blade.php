<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard de Inventario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Resumen de Inventario -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-semibold mb-2">Total de Medicamentos</h3>
                        <p class="text-3xl font-bold">{{ $total_medicamentos }}</p>
                    </div>
                </div>
                
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-semibold mb-2">Entradas (Último mes)</h3>
                        <p class="text-3xl font-bold">{{ $entradas_mes }}</p>
                    </div>
                </div>
                
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-semibold mb-2">Salidas (Último mes)</h3>
                        <p class="text-3xl font-bold">{{ $salidas_mes }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Medicamentos con Stock Bajo -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Medicamentos con Stock Bajo</h3>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600 text-left">Medicamento</th>
                                    <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600 text-left">Stock Actual</th>
                                    <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600 text-left">Stock Mínimo</th>
                                    <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600 text-left">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($stock_bajo as $medicamento)
                                <tr class="{{ $loop->even ? 'bg-gray-100 dark:bg-gray-800' : '' }}">
                                    <td class="py-2 px-4 border-b border-gray-300 dark:border-gray-600">{{ $medicamento->nombre }}</td>
                                    <td class="py-2 px-4 border-b border-gray-300 dark:border-gray-600">
                                        <span class="px-2 py-1 rounded bg-red-200 text-red-800">
                                            {{ $medicamento->stock }}
                                        </span>
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-300 dark:border-gray-600">{{ $medicamento->stock_minimo }}</td>
                                    <td class="py-2 px-4 border-b border-gray-300 dark:border-gray-600">
                                        <a href="{{ route('farmacia.movimientos.entrada.create') }}" class="text-blue-500 hover:underline">Registrar Entrada</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="py-4 px-4 text-center border-b border-gray-300 dark:border-gray-600">No hay medicamentos con stock bajo</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Medicamentos Próximos a Vencer -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Medicamentos Próximos a Vencer</h3>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600 text-left">Medicamento</th>
                                    <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600 text-left">Fecha de Vencimiento</th>
                                    <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600 text-left">Stock</th>
                                    <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600 text-left">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($proximos_vencer as $medicamento)
                                <tr class="{{ $loop->even ? 'bg-gray-100 dark:bg-gray-800' : '' }}">
                                    <td class="py-2 px-4 border-b border-gray-300 dark:border-gray-600">{{ $medicamento->nombre }}</td>
                                    <td class="py-2 px-4 border-b border-gray-300 dark:border-gray-600">
                                        <span class="px-2 py-1 rounded bg-yellow-200 text-yellow-800">
                                            {{ $medicamento->fecha_vencimiento->format('d/m/Y') }}
                                        </span>
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-300 dark:border-gray-600">{{ $medicamento->stock }}</td>
                                    <td class="py-2 px-4 border-b border-gray-300 dark:border-gray-600">
                                        <a href="{{ route('farmacia.movimientos.salida.create') }}" class="text-blue-500 hover:underline">Registrar Salida</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="py-4 px-4 text-center border-b border-gray-300 dark:border-gray-600">No hay medicamentos próximos a vencer</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Enlaces a Reportes -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Reportes Disponibles</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="{{ route('farmacia.reportes.movimientos') }}" class="block p-4 bg-blue-50 dark:bg-blue-900 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-800">
                            <h4 class="font-medium text-blue-700 dark:text-blue-300">Movimientos por Período</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Genera un reporte de movimientos por rango de fechas</p>
                        </a>
                        
                        <a href="{{ route('farmacia.reportes.inventario') }}" class="block p-4 bg-green-50 dark:bg-green-900 rounded-lg hover:bg-green-100 dark:hover:bg-green-800">
                            <h4 class="font-medium text-green-700 dark:text-green-300">Inventario Actual</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Genera un reporte del inventario actual</p>
                        </a>
                        
                        <a href="{{ route('farmacia.reportes.mas-vendidos') }}" class="block p-4 bg-purple-50 dark:bg-purple-900 rounded-lg hover:bg-purple-100 dark:hover:bg-purple-800">
                            <h4 class="font-medium text-purple-700 dark:text-purple-300">Medicamentos Más Vendidos</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Genera un reporte de los medicamentos más vendidos</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>