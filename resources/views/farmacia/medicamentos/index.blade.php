<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestión de Medicamentos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Lista de Medicamentos</h3>
                        <a href="{{ route('farmacia.medicamentos.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Nuevo Medicamento
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-gray-700 rounded-lg overflow-hidden">
                            <thead class="bg-gray-100 dark:bg-gray-600 text-gray-900 dark:text-gray-100">
                                <tr>
                                    <th class="py-3 px-4 text-left">ID</th>
                                    <th class="py-3 px-4 text-left">Nombre</th>
                                    <th class="py-3 px-4 text-left">Descripción</th>
                                    <th class="py-3 px-4 text-left">Precio</th>
                                    <th class="py-3 px-4 text-left">Stock</th>
                                    <th class="py-3 px-4 text-left">Fecha Vencimiento</th>
                                    <th class="py-3 px-4 text-left">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-500">
                                @forelse($medicamentos as $medicamento)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="py-3 px-4">{{ $medicamento->id }}</td>
                                        <td class="py-3 px-4">{{ $medicamento->nombre }}</td>
                                        <td class="py-3 px-4">{{ $medicamento->descripcion }}</td>
                                        <td class="py-3 px-4">{{ $medicamento->precio }}</td>
                                        <td class="py-3 px-4">{{ $medicamento->stock }}</td>
                                        <td class="py-3 px-4">{{ $medicamento->fecha_vencimiento }}</td>
                                        <td class="py-3 px-4 flex space-x-2">
                                            <a href="{{ route('farmacia.medicamentos.show', $medicamento) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                                Ver
                                            </a>
                                            <a href="{{ route('farmacia.medicamentos.edit', $medicamento) }}" class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300">
                                                Editar
                                            </a>
                                            <form action="{{ route('farmacia.medicamentos.destroy', $medicamento) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300" onclick="return confirm('¿Estás seguro de eliminar este medicamento?')">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="py-3 px-4 text-center">No hay medicamentos registrados.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $medicamentos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>