<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Inventario de Medicamentos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Botones de Acción Principal -->
            <div class="mb-6 flex justify-center space-x-4">
                <a href="{{ route('farmacia.medicamentos.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg text-center transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-plus-circle mr-2"></i>Nuevo Medicamento
                </a>
                <a href="{{ route('farmacia.movimientos.entrada.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg text-center transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-arrow-circle-down mr-2"></i>Registrar Entrada
                </a>
                <a href="{{ route('farmacia.movimientos.salida.create') }}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-3 px-6 rounded-lg text-center transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-arrow-circle-up mr-2"></i>Registrar Salida
                </a>
            </div>

            <!-- Tabla de Inventario -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold text-center mb-6">Almacén Actual</h3>
                    
                    <!-- Filtros de búsqueda -->
                    <div class="mb-6 flex justify-center space-x-4">
                        <input type="text" 
                               placeholder="Buscar por nombre..." 
                               class="rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 w-1/3 focus:ring-2 focus:ring-blue-500">
                        <select class="rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 w-1/4 focus:ring-2 focus:ring-blue-500">
                            <option value="">Todas las categorías</option>
                            <option value="analgesico">Analgésico</option>
                            <option value="antibiotico">Antibiótico</option>
                            <option value="antialergico">Antialérgico</option>
                            <option value="antiinflamatorio">Antiinflamatorio</option>
                            <option value="antidepresivo">Antidepresivo</option>
                            <option value="vitamina">Vitamina</option>
                        </select>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Código</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nombre</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Categoría</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Cantidad Disponible</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Fecha Vencimiento</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Estado</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-800">
                                @foreach($medicamentos as $medicamento)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150">
                                    <td class="px-6 py-4 text-center whitespace-nowrap">{{ $medicamento->codigo }}</td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">{{ $medicamento->nombre }}</td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ $medicamento->categoria }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        <span class="font-bold @if($medicamento->stock < 10) text-red-600 @else text-green-600 @endif">
                                            {{ $medicamento->stock }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full {{ strtotime($medicamento->fecha_vencimiento) < strtotime('+30 days') ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                            {{ $medicamento->fecha_vencimiento->format('d/m/Y') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        @if($medicamento->stock > 20)
                                            <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                                Suficiente
                                            </span>
                                        @elseif($medicamento->stock > 10)
                                            <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Moderado
                                            </span>
                                        @else
                                            <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-red-100 text-red-800">
                                                Bajo
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        <div class="flex justify-center space-x-2">
                                            <a href="{{ route('farmacia.medicamentos.edit', $medicamento) }}" 
                                               class="bg-blue-500 hover:bg-blue-700 text-white px-3 py-1 rounded-lg transition duration-300">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                            <form action="{{ route('farmacia.medicamentos.destroy', $medicamento) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="bg-red-500 hover:bg-red-700 text-white px-3 py-1 rounded-lg transition duration-300"
                                                        onclick="return confirm('¿Estás seguro de eliminar este medicamento?')">
                                                    <i class="fas fa-trash"></i> Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
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