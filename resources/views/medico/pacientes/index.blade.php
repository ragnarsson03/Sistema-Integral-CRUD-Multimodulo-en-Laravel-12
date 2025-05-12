<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestión de Pacientes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Lista de Pacientes</h3>
                        <a href="{{ route('medico.pacientes.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Nuevo Paciente
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
                                    <th class="py-3 px-4 text-left">Apellido</th>
                                    <th class="py-3 px-4 text-left">Cédula</th>
                                    <th class="py-3 px-4 text-left">Fecha Nacimiento</th>
                                    <th class="py-3 px-4 text-left">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-500">
                                @forelse($pacientes as $paciente)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="py-3 px-4">{{ $paciente->id }}</td>
                                        <td class="py-3 px-4">{{ $paciente->nombre }}</td>
                                        <td class="py-3 px-4">{{ $paciente->apellido }}</td>
                                        <td class="py-3 px-4">{{ $paciente->cedula }}</td>
                                        <td class="py-3 px-4">{{ $paciente->fecha_nacimiento }}</td>
                                        <td class="py-3 px-4 flex space-x-2">
                                            <a href="{{ route('medico.pacientes.show', $paciente) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                                Ver
                                            </a>
                                            <a href="{{ route('medico.pacientes.edit', $paciente) }}" class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300">
                                                Editar
                                            </a>
                                            <form action="{{ route('medico.pacientes.destroy', $paciente) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300" onclick="return confirm('¿Estás seguro de eliminar este paciente?')">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-3 px-4 text-center">No hay pacientes registrados.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $pacientes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>