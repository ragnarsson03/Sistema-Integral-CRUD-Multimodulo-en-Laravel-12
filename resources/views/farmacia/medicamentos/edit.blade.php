<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Medicamento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('farmacia.medicamentos.update', $medicamento) }}">
                        @csrf
                        @method('PUT')
                        
                        <!-- Nombre -->
                        <div class="mb-4">
                            <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $medicamento->nombre) }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                            @error('nombre')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Código -->
                        <div class="mb-4">
                            <label for="codigo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Código</label>
                            <input type="text" name="codigo" id="codigo" value="{{ old('codigo', $medicamento->codigo) }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                            @error('codigo')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Categoría -->
                        <div class="mb-4">
                            <label for="categoria" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Categoría del Medicamento
                                <span class="text-xs text-gray-500">(Tipo de medicamento)</span>
                            </label>
                            <select name="categoria" id="categoria" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="">Seleccionar categoría</option>
                                <option value="analgesico" {{ old('categoria', $medicamento->categoria) == 'analgesico' ? 'selected' : '' }}>Analgésico</option>
                                <option value="antibiotico" {{ old('categoria', $medicamento->categoria) == 'antibiotico' ? 'selected' : '' }}>Antibiótico</option>
                                <option value="antialergico" {{ old('categoria', $medicamento->categoria) == 'antialergico' ? 'selected' : '' }}>Antialérgico</option>
                                <option value="antiinflamatorio" {{ old('categoria', $medicamento->categoria) == 'antiinflamatorio' ? 'selected' : '' }}>Antiinflamatorio</option>
                                <option value="antidepresivo" {{ old('categoria', $medicamento->categoria) == 'antidepresivo' ? 'selected' : '' }}>Antidepresivo</option>
                                <option value="vitamina" {{ old('categoria', $medicamento->categoria) == 'vitamina' ? 'selected' : '' }}>Vitamina</option>
                                <option value="otro" {{ old('categoria', $medicamento->categoria) == 'otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                            @error('categoria')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Descripción -->
                        <div class="mb-4">
                            <label for="descripcion" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descripción</label>
                            <textarea name="descripcion" id="descripcion" rows="3" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('descripcion', $medicamento->descripcion) }}</textarea>
                            @error('descripcion')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Precio -->
                        <div class="mb-4">
                            <label for="precio" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Precio</label>
                            <input type="number" step="0.01" name="precio" id="precio" value="{{ old('precio', $medicamento->precio) }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                            @error('precio')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Cantidad inicial en inventario -->
                        <div class="mb-4">
                            <label for="stock" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Cantidad inicial en inventario
                                <span class="text-xs text-gray-500">(Número de unidades disponibles)</span>
                            </label>
                            <input type="number" name="stock" id="stock" min="0" value="{{ old('stock', $medicamento->stock) }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                            @error('stock')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Fecha de Vencimiento -->
                        <div class="mb-4">
                            <label for="fecha_vencimiento" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fecha de Vencimiento</label>
                            <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" 
                                value="{{ old('fecha_vencimiento', $medicamento->fecha_vencimiento->format('Y-m-d')) }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500" 
                                required>
                            @error('fecha_vencimiento')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('farmacia.medicamentos.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-400 dark:hover:bg-gray-600 active:bg-gray-500 dark:active:bg-gray-500 focus:outline-none focus:border-gray-500 focus:ring ring-gray-300 dark:ring-gray-700 disabled:opacity-25 transition ease-in-out duration-150 mr-3">
                                Cancelar
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-800 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Actualizar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>