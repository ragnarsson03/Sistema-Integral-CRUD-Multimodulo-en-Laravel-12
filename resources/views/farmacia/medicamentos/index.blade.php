@extends('layouts.adminlte')

@section('title', 'Inventario de Medicamentos')

@section('content')
    <!-- Botones de Acción Principal -->
    <div class="mb-3">
        <div class="d-flex justify-content-center">
            <a href="{{ route('farmacia.medicamentos.create') }}" class="btn btn-success mx-2">
                <i class="fas fa-plus-circle mr-2"></i>Nuevo Medicamento
            </a>
            <a href="{{ route('farmacia.movimientos.entrada.create') }}" class="btn btn-primary mx-2">
                <i class="fas fa-arrow-circle-down mr-2"></i>Registrar Entrada
            </a>
            <a href="{{ route('farmacia.movimientos.salida.create') }}" class="btn btn-purple mx-2">
                <i class="fas fa-arrow-circle-up mr-2"></i>Registrar Salida
            </a>
        </div>
    </div>

    <!-- Tabla de Inventario -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Almacén Actual</h3>
        </div>
        <div class="card-body">
            <!-- Filtros de búsqueda -->
            <div class="row mb-3">
                <div class="col-md-4 offset-md-2">
                    <input type="text" placeholder="Buscar por nombre..." class="form-control">
                </div>
                <div class="col-md-4">
                    <select class="form-control">
                        <option value="">Todas las categorías</option>
                        <option value="analgesico">Analgésico</option>
                        <option value="antibiotico">Antibiótico</option>
                        <option value="antialergico">Antialérgico</option>
                        <option value="antiinflamatorio">Antiinflamatorio</option>
                        <option value="antidepresivo">Antidepresivo</option>
                        <option value="vitamina">Vitamina</option>
                    </select>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Código</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Categoría</th>
                            <th class="text-center">Stock</th>
                            <th class="text-center">Precio</th>
                            <th class="text-center">Vencimiento</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($medicamentos as $medicamento)
                            <tr>
                                <td class="text-center">{{ $medicamento->codigo }}</td>
                                <td>{{ $medicamento->nombre }}</td>
                                <td class="text-center">{{ ucfirst($medicamento->categoria) }}</td>
                                <td class="text-center">
                                    @if($medicamento->stock <= 5)
                                        <span class="badge badge-danger">{{ $medicamento->stock }}</span>
                                    @elseif($medicamento->stock <= 10)
                                        <span class="badge badge-warning">{{ $medicamento->stock }}</span>
                                    @else
                                        <span class="badge badge-success">{{ $medicamento->stock }}</span>
                                    @endif
                                </td>
                                <td class="text-center">${{ number_format($medicamento->precio, 2) }}</td>
                                <td class="text-center">{{ $medicamento->fecha_vencimiento }}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ route('farmacia.medicamentos.show', $medicamento) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('farmacia.medicamentos.edit', $medicamento) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('farmacia.medicamentos.destroy', $medicamento) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro de eliminar este medicamento?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No hay medicamentos registrados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection