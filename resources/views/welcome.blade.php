<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Sistema Integral CRUD') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /* Estilos de respaldo si Vite no está disponible */
                body {
                    font-family: 'instrument-sans', sans-serif;
                    background-color: #f3f4f6;
                }
            </style>
        @endif
    </head>
    <body class="antialiased">
        <div class="relative min-h-screen bg-gray-100 dark:bg-gray-900">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Sistema Integral CRUD</h1>
                        </div>
                    </div>
                    <div class="flex items-center">
                        @if (Route::has('login'))
                            <div class="space-x-4">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">Iniciar Sesión</a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">Registrarse</a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <main class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h2 class="text-3xl font-bold mb-6 text-center">Sistema Integral CRUD Multimodular</h2>
                            <p class="text-lg mb-8 text-center">Plataforma universitaria para gestión de información en múltiples áreas</p>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-10">
                                <!-- Módulo Médico -->
                                <div class="bg-blue-50 dark:bg-blue-900 p-6 rounded-lg shadow-md">
                                    <h3 class="text-xl font-semibold mb-3 text-blue-700 dark:text-blue-300">Módulo Médico</h3>
                                    <p class="text-gray-700 dark:text-gray-300 mb-4">Gestión de pacientes, historias clínicas y control de citas médicas.</p>
                                    <a href="{{ route('login') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
                                        Acceder
                                    </a>
                                </div>
                                
                                <!-- Módulo Farmacia -->
                                <div class="bg-green-50 dark:bg-green-900 p-6 rounded-lg shadow-md">
                                    <h3 class="text-xl font-semibold mb-3 text-green-700 dark:text-green-300">Módulo Farmacia</h3>
                                    <p class="text-gray-700 dark:text-gray-300 mb-4">Inventario de medicinas, control de entradas, salidas y stock general.</p>
                                    <a href="{{ route('login') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded">
                                        Acceder
                                    </a>
                                </div>
                                
                                <!-- Módulo Académico -->
                                <div class="bg-purple-50 dark:bg-purple-900 p-6 rounded-lg shadow-md">
                                    <h3 class="text-xl font-semibold mb-3 text-purple-700 dark:text-purple-300">Módulo Académico</h3>
                                    <p class="text-gray-700 dark:text-gray-300 mb-4">Control de asistencia y calificaciones de los alumnos.</p>
                                    <a href="{{ route('login') }}" class="inline-block bg-purple-600 hover:bg-purple-700 text-white font-medium py-2 px-4 rounded">
                                        Acceder
                                    </a>
                                </div>
                                
                                <!-- Módulo Biblioteca -->
                                <div class="bg-yellow-50 dark:bg-yellow-900 p-6 rounded-lg shadow-md">
                                    <h3 class="text-xl font-semibold mb-3 text-yellow-700 dark:text-yellow-300">Módulo Biblioteca</h3>
                                    <p class="text-gray-700 dark:text-gray-300 mb-4">Registro de libros, préstamos, devoluciones y control de existencias.</p>
                                    <a href="{{ route('login') }}" class="inline-block bg-yellow-600 hover:bg-yellow-700 text-white font-medium py-2 px-4 rounded">
                                        Acceder
                                    </a>
                                </div>
                                
                                <!-- Módulo Comedor -->
                                <div class="bg-red-50 dark:bg-red-900 p-6 rounded-lg shadow-md">
                                    <h3 class="text-xl font-semibold mb-3 text-red-700 dark:text-red-300">Módulo Comedor</h3>
                                    <p class="text-gray-700 dark:text-gray-300 mb-4">Gestión de saldo en tarjetas de los estudiantes, historial de consumos y control de abonos.</p>
                                    <a href="{{ route('login') }}" class="inline-block bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded">
                                        Acceder
                                    </a>
                                </div>
                                
                                <!-- Administración -->
                                <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow-md">
                                    <h3 class="text-xl font-semibold mb-3 text-gray-700 dark:text-gray-300">Administración</h3>
                                    <p class="text-gray-700 dark:text-gray-300 mb-4">Gestión de usuarios, roles y configuración del sistema.</p>
                                    <a href="{{ route('login') }}" class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded">
                                        Acceder
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            
            <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center text-gray-500 dark:text-gray-400">
                        <p>© {{ date('Y') }} Sistema Integral CRUD Multimodular. Todos los derechos reservados.</p>
                        <p class="mt-2">Desarrollado como proyecto universitario</p>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>