@extends('layouts.adminlte')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Sistema Integral CRUD Multimodular</h3>
            </div>
            <div class="card-body">
                <p class="mb-3">Plataforma universitaria con proyectos, para la gestión eficiente de información en múltiples áreas académicas y administrativas!</p>
                <p class="mb-3">Estudiante: Frederick Durán, 30346056.</p>
                <p class="mb-3">Ing y Docente: Prof. Elias Vargas.</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Módulo Médico -->
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card bg-gradient-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-md mr-2"></i> Módulo Médico</h3>
            </div>
            <div class="card-body">
                <p>Gestión de pacientes, historias clínicas y control de citas médicas. Seguimiento completo del historial médico de cada paciente.</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('medico.pacientes.index') }}" class="btn btn-outline-light btn-block">Gestionar Pacientes</a>
            </div>
        </div>
    </div>
    
    <!-- Módulo Farmacia -->
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card bg-gradient-success">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-pills mr-2"></i> Módulo Farmacia</h3>
            </div>
            <div class="card-body">
                <p>Inventario de medicinas, control de entradas, salidas y stock general. Gestión eficiente de medicamentos y suministros.</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('farmacia.medicamentos.index') }}" class="btn btn-outline-light btn-block">Gestionar Medicamentos</a>
            </div>
        </div>
    </div>
    
    <!-- Módulo Biblioteca -->
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card bg-gradient-warning">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-book mr-2"></i> Módulo Biblioteca</h3>
            </div>
            <div class="card-body">
                <p>Gestión de libros, préstamos y devoluciones. Control completo del inventario de libros y seguimiento de préstamos.</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('biblioteca.libros.index') }}" class="btn btn-outline-light btn-block">Gestionar Libros</a>
            </div>
        </div>
    </div>
    
    <!-- Módulo Académico -->
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card bg-gradient-info">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-graduation-cap mr-2"></i> Módulo Académico</h3>
            </div>
            <div class="card-body">
                <p>Gestión de estudiantes, cursos, calificaciones y asistencias. Seguimiento académico completo de los estudiantes.</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('academico.estudiantes.index') }}" class="btn btn-outline-light btn-block">Gestionar Estudiantes</a>
            </div>
        </div>
    </div>
    
    <!-- Módulo Comedor -->
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card bg-gradient-danger">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-utensils mr-2"></i> Módulo Comedor</h3>
            </div>
            <div class="card-body">
                <p>Gestión de tarjetas de comedor, transacciones y control de acceso. Administración eficiente del servicio de comedor.</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('comedor.tarjetas.index') }}" class="btn btn-outline-light btn-block">Gestionar Tarjetas</a>
            </div>
        </div>
    </div>
    
    <!-- Módulo Administración de Usuarios -->
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card bg-gradient-secondary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-users-cog mr-2"></i> Gestión de Usuarios</h3>
            </div>
            <div class="card-body">
                <p>Administración de usuarios, roles y permisos. Control completo de acceso al sistema y gestión de cuentas.</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('usuarios.index') }}" class="btn btn-outline-light btn-block">Gestionar Usuarios</a>
            </div>
        </div>
    </div>
</div>
@endsection