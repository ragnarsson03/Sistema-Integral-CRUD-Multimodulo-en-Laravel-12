
@extends('layouts.adminlte')

@section('title', 'Gestión de Usuarios')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">Listado de Usuarios</h3>
                <a href="{{ route('usuarios.create') }}" class="btn btn-primary">
                    <i class="fas fa-user-plus mr-1"></i> Agregar Nuevo Usuario
                </a>
            </div>
        </div>
        <div class="card-body">
            <!-- Formulario de búsqueda -->
            <form action="{{ route('usuarios.index') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Buscar por nombre o email..." 
                        class="form-control"
                        value="{{ request('search') }}"
                    >
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i> Buscar
                        </button>
                        @if(request('search'))
                            <a href="{{ route('usuarios.index') }}" class="btn btn-default">
                                <i class="fas fa-times"></i> Limpiar
                            </a>
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
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Fecha Creación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->id }}</td>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>
                                    @foreach($usuario->roles as $role)
                                        <span class="badge badge-primary">
                                            {{ $role->name }}
                                        </span>
                                    @endforeach
                                </td>
                                <td>{{ $usuario->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('usuarios.show', $usuario) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> Ver
                                        </a>
                                        <a href="{{ route('usuarios.edit', $usuario) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                        <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">
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
@endsection