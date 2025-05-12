<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Movimientos de Inventario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100 dark:text-gray-100">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                        <h3 class="text-lg font-medium">Historial de Movimientos</h3>
                        <div class="flex space-x-2">
                            <a href="{{ route('farmacia.movimientos.entrada.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                                Registrar Entrada
                            </a>
                            <a href="{{ route('farmacia.movimientos.salida.create') }}" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                                Registrar Salida
                            </a>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    <!-- Filtros -->
                    <div class="bg-gray-800 dark:bg-gray-700 p-4 rounded-lg mb-6">
                        <h4 class="text-md font-medium mb-3">Filtros</h4>
                        <form action="{{ route('farmacia.movimientos.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div>
                                <label for="tipo_movimiento" class="block text-sm font-medium text-gray-400 mb-1">Tipo de Movimiento</label>
                                <select name="tipo_movimiento" id="tipo_movimiento" class="w-full rounded-md border-gray-700 bg-gray-700 text-white focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Todos</option>
                                    <option value="entrada" {{ request('tipo_movimiento') == 'entrada' ? 'selected' : '' }}>Entradas</option>
                                    <option value="salida" {{ request('tipo_movimiento') == 'salida' ? 'selected' : '' }}>Salidas</option>
                                </select>
                            </div>
                            <div>
                                <label for="medicamento_id" class="block text-sm font-medium text-gray-400 mb-1">Medicamento</label>
                                <select name="medicamento_id" id="medicamento_id" class="w-full rounded-md border-gray-700 bg-gray-700 text-white focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Todos</option>
                                    @foreach($medicamentos as $medicamento)
                                        <option value="{{ $medicamento->id }}" {{ request('medicamento_id') == $medicamento->id ? 'selected' : '' }}>
                                            {{ $medicamento->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="fecha_desde" class="block text-sm font-medium text-gray-400 mb-1">Fecha Desde</label>
                                <input type="date" name="fecha_desde" id="fecha_desde" value="{{ request('fecha_desde') }}" class="w-full rounded-md border-gray-700 bg-gray-700 text-white focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label for="fecha_hasta" class="block text-sm font-medium text-gray-400 mb-1">Fecha Hasta</label>
                                <input type="date" name="fecha_hasta" id="fecha_hasta" value="{{ request('fecha_hasta') }}" class="w-full rounded-md border-gray-700 bg-gray-700 text-white focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div class="md:col-span-4 flex justify-end">
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                    Filtrar
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="flex justify-center w-full">
                        <div class="overflow-x-auto w-full">
                            <table class="min-w-full bg-gray-800 dark:bg-gray-700 rounded-lg overflow-hidden shadow-md mx-auto">
                                <thead class="bg-gray-700 dark:bg-gray-600 text-gray-100 dark:text-gray-100">
                                    <tr>
                                        <th class="py-3 px-4 text-left">ID</th>
                                        <th class="py-3 px-4 text-left">Medicamento</th>
                                        <th class="py-3 px-4 text-left">Tipo</th>
                                        <th class="py-3 px-4 text-left">Cantidad</th>
                                        <th class="py-3 px-4 text-left">Motivo</th>
                                        <th class="py-3 px-4 text-left">Fecha</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-600 dark:divide-gray-500">
                                    @forelse($movimientos as $movimiento)
                                        <tr class="hover:bg-gray-700 dark:hover:bg-gray-600 text-gray-300">
                                            <td class="py-3 px-4">{{ $movimiento->id }}</td>
                                            <td class="py-3 px-4">{{ $movimiento->medicamento->nombre }}</td>
                                            <td class="py-3 px-4">
                                                <span class="px-2 py-1 rounded text-xs {{ $movimiento->tipo_movimiento == 'entrada' ? 'bg-green-600' : 'bg-red-600' }}">
                                                    {{ ucfirst($movimiento->tipo_movimiento) }}
                                                </span>
                                            </td>
                                            <td class="py-3 px-4">{{ $movimiento->cantidad }}</td>
                                            <td class="py-3 px-4">{{ $movimiento->motivo }}</td>
                                            <td class="py-3 px-4">{{ $movimiento->fecha_movimiento->format('d/m/Y H:i') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="py-4 px-4 text-center text-gray-400">No hay movimientos registrados</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Paginación -->
                    <div class="mt-4">
                        {{ $movimientos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>