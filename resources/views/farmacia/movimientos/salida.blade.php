<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Registrar Salida de Medicamentos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('farmacia.movimientos.salida.store') }}">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="medicamento_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Medicamento</label>
                            <select id="medicamento_id" name="medicamento_id" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Seleccione un medicamento</option>
                                @foreach($medicamentos as $medicamento)
                                    <option value="{{ $medicamento->id }}" {{ $medicamento->stock <= 0 ? 'disabled' : '' }}>
                                        {{ $medicamento->nombre }} (Stock disponible: {{ $medicamento->stock }})
                                    </option>
                                @endforeach
                            </select>
                            @error('medicamento_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="cantidad" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cantidad</label>
                            <input type="number" id="cantidad" name="cantidad" min="1" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('cantidad')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="motivo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Motivo</label>
                            <select id="motivo" name="motivo" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="venta">Venta</option>
                                <option value="caducidad">Caducidad</option>
                                <option value="deterioro">Deterioro</option>
                                <option value="ajuste">Ajuste de inventario</option>
                                <option value="otro">Otro</option>
                            </select>
                            @error('motivo')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="observaciones" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Observaciones</label>
                            <textarea id="observaciones" name="observaciones" rows="3" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                        </div>
                        
                        <div class="flex items-center justify-between mt-6">
                            <a href="{{ route('farmacia.movimientos.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancelar
                            </a>
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Registrar Salida
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>