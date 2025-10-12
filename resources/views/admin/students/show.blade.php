<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalles del Estudiante') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Cabecera con botones de acción -->
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                {{ $estudiante->full_name }}
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                Matrícula: {{ $estudiante->matricula ?? 'N/A' }}
                            </p>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('estudiante.edit', $estudiante) }}"
                                class="inline-flex items-center px-3 py-2 text-xs font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-md transition-colors">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                                Editar
                            </a>
                            <a href="{{ route('estudiante.index') }}"
                                class="inline-flex items-center px-3 py-2 text-xs font-medium text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-md transition-colors">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Volver
                            </a>
                        </div>
                    </div>

                    <!-- Información Básica -->
                    <div class="mb-6">
                        <h4
                            class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 border-b border-gray-200 dark:border-gray-700 pb-2">
                            Información Básica
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Matrícula</p>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                    {{ $estudiante->matricula ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Grado</p>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                    {{ $estudiante->grado ?? 'N/A' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Grupo</p>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $estudiante->grupo }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Fnom</p>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                    {{ $estudiante->Fnom ?? 'N/A' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Datos Personales -->
                    <div class="mb-6">
                        <h4
                            class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 border-b border-gray-200 dark:border-gray-700 pb-2">
                            Datos Personales
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Nombres</p>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                    {{ $estudiante->nombres ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Apellido Paterno</p>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                    {{ $estudiante->apa ?? 'N/A' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Apellido Materno</p>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                    {{ $estudiante->ama ?? 'N/A' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Fecha de Nacimiento</p>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                    {{ $estudiante->fnac ? $estudiante->fnac->format('d/m/Y') : 'N/A' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">CURP</p>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                    {{ $estudiante->curp ?? 'N/A' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Sexo</p>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                    {{ $estudiante->sexo == 'F' ? 'Femenino' : 'Masculino' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Datos de Contacto -->
                    <div class="mb-6">
                        <h4
                            class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 border-b border-gray-200 dark:border-gray-700 pb-2">
                            Datos de Contacto
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</p>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                    {{ $estudiante->email ?? 'N/A' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Teléfono</p>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                    {{ $estudiante->telefono ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Estado y Observaciones -->
                    <div class="mb-6">
                        <h4
                            class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 border-b border-gray-200 dark:border-gray-700 pb-2">
                            Estado y Observaciones
                        </h4>
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Estatus</p>
                            <div class="mt-1">
                                @php
                                    $estatusColors = [
                                        'activo' =>
                                            'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
                                        'inactivo' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-400',
                                        'egresado' =>
                                            'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
                                        'baja' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400',
                                    ];
                                @endphp
                                <span
                                    class="inline-flex px-3 py-1 rounded-full text-xs font-medium {{ $estatusColors[$estudiante->estatus] ?? $estatusColors['inactivo'] }}">
                                    {{ ucfirst($estudiante->estatus) }}
                                </span>
                            </div>
                        </div>
                        @if ($estudiante->observaciones)
                            <div class="mt-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Observaciones</p>
                                <p
                                    class="mt-1 text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-900 p-3 rounded-md">
                                    {{ $estudiante->observaciones }}
                                </p>
                            </div>
                        @endif
                    </div>

                    <!-- Información de Registro -->
                    <div class="mb-6">
                        <h4
                            class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 border-b border-gray-200 dark:border-gray-700 pb-2">
                            Información de Registro
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Fecha de Creación</p>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                    {{ $estudiante->created_at ? $estudiante->created_at->format('d/m/Y H:i:s') : 'N/A' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Última Actualización</p>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                    {{ $estudiante->updated_at ? $estudiante->updated_at->format('d/m/Y H:i:s') : 'N/A' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Botón de eliminar -->
                    <div class="flex justify-end mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <form action="{{ route('estudiante.destroy', $estudiante) }}" method="POST"
                            onsubmit="return confirm('¿Estás seguro de eliminar este estudiante? Esta acción no se puede deshacer.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 text-xs font-medium text-white bg-red-600 hover:bg-red-700 rounded-md transition-colors">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                                Eliminar Estudiante
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
