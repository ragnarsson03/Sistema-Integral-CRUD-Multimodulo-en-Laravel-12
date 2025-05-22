<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('css/academico.css') }}">
        <h2 class="font-semibold text-xl text-center text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestión de Estudiantes') }}
        </h2>
    </x-slot>

    <div class="academic-background py-12">
        <div class="academic-container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Mensaje de éxito -->
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Encabezado académico -->
            <div class="academic-header">
                <h1 class="text-2xl font-bold">Sistema de Gestión Académica</h1>
                <p class="mt-2">Administración de estudiantes y seguimiento académico</p>
            </div>

            <!-- Botones de Acción Principal -->
            <div class="mb-8 flex justify-center space-x-6">
                <a href="{{ route('academico.estudiantes.create') }}" class="academic-button academic-button-primary">
                    <i class="fas fa-plus-circle mr-2"></i>Nuevo Estudiante
                </a>
                <a href="{{ route('academico.asistencias.index') }}" class="academic-button academic-button-success">
                    <i class="fas fa-clipboard-check mr-2"></i>Control de Asistencia
                </a>
                <a href="{{ route('academico.notas.index') }}" class="academic-button academic-button-purple">
                    <i class="fas fa-graduation-cap mr-2"></i>Registro de Notas
                </a>
            </div>

            <!-- Sistema de Filtrado Mejorado -->
            <div class="filtros-container">
                <h3 class="filtros-titulo">Filtros de Búsqueda</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Búsqueda por Nombre/Apellido -->
                    <div>
                        <label for="searchText" class="filtro-etiqueta">
                            <i class="fas fa-search mr-2"></i>Buscar por Nombre o Apellido
                        </label>
                        <input type="text" id="searchText" class="filtro-campo" placeholder="Ingrese nombre o apellido...">
                    </div>

                    <!-- Filtro por Grado -->
                    <div>
                        <label for="filterGrado" class="filtro-etiqueta">
                            <i class="fas fa-graduation-cap mr-2"></i>Filtrar por Grado
                        </label>
                        <select id="filterGrado" class="filtro-select">
                            <option value="">Todos los grados</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}">Grado {{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <!-- Filtro por Cédula -->
                    <div>
                        <label for="filterCedula" class="filtro-etiqueta">
                            <i class="fas fa-id-card mr-2"></i>Buscar por Cédula
                        </label>
                        <input type="text" id="filterCedula" class="filtro-campo" placeholder="Ingrese número de cédula...">
                    </div>
                </div>
                
                <div class="flex justify-center mt-6">
                    <button id="limpiarFiltros" class="filtro-boton-limpiar">
                        <i class="fas fa-eraser mr-2"></i>Limpiar Filtros
                    </button>
                </div>
            </div>
            
            <!-- Contador de resultados -->
            <div id="contadorResultados" class="contador-resultados">
                Mostrando todos los estudiantes
            </div>

            <!-- Tabla de Estudiantes con ID 'estudiantesTable' -->
            <div class="overflow-x-auto">
                <table class="academic-table" id="estudiantesTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Cédula</th>
                            <th>Grado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($estudiantes as $estudiante)
                        <tr class="fila-estudiante">
                            <td>{{ $estudiante->id }}</td>
                            <td>{{ $estudiante->nombre }}</td>
                            <td>{{ $estudiante->apellido }}</td>
                            <td>{{ $estudiante->cedula }}</td>
                            <td>
                                <span class="academic-badge">
                                    {{ $estudiante->grado }}
                                </span>
                            </td>
                            <td>
                                <div class="academic-action-buttons">
                                    <a href="{{ route('academico.estudiantes.show', $estudiante) }}" 
                                       class="academic-action-button bg-green-500 hover:bg-green-700 text-white">
                                        <i class="fas fa-eye"></i> Ver
                                    </a>
                                    <a href="{{ route('academico.estudiantes.index', $estudiante) }}" 
                                       class="academic-action-button bg-yellow-500 hover:bg-yellow-700 text-white">
                                        <i class="fas fa-clipboard-check"></i> Asistencia
                                    </a>
                                    <a href="{{ route('academico.notas.estudiante', $estudiante) }}" 
                                       class="academic-action-button bg-purple-500 hover:bg-purple-700 text-white">
                                        <i class="fas fa-graduation-cap"></i> Notas
                                    </a>
                                    <a href="{{ route('academico.estudiantes.edit', $estudiante) }}" 
                                       class="academic-action-button bg-blue-500 hover:bg-blue-700 text-white">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <form action="{{ route('academico.estudiantes.destroy', $estudiante) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="academic-action-button bg-red-500 hover:bg-red-700 text-white"
                                                onclick="return confirm('¿Estás seguro de eliminar este estudiante?')">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Script mejorado para el sistema de filtrado -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchText = document.getElementById('searchText');
            const filterGrado = document.getElementById('filterGrado');
            const filterCedula = document.getElementById('filterCedula');
            const limpiarFiltros = document.getElementById('limpiarFiltros');
            const contadorResultados = document.getElementById('contadorResultados');
            const filas = document.querySelectorAll('.fila-estudiante');
            
            // Función para aplicar filtros
            function aplicarFiltros() {
                const textValue = searchText.value.toLowerCase().trim();
                const gradoValue = filterGrado.value;
                const cedulaValue = filterCedula.value.toLowerCase().trim();
                
                let contadorVisible = 0;
                
                filas.forEach(fila => {
                    const nombre = fila.cells[1].textContent.toLowerCase();
                    const apellido = fila.cells[2].textContent.toLowerCase();
                    const cedula = fila.cells[3].textContent.toLowerCase();
                    const gradoElement = fila.cells[4].querySelector('.academic-badge');
                    const grado = gradoElement ? gradoElement.textContent.trim() : '';
                    
                    const matchesText = textValue === '' || 
                                      nombre.includes(textValue) || 
                                      apellido.includes(textValue);
                                      
                    const matchesGrado = gradoValue === '' || grado === gradoValue;
                    
                    const matchesCedula = cedulaValue === '' || 
                                        cedula.includes(cedulaValue);
                    
                    const visible = matchesText && matchesGrado && matchesCedula;
                    
                    if (visible) {
                        fila.classList.remove('fila-filtrada');
                        fila.classList.add('fila-visible');
                        contadorVisible++;
                    } else {
                        fila.classList.add('fila-filtrada');
                        fila.classList.remove('fila-visible');
                    }
                });
                
                // Actualizar contador de resultados
                if (contadorVisible === filas.length) {
                    contadorResultados.textContent = `Mostrando todos los estudiantes (${contadorVisible})`;
                } else {
                    contadorResultados.textContent = `Mostrando ${contadorVisible} de ${filas.length} estudiantes`;
                }
                
                // Destacar filtros activos
                searchText.style.borderColor = textValue ? '#60a5fa' : '#3b82f6';
                filterGrado.style.borderColor = gradoValue ? '#60a5fa' : '#3b82f6';
                filterCedula.style.borderColor = cedulaValue ? '#60a5fa' : '#3b82f6';
            }
            
            // Función para limpiar filtros
            function limpiarTodosFiltros() {
                searchText.value = '';
                filterGrado.value = '';
                filterCedula.value = '';
                
                // Restablecer estilos
                searchText.style.borderColor = '#3b82f6';
                filterGrado.style.borderColor = '#3b82f6';
                filterCedula.style.borderColor = '#3b82f6';
                
                aplicarFiltros();
            }
            
            // Eventos para los filtros
            searchText.addEventListener('input', aplicarFiltros);
            filterGrado.addEventListener('change', aplicarFiltros);
            filterCedula.addEventListener('input', aplicarFiltros);
            limpiarFiltros.addEventListener('click', limpiarTodosFiltros);
            
            // Inicializar
            aplicarFiltros();
        });
    </script>
</x-app-layout>