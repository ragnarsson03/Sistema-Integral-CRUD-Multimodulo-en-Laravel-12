@extends('layouts.adminlte')

@section('title', 'Gestión de Estudiantes')

@section('content')
    <!-- Incluir el navbar específico de estudiantes como parte del contenido -->
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">Navegación de Estudiantes</h3>
            </div>
        </div>
        <div class="card-body">
            <div class="btn-group">
                <a href="{{ route('academico.estudiantes.index') }}" class="btn btn-primary {{ request()->routeIs('academico.estudiantes.index') ? 'active' : '' }}">
                    <i class="fas fa-list mr-1"></i> Listado de Estudiantes
                </a>
                <a href="{{ route('academico.estudiantes.create') }}" class="btn btn-success {{ request()->routeIs('academico.estudiantes.create') ? 'active' : '' }}">
                    <i class="fas fa-plus-circle mr-1"></i> Nuevo Estudiante
                </a>
                <a href="{{ route('academico.asistencias.index') }}" class="btn btn-info {{ request()->routeIs('academico.asistencias.index') ? 'active' : '' }}">
                    <i class="fas fa-check-circle mr-1"></i> Asistencias
                </a>
                <a href="{{ route('academico.notas.index') }}" class="btn btn-warning {{ request()->routeIs('academico.notas.index') ? 'active' : '' }}">
                    <i class="fas fa-graduation-cap mr-1"></i> Notas
                </a>
            </div>
        </div>
    </div>

    <!-- Mensaje de éxito -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> ¡Éxito!</h5>
            {{ session('success') }}
        </div>
    @endif

    <!-- Encabezado académico -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Sistema de Gestión Académica</h3>
        </div>
        <div class="card-body">
            <p>Administración de estudiantes y seguimiento académico</p>
        </div>
    </div>

    <!-- Sistema de Filtrado Mejorado -->
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Filtros de Búsqueda</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Búsqueda por Nombre/Apellido -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="searchText">
                            <i class="fas fa-search mr-2"></i>Buscar por Nombre o Apellido
                        </label>
                        <input type="text" id="searchText" class="form-control" placeholder="Ingrese nombre o apellido...">
                    </div>
                </div>

                <!-- Filtro por Grado -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="filterGrado">
                            <i class="fas fa-graduation-cap mr-2"></i>Filtrar por Grado
                        </label>
                        <select id="filterGrado" class="form-control">
                            <option value="">Todos los grados</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}">Grado {{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <!-- Filtro por Cédula -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="filterCedula">
                            <i class="fas fa-id-card mr-2"></i>Buscar por Cédula
                        </label>
                        <input type="text" id="filterCedula" class="form-control" placeholder="Ingrese número de cédula...">
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-3">
                <button id="limpiarFiltros" class="btn btn-default">
                    <i class="fas fa-eraser mr-2"></i>Limpiar Filtros
                </button>
            </div>
        </div>
    </div>
    
    <!-- Contador de resultados -->
    <div id="contadorResultados" class="callout callout-info">
        <h5><i class="fas fa-info"></i> Resultados:</h5>
        <p>Mostrando todos los estudiantes</p>
    </div>

    <!-- Tabla de Estudiantes -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Listado de Estudiantes</h3>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap" id="estudiantesTable">
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
                            <span class="badge bg-primary">
                                {{ $estudiante->grado }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('academico.estudiantes.show', $estudiante) }}" 
                                   class="btn btn-sm btn-success">
                                    <i class="fas fa-eye"></i> Ver
                                </a>
                                <a href="{{ route('academico.estudiantes.index', $estudiante) }}" 
                                   class="btn btn-sm btn-warning">
                                    <i class="fas fa-clipboard-check"></i> Asistencia
                                </a>
                                <a href="{{ route('academico.notas.estudiante', $estudiante) }}" 
                                   class="btn btn-sm btn-info">
                                    <i class="fas fa-graduation-cap"></i> Notas
                                </a>
                                <a href="{{ route('academico.estudiantes.edit', $estudiante) }}" 
                                   class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <form action="{{ route('academico.estudiantes.destroy', $estudiante) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-sm btn-danger"
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

    <!-- Script mejorado para el sistema de filtrado -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchText = document.getElementById('searchText');
            const filterGrado = document.getElementById('filterGrado');
            const filterCedula = document.getElementById('filterCedula');
            const limpiarFiltros = document.getElementById('limpiarFiltros');
            const contadorResultados = document.getElementById('contadorResultados').querySelector('p');
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
                    const gradoElement = fila.cells[4].querySelector('.badge');
                    const grado = gradoElement ? gradoElement.textContent.trim() : '';
                    
                    const matchesText = textValue === '' || 
                                      nombre.includes(textValue) || 
                                      apellido.includes(textValue);
                                      
                    const matchesGrado = gradoValue === '' || grado === gradoValue;
                    
                    const matchesCedula = cedulaValue === '' || 
                                        cedula.includes(cedulaValue);
                    
                    const visible = matchesText && matchesGrado && matchesCedula;
                    
                    if (visible) {
                        fila.style.display = '';
                        contadorVisible++;
                    } else {
                        fila.style.display = 'none';
                    }
                });
                
                // Actualizar contador de resultados
                if (contadorVisible === filas.length) {
                    contadorResultados.textContent = `Mostrando todos los estudiantes (${contadorVisible})`;
                } else {
                    contadorResultados.textContent = `Mostrando ${contadorVisible} de ${filas.length} estudiantes`;
                }
            }
            
            // Función para limpiar filtros
            function limpiarTodosFiltros() {
                searchText.value = '';
                filterGrado.value = '';
                filterCedula.value = '';
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
@endsection