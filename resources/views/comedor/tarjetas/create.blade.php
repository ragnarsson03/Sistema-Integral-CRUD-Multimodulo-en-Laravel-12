<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Nueva Tarjeta de Comedor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('comedor.tarjetas.store') }}">
                        @csrf
                        
                        <!-- Código de Tarjeta -->
                        <div class="mb-4">
                            <label for="codigo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Código de Tarjeta</label>
                            <input type="text" name="codigo" id="codigo" value="{{ old('codigo') }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                            @error('codigo')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Estudiante -->
                        <div class="mb-4">
                            <label for="estudiante_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Estudiante</label>
                            <select name="estudiante_id" id="estudiante_id" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="">Seleccionar estudiante</option>
                                @foreach(\App\Models\Academico\Estudiante::orderBy('apellido')->get() as $estudiante)
                                    <option value="{{ $estudiante->id }}" {{ old('estudiante_id') == $estudiante->id ? 'selected' : '' }}>
                                        {{ $estudiante->apellido }}, {{ $estudiante->nombre }} - {{ $estudiante->cedula }}
                                    </option>
                                @endforeach
                            </select>
                            @error('estudiante_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Saldo Inicial -->
                        <div class="mb-4">
                            <label for="saldo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Saldo Inicial</label>
                            <input type="number" name="saldo" id="saldo" value="{{ old('saldo', 0) }}" step="0.01" min="0" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                            @error('saldo')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Estado de la Tarjeta -->
                        <div class="mb-4">
                            <label for="activa" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Estado de la Tarjeta</label>
                            <div class="mt-2">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="activa" id="activa" value="1" {{ old('activa') ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Activa</span>
                                </label>
                            </div>
                            @error('activa')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('comedor.tarjetas.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-2">
                                Cancelar
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>