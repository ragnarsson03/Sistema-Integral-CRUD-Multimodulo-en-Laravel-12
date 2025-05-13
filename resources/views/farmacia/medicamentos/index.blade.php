<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Inventario de Medicamentos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Botones de Acción Principal -->
            <div class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('farmacia.medicamentos.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-4 rounded text-center">
                    <i class="fas fa-plus-circle mr-2"></i>Nuevo Medicamento
                </a>
                <a href="{{ route('farmacia.movimientos.entrada.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded text-center">
                    <i class="fas fa-arrow-circle-down mr-2"></i>Registrar Entrada
                </a>
                <a href="{{ route('farmacia.movimientos.salida.create') }}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-3 px-4 rounded text-center">
                    <i class="fas fa-arrow-circle-up mr-2"></i>Registrar Salida
                </a>
            </div>

            <!-- Tabla de Inventario -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Almacén Actual</h3>
                    
                    <!-- Filtros de búsqueda -->
                    <div class="mb-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <input type="text" placeholder="Buscar por nombre..." class="rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                        <select class="rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                            <option value="">Todas las categorías</option>
                            <option value="analgesico">Analgésico</option>
                            <option value="antibiotico">Antibiótico</option>
                            <option value="antialergico">Antialérgico</option>
                            <option value="antiinflamatorio">Antiinflamatorio</option>
                            <option value="antidepresivo">Antidepresivo</option>
                            <option value="vitamina">Vitamina</option>
                        </select>
                        <select class="rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                            <option value="">Ordenar por...</option>
                            <option value="nombre">Nombre</option>
                            <option value="stock">Stock</option>
                            <option value="categoria">Categoría</option>
                        </select>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Código</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nombre</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Categoría</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Cantidad Disponible</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Estado</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-800">
                                @foreach($medicamentos as $medicamento)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $medicamento->codigo }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $medicamento->nombre }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ $medicamento->categoria }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="@if($medicamento->stock < 10) text-red-600 @else text-green-600 @endif font-semibold">
                                            {{ $medicamento->stock }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($medicamento->stock > 20)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Suficiente
                                            </span>
                                        @elseif($medicamento->stock > 10)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Moderado
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Bajo
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('farmacia.medicamentos.edit', $medicamento) }}" class="text-blue-600 hover:text-blue-900 mr-3">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                        <form action="{{ route('farmacia.medicamentos.destroy', $medicamento) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('¿Estás seguro de eliminar este medicamento?')">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </button>
                                        </form>
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