
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestión de Usuarios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Listado de Usuarios</h3>
                        <a href="{{ route('usuarios.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Agregar Nuevo Usuario
                        </a>
                    </div>

                    <!-- Formulario de búsqueda -->
                    <form action="{{ route('usuarios.index') }}" method="GET" class="mb-6">
                        <div class="flex items-center gap-2">
                            <input 
                                type="text" 
                                name="search" 
                                placeholder="Buscar por nombre o email..." 
                                class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm"
                                value="{{ request('search') }}"
                            >
                            <button type="submit" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">Buscar</button>
                            @if(request('search'))
                                <a href="{{ route('usuarios.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Limpiar</a>
                            @endif
                        </div>
                    </form>

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
                                    <th class="py-3 px-4 text-left">Email</th>
                                    <th class="py-3 px-4 text-left">Roles</th>
                                    <th class="py-3 px-4 text-left">Fecha Creación</th>
                                    <th class="py-3 px-4 text-left">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-500">
                                @forelse($usuarios as $usuario)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="py-3 px-4">{{ $usuario->id }}</td>
                                        <td class="py-3 px-4">{{ $usuario->name }}</td>
                                        <td class="py-3 px-4">{{ $usuario->email }}</td>
                                        <td class="py-3 px-4">
                                            @foreach($usuario->roles as $role)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 mr-1">
                                                    {{ $role->name }}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td class="py-3 px-4">{{ $usuario->created_at->format('d/m/Y') }}</td>
                                        <td class="py-3 px-4">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('usuarios.show', $usuario) }}" class="px-2 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                                                    Ver
                                                </a>
                                                <a href="{{ route('usuarios.edit', $usuario) }}" class="px-2 py-1 bg-yellow-600 text-white rounded hover:bg-yellow-700 text-sm">
                                                    Editar
                                                </a>
                                                <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                                        Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-3 px-4 text-center">
                                            @if(request('search'))
                                                No se encontraron usuarios que coincidan con "{{ request('search') }}"
                                            @else
                                                No hay usuarios registrados
                                            @endif
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $usuarios->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>