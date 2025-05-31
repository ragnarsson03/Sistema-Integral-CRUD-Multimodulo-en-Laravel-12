<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Estudiante') }}
        </h2>
        <link rel="stylesheet" href="{{ asset('css/academico-estudiante-editar.css') }}">
    </x-slot>

    <!-- Incluir el navbar específico de estudiantes -->
    @include('academico.estudiantes.navbar')

    <div class="py-12 academic-background">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Mensaje de éxito -->
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            
            <div class="academic-edit-container">
                <h3 class="academic-edit-title">Editar información del estudiante</h3>

                <form method="POST" action="{{ route('academico.estudiantes.update', $estudiante) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nombre -->
                        <div>
                            <label for="nombre" class="academic-edit-label">{{ __('Nombre') }}</label>
                            <input id="nombre" name="nombre" type="text" class="academic-edit-input" value="{{ old('nombre', $estudiante->nombre) }}" required autofocus />
                            <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                        </div>

                        <!-- Apellido -->
                        <div>
                            <label for="apellido" class="academic-edit-label">{{ __('Apellido') }}</label>
                            <input id="apellido" name="apellido" type="text" class="academic-edit-input" value="{{ old('apellido', $estudiante->apellido) }}" required />
                            <x-input-error :messages="$errors->get('apellido')" class="mt-2" />
                        </div>

                        <!-- Cédula -->
                        <div>
                            <label for="cedula" class="academic-edit-label">{{ __('Cédula') }}</label>
                            <input id="cedula" name="cedula" type="text" class="academic-edit-input" value="{{ old('cedula', $estudiante->cedula) }}" required />
                            <x-input-error :messages="$errors->get('cedula')" class="mt-2" />
                        </div>

                        <!-- Grado -->
                        <div>
                            <label for="grado" class="academic-edit-label">{{ __('Grado') }}</label>
                            <select id="grado" name="grado" class="academic-edit-select">
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ old('grado', $estudiante->grado) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            <x-input-error :messages="$errors->get('grado')" class="mt-2" />
                        </div>
                    </div>

                    <div class="academic-edit-button-container">
                        <a href="{{ route('academico.estudiantes.index') }}" class="academic-edit-button academic-edit-button-cancel">
                            Cancelar
                        </a>
                        <button type="submit" class="academic-edit-button academic-edit-button-save">
                            {{ __('Guardar Cambios') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>