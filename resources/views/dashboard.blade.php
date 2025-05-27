<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Incluir el CSS del dashboard -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <div class="py-12 dashboard-container">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="dashboard-header">
                        <h2 class="dashboard-title">Sistema Integral CRUD Multimodular</h2>
                        <p class="dashboard-subtitle">Plataforma universitaria con proyectos, para la gestión eficiente de información en múltiples áreas académicas y administrativas!</p>
                        <p class="dashboard-subtitle">Estudiante: Frederick Durán, 30346056.</p>
                        <p class="dashboard-subtitle">Ing y Docente: Prof. Elias Vargas.</p>
                    </div>
                    
                    <div class="modules-grid">
                        <!-- Módulo Médico -->
                        <div class="module-card module-medico">
                            <div class="module-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <h3 class="module-title">Módulo Médico</h3>
                            <p class="module-description">Gestión de pacientes, historias clínicas y control de citas médicas. Seguimiento completo del historial médico de cada paciente.</p>
                            <a href="{{ route('medico.pacientes.index') }}" class="module-action">
                                Gestionar Pacientes
                            </a>
                        </div>
                        
                        <!-- Módulo Farmacia -->
                        <div class="module-card module-farmacia">
                            <div class="module-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <h3 class="module-title">Módulo Farmacia</h3>
                            <p class="module-description">Inventario de medicinas, control de entradas, salidas y stock general. Gestión eficiente de medicamentos y suministros.</p>
                            <a href="{{ route('farmacia.medicamentos.index') }}" class="module-action">
                                Gestionar Medicamentos
                            </a>
                        </div>
                        
                        <!-- Módulo Académico -->
                        <div class="module-card module-academico">
                            <div class="module-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <h3 class="module-title">Módulo Académico</h3>
                            <p class="module-description">Control de asistencia y calificaciones de los alumnos. Seguimiento del rendimiento académico y gestión de evaluaciones.</p>
                            <a href="{{ route('academico.estudiantes.index') }}" class="module-action">
                                Gestionar Estudiantes
                            </a>
                        </div>
                        
                        <!-- Módulo Biblioteca -->
                        <div class="module-card module-biblioteca">
                            <div class="module-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                                </svg>
                            </div>
                            <h3 class="module-title">Módulo Biblioteca</h3>
                            <p class="module-description">Registro de libros, préstamos, devoluciones y control de existencias. Gestión completa del inventario bibliográfico.</p>
                            <a href="{{ route('biblioteca.libros.index') }}" class="module-action">
                                Gestionar Libros
                            </a>
                        </div>
                        
                        <!-- Módulo Comedor -->
                        <div class="module-card module-comedor">
                            <div class="module-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <h3 class="module-title">Módulo Comedor</h3>
                            <p class="module-description">Gestión de saldo en tarjetas de los estudiantes, historial de consumos y control de abonos. Sistema de pagos integrado.</p>
                            <a href="{{ route('comedor.tarjetas.index') }}" class="module-action">
                                Gestionar Tarjetas
                            </a>
                        </div>
                        
                        <!-- Administración -->
                        <div class="module-card module-admin">
                            <div class="module-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <h3 class="module-title">Administración</h3>
                            <p class="module-description">Gestión de usuarios, roles y configuración del sistema. Control de accesos y permisos para cada módulo.</p>
                            <a href="{{ route('usuarios.index') }}" class="module-action">
                                Gestionar Usuarios
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
