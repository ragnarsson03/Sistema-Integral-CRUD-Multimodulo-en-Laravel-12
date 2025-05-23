<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Control de Asistencia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Mensaje de éxito -->
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Selector de fecha mejorado con mejor visibilidad -->
            <div class="mb-6 flex justify-center">
                <form action="{{ route('academico.asistencias.index') }}" method="GET" class="flex space-x-4">
                    <div style="display: flex; align-items: center; background-color: #1e293b; border: 2px solid #3b82f6; border-radius: 8px; padding: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);">
                        <!-- Icono de calendario blanco -->
                        <div style="margin-right: 8px; color: white; font-size: 20px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="white" stroke="white" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" fill="#3b82f6"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                        </div>
                        <input type="date" 
                               name="fecha" 
                               value="{{ request('fecha', now()->format('Y-m-d')) }}" 
                               style="background-color: #1a202c; border: 1px solid #4a5568; border-radius: 6px; color: white; padding: 8px; width: 200px; font-size: 16px;">
                        <button type="submit" 
                                style="background-color: #3182ce; border: none; border-radius: 6px; color: white; cursor: pointer; font-weight: bold; margin-left: 8px; padding: 8px 16px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                            Buscar
                        </button>
                    </div>
                </form>
            </div>

            <!-- Tabla de Asistencia con diseño mejorado -->
            <div style="background-color: #1a202c; border-radius: 10px; border: 1px solid #4299e1; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3); overflow: hidden; margin-bottom: 2rem;">
                <div style="background-color: #2d3748; border-bottom: 2px solid #4299e1; padding: 1rem; text-align: center;">
                    <h3 style="color: white; font-size: 1.5rem; font-weight: bold; margin: 0;">
                        Registro de Asistencia - {{ \Carbon\Carbon::parse(request('fecha', now()))->format('d/m/Y') }}
                    </h3>
                </div>
                
                <div class="p-6">
                    <form action="{{ route('academico.asistencias.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="fecha" value="{{ request('fecha', now()->format('Y-m-d')) }}">
                        
                        <div class="overflow-x-auto">
                            <table style="width: 100%; border-collapse: separate; border-spacing: 0;">
                                <thead>
                                    <tr>
                                        <th style="background-color: #2d3748; color: #e2e8f0; font-size: 0.875rem; font-weight: 600; letter-spacing: 0.05em; padding: 0.75rem 1rem; text-align: center; text-transform: uppercase; border-bottom: 1px solid #4a5568;">ESTUDIANTE</th>
                                        <th style="background-color: #2d3748; color: #e2e8f0; font-size: 0.875rem; font-weight: 600; letter-spacing: 0.05em; padding: 0.75rem 1rem; text-align: center; text-transform: uppercase; border-bottom: 1px solid #4a5568;">GRADO</th>
                                        <th style="background-color: #2d3748; color: #e2e8f0; font-size: 0.875rem; font-weight: 600; letter-spacing: 0.05em; padding: 0.75rem 1rem; text-align: center; text-transform: uppercase; border-bottom: 1px solid #4a5568;">ESTADO</th>
                                        <th style="background-color: #2d3748; color: #e2e8f0; font-size: 0.875rem; font-weight: 600; letter-spacing: 0.05em; padding: 0.75rem 1rem; text-align: center; text-transform: uppercase; border-bottom: 1px solid #4a5568;">OBSERVACIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($estudiantes as $estudiante)
                                    <tr style="transition: background-color 0.2s;">
                                        <td style="padding: 0.75rem 1rem; text-align: center; border-bottom: 1px solid #4a5568; color: #e2e8f0;">
                                            <input type="hidden" name="estudiante_id[]" value="{{ $estudiante->id }}">
                                            {{ $estudiante->nombre }} {{ $estudiante->apellido }}
                                        </td>
                                        <td style="padding: 0.75rem 1rem; text-align: center; border-bottom: 1px solid #4a5568; color: #e2e8f0;">
                                            <span style="background-color: #2b6cb0; border-radius: 9999px; color: white; display: inline-block; font-size: 0.75rem; font-weight: 600; padding: 0.25rem 0.75rem;">
                                                {{ $estudiante->grado }}
                                            </span>
                                        </td>
                                        <td style="padding: 0.75rem 1rem; text-align: center; border-bottom: 1px solid #4a5568; color: #e2e8f0;">
                                            <!-- Selector de estado mejorado con mejor visibilidad -->
                                            <select 
                                                name="estado[{{ $estudiante->id }}]" 
                                                class="estado-select-{{ $estudiante->id }}"
                                                style="background-color: #2d3748; border: 2px solid #4299e1; border-radius: 6px; color: white; padding: 0.5rem; width: 100%; font-weight: bold; font-size: 14px; appearance: none; background-image: url('data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"white\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"6 9 12 15 18 9\"></polyline></svg>'); background-repeat: no-repeat; background-position: right 8px center; background-size: 16px 16px; padding-right: 32px;">
                                                <option value="presente" {{ $asistencias[$estudiante->id] ?? '' == 'presente' ? 'selected' : '' }} style="background-color: #22543d; color: white;">Presente</option>
                                                <option value="ausente" {{ $asistencias[$estudiante->id] ?? '' == 'ausente' ? 'selected' : '' }} style="background-color: #742a2a; color: white;">Ausente</option>
                                                <option value="tardanza" {{ $asistencias[$estudiante->id] ?? '' == 'tardanza' ? 'selected' : '' }} style="background-color: #744210; color: white;">Tardanza</option>
                                            </select>
                                        </td>
                                        <td style="padding: 0.75rem 1rem; text-align: center; border-bottom: 1px solid #4a5568; color: #e2e8f0;">
                                            <input type="text" 
                                                   name="observaciones[{{ $estudiante->id }}]" 
                                                   value="{{ $observaciones[$estudiante->id] ?? '' }}" 
                                                   style="background-color: #2d3748; border: 1px solid #4a5568; border-radius: 6px; color: white; padding: 0.5rem; width: 100%;">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div style="display: flex; justify-content: center; margin-top: 2rem;">
                            <button type="submit" 
                                    style="background-color: #38a169; border: none; border-radius: 8px; color: white; cursor: pointer; font-size: 1.125rem; font-weight: 600; padding: 0.875rem 2.5rem; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                Guardar Asistencia
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Obtener el elemento de entrada de fecha
            const fechaInput = document.querySelector('input[name="fecha"]');
            
            // Agregar un evento para detectar cambios en la fecha
            fechaInput.addEventListener('change', function() {
                // Crear un formulario temporal
                const form = document.createElement('form');
                form.method = 'GET';
                form.action = '{{ route("academico.asistencias.index") }}';
                
                // Agregar el campo de fecha al formulario
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'fecha';
                input.value = this.value;
                form.appendChild(input);
                
                // Agregar el formulario al documento y enviarlo
                document.body.appendChild(form);
                form.submit();
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializar los colores de los selects según su valor actual
            const estadoSelects = document.querySelectorAll('select[name^="estado["]');
            
            estadoSelects.forEach(select => {
                // Aplicar color inicial
                updateSelectStyle(select);
                
                // Actualizar al cambiar
                select.addEventListener('change', function() {
                    updateSelectStyle(this);
                });
            });
            
            function updateSelectStyle(select) {
                if (select.value === 'presente') {
                    select.style.backgroundColor = '#22543d';
                    select.style.borderColor = '#38a169';
                    select.style.color = 'white';
                } else if (select.value === 'ausente') {
                    select.style.backgroundColor = '#742a2a';
                    select.style.borderColor = '#e53e3e';
                    select.style.color = 'white';
                } else if (select.value === 'tardanza') {
                    select.style.backgroundColor = '#744210';
                    select.style.borderColor = '#d69e2e';
                    select.style.color = 'white';
                }
            }
        });
    </script>
</x-app-layout>