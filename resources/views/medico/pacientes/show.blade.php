<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalles del Paciente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <a href="{{ route('medico.pacientes.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-400 dark:hover:bg-gray-600 active:bg-gray-500 dark:active:bg-gray-500 focus:outline-none focus:border-gray-500 focus:ring ring-gray-300 dark:ring-gray-700 disabled:opacity-25 transition ease-in-out duration-150">
                            Volver a la lista
                        </a>
                    </div>

                    <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-200">Información del Paciente</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Nombre:</p>
                                <p class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $paciente->nombre }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Apellido:</p>
                                <p class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $paciente->apellido }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Cédula:</p>
                                <p class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $paciente->cedula }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Fecha de Nacimiento:</p>
                                <p class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $paciente->fecha_nacimiento }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Género:</p>
                                <p class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ ucfirst($paciente->genero) }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Dirección:</p>
                                <p class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $paciente->direccion ?: 'No especificada' }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Teléfono:</p>
                                <p class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $paciente->telefono ?: 'No especificado' }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Email:</p>
                                <p class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $paciente->email ?: 'No especificado' }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-end mt-6 space-x-4">
                        <a href="{{ route('medico.pacientes.edit', $paciente) }}" class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 active:bg-yellow-800 focus:outline-none focus:border-yellow-800 focus:ring ring-yellow-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Editar
                        </a>
                        <form action="{{ route('medico.pacientes.destroy', $paciente) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-800 focus:outline-none focus:border-red-800 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150" onclick="return confirm('¿Estás seguro de eliminar este paciente?')">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>