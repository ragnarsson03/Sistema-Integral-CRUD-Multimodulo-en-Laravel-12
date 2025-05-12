<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-bold mb-6">Bienvenido al Sistema Integral CRUD</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
                        <!-- Módulo Médico -->
                        <div class="bg-blue-50 dark:bg-blue-900 p-6 rounded-lg shadow-md">
                            <h3 class="text-xl font-semibold mb-3 text-blue-700 dark:text-blue-300">Módulo Médico</h3>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">Gestión de pacientes, historias clínicas y control de citas médicas.</p>
                            <a href="{{ route('medico.pacientes.index') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
                                Gestionar Pacientes
                            </a>
                        </div>
                        
                        <!-- Módulo Farmacia -->
                        <div class="bg-green-50 dark:bg-green-900 p-6 rounded-lg shadow-md">
                            <h3 class="text-xl font-semibold mb-3 text-green-700 dark:text-green-300">Módulo Farmacia</h3>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">Inventario de medicinas, control de entradas, salidas y stock general.</p>
                            <a href="{{ route('farmacia.medicamentos.index') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded">
                                Gestionar Medicamentos
                            </a>
                        </div>
                        
                        <!-- Módulo Académico -->
                        <div class="bg-purple-50 dark:bg-purple-900 p-6 rounded-lg shadow-md">
                            <h3 class="text-xl font-semibold mb-3 text-purple-700 dark:text-purple-300">Módulo Académico</h3>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">Control de asistencia y calificaciones de los alumnos.</p>
                            <a href="{{ route('academico.estudiantes.index') }}" class="inline-block bg-purple-600 hover:bg-purple-700 text-white font-medium py-2 px-4 rounded">
                                Gestionar Estudiantes
                            </a>
                        </div>
                        
                        <!-- Módulo Biblioteca -->
                        <div class="bg-yellow-50 dark:bg-yellow-900 p-6 rounded-lg shadow-md">
                            <h3 class="text-xl font-semibold mb-3 text-yellow-700 dark:text-yellow-300">Módulo Biblioteca</h3>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">Registro de libros, préstamos, devoluciones y control de existencias.</p>
                            <a href="{{ route('biblioteca.libros.index') }}" class="inline-block bg-yellow-600 hover:bg-yellow-700 text-white font-medium py-2 px-4 rounded">
                                Gestionar Libros
                            </a>
                        </div>
                        
                        <!-- Módulo Comedor -->
                        <div class="bg-red-50 dark:bg-red-900 p-6 rounded-lg shadow-md">
                            <h3 class="text-xl font-semibold mb-3 text-red-700 dark:text-red-300">Módulo Comedor</h3>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">Gestión de saldo en tarjetas de los estudiantes, historial de consumos y control de abonos.</p>
                            <a href="{{ route('comedor.tarjetas.index') }}" class="inline-block bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded">
                                Gestionar Tarjetas
                            </a>
                        </div>
                        
                        <!-- Administración -->
                        <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow-md">
                            <h3 class="text-xl font-semibold mb-3 text-gray-700 dark:text-gray-300">Administración</h3>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">Gestión de usuarios, roles y configuración del sistema.</p>
                            <a href="{{ route('usuarios.index') }}" class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded">
                                Gestionar Usuarios
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
