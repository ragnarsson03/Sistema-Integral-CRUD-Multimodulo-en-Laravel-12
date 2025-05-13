<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Registrar Salida de Medicamento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('farmacia.movimientos.salida.store') }}">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="medicamento_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Medicamento
                            </label>
                            <select name="medicamento_id" id="medicamento_id" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300" required>
                                <option value="">Seleccionar medicamento</option>
                                @foreach($medicamentos as $medicamento)
                                    <option value="{{ $medicamento->id }}">
                                        {{ $medicamento->nombre }} (Disponible: {{ $medicamento->stock }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="cantidad" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Cantidad a retirar
                            </label>
                            <input type="number" name="cantidad" id="cantidad" min="1" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300" required>
                        </div>

                        <div class="mb-4">
                            <label for="motivo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Motivo de la salida
                            </label>
                            <select name="motivo" id="motivo" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300" required>
                                <option value="venta">Venta</option>
                                <option value="vencimiento">Vencimiento</option>
                                <option value="daño">Daño/Deterioro</option>
                                <option value="otro">Otro</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="observaciones" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Observaciones
                            </label>
                            <textarea name="observaciones" id="observaciones" rows="3" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"></textarea>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Registrar Salida
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>