@extends('layouts.adminlte')

@section('title', 'Gestión de Libros')

@section('content')
    <!-- CSS específico de biblioteca -->
    <link rel="stylesheet" href="{{ asset('css/biblioteca.css') }}">

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">Listado de Libros</h3>
                <a href="{{ route('biblioteca.libros.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle mr-1"></i> Agregar Nuevo Libro
                </a>
            </div>
        </div>
        <div class="card-body">
            <!-- Formulario de búsqueda -->
            <form action="{{ route('biblioteca.libros.index') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Buscar por título, autor, editorial o ISBN..." 
                        class="form-control"
                        value="{{ request('search') }}"
                    >
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                        @if(request('search'))
                            <a href="{{ route('biblioteca.libros.index') }}" class="btn btn-default">Limpiar</a>
                        @endif
                    </div>
                </div>
            </form>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> ¡Éxito!</h5>
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Editorial</th>
                            <th>ISBN</th>
                            <th>Año</th>
                            <th>Disponibles</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($libros as $libro)
                            <tr>
                                <td>{{ $libro->titulo }}</td>
                                <td>{{ $libro->autor }}</td>
                                <td>{{ $libro->editorial }}</td>
                                <td>{{ $libro->isbn }}</td>
                                <td>{{ $libro->anio_publicacion }}</td>
                                <td>
                                    @if($libro->cantidad_disponible <= 0)
                                        <span class="badge badge-danger">Agotado</span>
                                    @elseif($libro->cantidad_disponible < 3)
                                        <span class="badge badge-warning">{{ $libro->cantidad_disponible }}</span>
                                    @else
                                        <span class="badge badge-success">{{ $libro->cantidad_disponible }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('biblioteca.libros.show', $libro) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> Ver
                                        </a>
                                        <a href="{{ route('biblioteca.libros.edit', $libro) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                        <form action="{{ route('biblioteca.libros.destroy', $libro) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro de eliminar este libro?')">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No hay libros registrados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection