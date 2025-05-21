<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Estudiante') }}
        </h2>
    </x-slot>

    <div class="py-12 academic-background">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="academic-container p-6">
                <h3 class="academic-title">Editar información del estudiante</h3>

                <form method="POST" action="{{ route('academico.estudiantes.update', $estudiante) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nombre -->
                        <div>
                            <x-input-label for="nombre" :value="__('Nombre')" class="text-white" />
                            <x-text-input id="nombre" name="nombre" type="text" class="mt-1 block w-full" :value="old('nombre', $estudiante->nombre)" required autofocus />
                            <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                        </div>

                        <!-- Apellido -->
                        <div>
                            <x-input-label for="apellido" :value="__('Apellido')" class="text-white" />
                            <x-text-input id="apellido" name="apellido" type="text" class="mt-1 block w-full" :value="old('apellido', $estudiante->apellido)" required />
                            <x-input-error :messages="$errors->get('apellido')" class="mt-2" />
                        </div>

                        <!-- Cédula -->
                        <div>
                            <x-input-label for="cedula" :value="__('Cédula')" class="text-white" />
                            <x-text-input id="cedula" name="cedula" type="text" class="mt-1 block w-full" :value="old('cedula', $estudiante->cedula)" required />
                            <x-input-error :messages="$errors->get('cedula')" class="mt-2" />
                        </div>

                        <!-- Grado -->
                        <div>
                            <x-input-label for="grado" :value="__('Grado')" class="text-white" />
                            <select id="grado" name="grado" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ old('grado', $estudiante->grado) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            <x-input-error :messages="$errors->get('grado')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('academico.estudiantes.index') }}" class="academic-button bg-gray-500 text-white mr-4">
                            Cancelar
                        </a>
                        <x-primary-button class="ml-4 academic-button academic-button-primary">
                            {{ __('Guardar Cambios') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>