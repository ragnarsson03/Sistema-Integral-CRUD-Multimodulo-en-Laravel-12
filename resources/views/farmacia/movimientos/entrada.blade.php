<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Registrar Entrada de Inventario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('farmacia.movimientos.entrada.store') }}">
                        @csrf
                        
                        <!-- Medicamento -->
                        <div class="mb-4">
                            <label for="medicamento_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Medicamento</label>
                            <select name="medicamento_id" id="medicamento_id" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="">Seleccionar medicamento</option>
                                @foreach($medicamentos as $medicamento)
                                    <option value="{{ $medicamento->id }}" {{ old('medicamento_id') == $medicamento->id ? 'selected' : '' }}>
                                        {{ $medicamento->nombre }} ({{ $medicamento->codigo }}) - Stock actual: {{ $medicamento->stock }}
                                    </option>
                                @endforeach
                            </select>
                            @error('medicamento_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Cantidad -->
                        <div class="mb-4">
                            <label for="cantidad" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cantidad</label>
                            <input type="number" name="cantidad" id="cantidad" value="{{ old('cantidad') }}" min="1" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                            @error('cantidad')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Motivo -->
                        <div class="mb-4">
                            <label for="motivo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Motivo</label>
                            <select name="motivo" id="motivo" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="">Seleccionar motivo</option>
                                <option value="compra" {{ old('motivo') == 'compra' ? 'selected' : '' }}>Compra</option>
                                <option value="donacion" {{ old('motivo') == 'donacion' ? 'selected' : '' }}>Donación</option>
                                <option value="devolucion" {{ old('motivo') == 'devolucion' ? 'selected' : '' }}>Devolución</option>
                                <option value="ajuste" {{ old('motivo') == 'ajuste' ? 'selected' : '' }}>Ajuste de inventario</option>
                                <option value="otro" {{ old('motivo') == 'otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                            @error('motivo')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Fecha del Movimiento -->
                        <div class="mb-4">
                            <label for="fecha_movimiento" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fecha del Movimiento</label>
                            <input type="datetime-local" name="fecha_movimiento" id="fecha_movimiento" value="{{ old('fecha_movimiento', now()->format('Y-m-d\TH:i')) }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                            @error('fecha_movimiento')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Observaciones -->
                        <div class="mb-4">
                            <label for="observaciones" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Observaciones</label>
                            <textarea name="observaciones" id="observaciones" rows="3" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('observaciones') }}</textarea>
                            @error('observaciones')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('farmacia.movimientos.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-400 dark:hover:bg-gray-600 active:bg-gray-500 dark:active:bg-gray-500 focus:outline-none focus:border-gray-500 focus:ring ring-gray-300 dark:ring-gray-700 disabled:opacity-25 transition ease-in-out duration-150 mr-3">
                                Cancelar
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-800 focus:outline-none focus:border-green-800 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Registrar Entrada
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>