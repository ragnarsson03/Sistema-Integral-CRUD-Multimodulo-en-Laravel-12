<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Registro de Notas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Mensaje de éxito -->
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Filtros -->
            <div class="mb-6 flex justify-center space-x-4">
                <form action="{{ route('academico.notas.index') }}" method="GET" class="flex space-x-4">
                    <select name="grado" class="rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 focus:ring-2 focus:ring-blue-500">
                        <option value="">Todos los grados</option>
                        <option value="1" {{ request('grado') == '1' ? 'selected' : '' }}>Primer Grado</option>
                        <option value="2" {{ request('grado') == '2' ? 'selected' : '' }}>Segundo Grado</option>
                        <option value="3" {{ request('grado') == '3' ? 'selected' : '' }}>Tercer Grado</option>
                        <option value="4" {{ request('grado') == '4' ? 'selected' : '' }}>Cuarto Grado</option>
                        <option value="5" {{ request('grado') == '5' ? 'selected' : '' }}>Quinto Grado</option>
                        <option value="6" {{ request('grado') == '6' ? 'selected' : '' }}>Sexto Grado</option>
                    </select>
                    <select name="asignatura" class="rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 focus:ring-2 focus:ring-blue-500">
                        <option value="">Todas las asignaturas</option>
                        <option value="Matemáticas" {{ request('asignatura') == 'Matemáticas' ? 'selected' : '' }}>Matemáticas</option>
                        <option value="Lenguaje" {{ request('asignatura') == 'Lenguaje' ? 'selected' : '' }}>Lenguaje</option>
                        <option value="Ciencias" {{ request('asignatura') == 'Ciencias' ? 'selected' : '' }}>Ciencias</option>
                        <option value="Historia" {{ request('asignatura') == 'Historia' ? 'selected' : '' }}>Historia</option>
                        <option value="Inglés" {{ request('asignatura') == 'Inglés' ? 'selected' : '' }}>Inglés</option>
                    </select>
                    <select name="periodo" class="rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 focus:ring-2 focus:ring-blue-500">
                        <option value="">Todos los períodos</option>
                        <option value="Primer Bimestre" {{ request('periodo') == 'Primer Bimestre' ? 'selected' : '' }}>Primer Bimestre</option>
                        <option value="Segundo Bimestre" {{ request('periodo') == 'Segundo Bimestre' ? 'selected' : '' }}>Segundo Bimestre</option>
                        <option value="Tercer Bimestre" {{ request('periodo') == 'Tercer Bimestre' ? 'selected' : '' }}>Tercer Bimestre</option>
                        <option value="Cuarto Bimestre" {{ request('periodo') == 'Cuarto Bimestre' ? 'selected' : '' }}>Cuarto Bimestre</option>
                    </select>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                        Filtrar
                    </button>
                </form>
            </div>

            <!-- Tabla de Notas -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold text-center mb-6">Registro de Calificaciones</h3>
                    
                    <div class="mb-6 flex justify-end">
                        <a href="{{ route('academico.notas.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg">
                            <i class="fas fa-plus-circle mr-2"></i>Nueva Calificación
                        </a>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Estudiante</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Grado</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Asignatura</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Calificación</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Período</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Fecha</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-800">
                                @foreach($notas as $nota)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150">
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        {{ $nota->estudiante->nombre }} {{ $nota->estudiante->apellido }}
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ $nota->estudiante->grado }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">{{ $nota->asignatura }}</td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full 
                                            {{ $nota->calificacion >= 14 ? 'bg-green-100 text-green-800' : 
                                              ($nota->calificacion >= 11 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                            {{ $nota->calificacion }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">{{ $nota->periodo }}</td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">{{ $nota->fecha_evaluacion->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        <div class="flex justify-center space-x-2">
                                            <a href="{{ route('academico.notas.edit', $nota) }}" 
                                               class="bg-blue-500 hover:bg-blue-700 text-white px-3 py-1 rounded-lg transition duration-300">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                            <form action="{{ route('academico.notas.destroy', $nota) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="bg-red-500 hover:bg-red-700 text-white px-3