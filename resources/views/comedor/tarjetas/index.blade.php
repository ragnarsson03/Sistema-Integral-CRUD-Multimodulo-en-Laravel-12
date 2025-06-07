@extends('layouts.adminlte')

@section('title', 'Gestión de Tarjetas de Comedor')

@section('content')
    <!-- CSS específico de comedor -->
    <link rel="stylesheet" href="{{ asset('css/comedor.css') }}">

    <!-- Encabezado del módulo -->
    <div class="card bg-gradient-primary mb-3">
        <div class="card-body">
            <h1 class="text-center text-white">Sistema de Tarjetas de Comedor</h1>
            <p class="text-center text-white">Gestión de tarjetas para el servicio de alimentación universitaria</p>
        </div>
    </div>
    
    <!-- Botones de Acción Principal -->
    <div class="mb-3 text-center">
        <a href="{{ route('comedor.tarjetas.create') }}" class="btn btn-success">
            <i class="fas fa-plus-circle mr-2"></i>Nueva Tarjeta
        </a>
    </div>

    <!-- Mensajes de éxito -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> ¡Éxito!</h5>
            {{ session('success') }}
        </div>
    @endif

    <!-- Mensajes de advertencia -->
    @if(session('warning'))
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-exclamation-triangle"></i> ¡Advertencia!</h5>
            {{ session('warning') }}
        </div>
    @endif

    <!-- Alerta cuando no hay estudiantes -->
    @if(isset($hayEstudiantes) && !$hayEstudiantes)
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-info"></i> Información</h5>
            <p><strong>Atención:</strong> Necesitas registrar estudiantes en el sistema académico para poder utilizar el sistema de comedor. Por favor, registra estudiantes antes de crear tarjetas.</p>
        </div>
    @endif

    <!-- Tabla de Tarjetas -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tarjetas Registradas</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Estudiante</th>
                            <th>Saldo</th>
                            <th>Estado</th>
                            <th>Fecha Creación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tarjetas as $tarjeta)
                            <tr>
                                <td>{{ $tarjeta->codigo }}</td>
                                <td>{{ $tarjeta->estudiante->nombre }} {{ $tarjeta->estudiante->apellido }}</td>
                                <td>
                                    @if($tarjeta->saldo <= 5)
                                        <span class="badge badge-danger">${{ number_format($tarjeta->saldo, 2) }}</span>
                                    @elseif($tarjeta->saldo <= 15)
                                        <span class="badge badge-warning">${{ number_format($tarjeta->saldo, 2) }}</span>
                                    @else
                                        <span class="badge badge-success">${{ number_format($tarjeta->saldo, 2) }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($tarjeta->activa)
                                        <span class="badge badge-success">Activa</span>
                                    @else
                                        <span class="badge badge-danger">Inactiva</span>
                                    @endif
                                </td>
                                <td>{{ $tarjeta->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('comedor.tarjetas.show', $tarjeta) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> Ver
                                        </a>
                                        <a href="{{ route('comedor.tarjetas.edit', $tarjeta) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                        <form action="{{ route('comedor.tarjetas.destroy', $tarjeta) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro de eliminar esta tarjeta?')">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No hay tarjetas registradas</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection