<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Movimientos de Inventario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between mb-6">
                        <div>
                            <a href="{{ route('farmacia.movimientos.entrada.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-2">
                                Registrar Entrada
                            </a>
                            <a href="{{ route('farmacia.movimientos.salida.create') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Registrar Salida
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('farmacia.dashboard') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Dashboard
                            </a>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600 text-left">ID</th>
                                    <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600 text-left">Tipo</th>
                                    <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600 text-left">Medicamento</th>
                                    <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600 text-left">Cantidad</th>
                                    <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600 text-left">Fecha</th>
                                    <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600 text-left">Usuario</th>
                                    <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600 text-left">Motivo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($movimientos as $movimiento)
                                <tr class="{{ $loop->even ? 'bg-gray-100 dark:bg-gray-800' : '' }}">
                                    <td class="py-2 px-4 border-b border-gray-300 dark:border-gray-600">{{ $movimiento->id }}</td>
                                    <td class="py-2 px-4 border-b border-gray-300 dark:border-gray-600">
                                        <span class="px-2 py-1 rounded {{ $movimiento->tipo === 'entrada' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                            {{ ucfirst($movimiento->tipo) }}
                                        </span>
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-300 dark:border-gray-600">{{ $movimiento->medicamento->nombre }}</td>
                                    <td class="py-2 px-4 border-b border-gray-300 dark:border-gray-600">{{ $movimiento->cantidad }}</td>
                                    <td class="py-2 px-4 border-b border-gray-300 dark:border-gray-600">{{ $movimiento->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="py-2 px-4 border-b border-gray-300 dark:border-gray-600">{{ $movimiento->usuario->name }}</td>
                                    <td class="py-2 px-4 border-b border-gray-300 dark:border-gray-600">{{ $movimiento->motivo }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="py-4 px-4 text-center border-b border-gray-300 dark:border-gray-600">No hay movimientos registrados</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $movimientos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>