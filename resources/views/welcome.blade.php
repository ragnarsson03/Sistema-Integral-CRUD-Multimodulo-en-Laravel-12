<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Sistema Integral CRUD - UNETI') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Estilo del navbar (Barrita de Navegación) y -->
        <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
        <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
    </head>
    <body>
        <!-- Incluir el navbar compartido -->
        <x-navbar />
        
        <div class="container">
            <div class="hero">
                <h1 class="hero-title">Sistema Integral CRUD Multimodular</h1>
                <p class="hero-subtitle">Plataforma universitaria para gestión de información en múltiples áreas</p>
                
                <div class="university-info">
                    <h3 class="university-title">Universidad Nacional Experimental de las Telecomunicaciones e Informática (UNETI)</h3>
                    <p>Institución de educación superior ubicada en Caracas, Venezuela, especializada en la formación de profesionales en el área de tecnología e informática.</p>
                </div>
                
                <div class="modules">
                    <div class="module-card">
                        <div class="module-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#3182ce" width="30" height="30">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h3 class="module-title">Módulo Médico</h3>
                        <p>Control de historias clínicas de pacientes, seguimiento de consultas y gestión de tratamientos.</p>
                    </div>
                    
                    <div class="module-card">
                        <div class="module-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#3182ce" width="30" height="30">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <h3 class="module-title">Módulo Farmacia</h3>
                        <p>Inventario completo de medicamentos con control de entradas, salidas y existencias en almacén.</p>
                    </div>
                    
                    <div class="module-card">
                        <div class="module-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#3182ce" width="30" height="30">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h3 class="module-title">Módulo Académico</h3>
                        <p>Control de asistencia y registro de notas de alumnos para seguimiento del rendimiento académico.</p>
                    </div>
                    
                    <div class="module-card">
                        <div class="module-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#3182ce" width="30" height="30">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                            </svg>
                        </div>
                        <h3 class="module-title">Módulo Biblioteca</h3>
                        <p>Control de entrada, salida y existencia de libros para una gestión eficiente del inventario bibliográfico.</p>
                    </div>
                    
                    <div class="module-card">
                        <div class="module-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#3182ce" width="30" height="30">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="module-title">Módulo Comedor</h3>
                        <p>Control de almuerzos de estudiantes con sistema de tarjetas recargables para pagos y gestión de saldo.</p>
                    </div>
                </div>
                
                <a href="{{ route('login') }}" class="cta-button">
                    Iniciar sesión para acceder al sistema
                </a>
            </div>
            
            <div class="footer">
                <p>Sistema Integral CRUD Multimodular - Universidad UNETI</p>
                <p>Desarrollado por Frederick Durán, como proyecto universitario para la evaluación de sistemas CRUD Sesión Didáctica 1</p>
                <p>Docente: Elias Vargas</p>
            </div>
        </div>
    </body>
</html>