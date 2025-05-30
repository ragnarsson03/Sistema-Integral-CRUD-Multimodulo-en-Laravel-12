<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Tarjeta de Comedor') }}
        </h2>
        <link rel="stylesheet" href="{{ asset('css/comedor.css') }}">
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Encabezado del formulario -->
            <div class="comedor-header mb-6">
                <h1 class="comedor-title">Edición de Tarjeta</h1>
                <p class="comedor-subtitle">Modifique los datos de la tarjeta de comedor</p>
            </div>
            
            <div class="comedor-container">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('comedor.tarjetas.update', $tarjeta) }}">
                        @csrf
                        @method('PUT')
                        
                        <!-- Código de Tarjeta -->
                        <div class="comedor-form-group">
                            <label for="codigo" class="comedor-form-label">Código de Tarjeta</label>
                            <input type="text" name="codigo" id="codigo" value="{{ old('codigo', $tarjeta->codigo) }}" class="comedor-form-input" required>
                            @error('codigo')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Estudiante -->
                        <div class="comedor-form-group">
                            <label for="estudiante_id" class="comedor-form-label">Estudiante</label>
                            <select name="estudiante_id" id="estudiante_id" class="comedor-form-select" required>
                                <option value="">Seleccionar estudiante</option>
                                @foreach(\App\Models\Academico\Estudiante::orderBy('apellido')->get() as $estudiante)
                                    <option value="{{ $estudiante->id }}" {{ (old('estudiante_id', $tarjeta->estudiante_id) == $estudiante->id) ? 'selected' : '' }}>
                                        {{ $estudiante->apellido }}, {{ $estudiante->nombre }} - {{ $estudiante->cedula }}
                                    </option>
                                @endforeach
                            </select>
                            @error('estudiante_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Saldo -->
                        <div class="comedor-form-group">
                            <label for="saldo" class="comedor-form-label">Saldo</label>
                            <input type="number" name="saldo" id="saldo" value="{{ old('saldo', $tarjeta->saldo) }}" step="0.01" min="0" class="comedor-form-input" required>
                            @error('saldo')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Estado de la Tarjeta -->
                        <div class="comedor-form-group">
                            <label for="activa" class="comedor-form-label">Estado de la Tarjeta</label>
                            <div class="mt-2">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="activa" id="activa" value="1" {{ old('activa', $tarjeta->activa) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Activa</span>
                                </label>
                            </div>
                            @error('activa')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('comedor.tarjetas.index') }}" class="comedor-button comedor-button-danger mr-2">
                                Cancelar
                            </a>
                            <button type="submit" class="comedor-button comedor-button-primary">
                                Actualizar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>