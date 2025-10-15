<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalle del Reporte') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Mensajes de éxito/error -->
            @if (session('success'))
                <div
                    class="mb-4 px-4 py-3 rounded-md bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800">
                    <p class="text-sm text-green-800 dark:text-green-200">{{ session('success') }}</p>
                </div>
            @endif

            @if (session('error'))
                <div
                    class="mb-4 px-4 py-3 rounded-md bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800">
                    <p class="text-sm text-red-800 dark:text-red-200">{{ session('error') }}</p>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Header con acciones -->
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                Reporte #{{ $reporte->id }}
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Creado el
                                {{ $reporte->created_at ? $reporte->created_at->format('d/m/Y H:i:s') : 'Fecha no disponible' }}
                            </p>
                        </div>
                        <div class="flex space-x-2">
                            @if ($reporte->estado === 'pendiente')
                                <a href="{{ route('reportes.edit', $reporte) }}"
                                    class="inline-flex items-center px-3 py-2 text-xs font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-md transition-colors">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                    Editar
                                </a>
                            @endif

                            @if ($reporte->puedeFirmarPrefecto() && auth()->user()->esPrefecto())
                                <form action="{{ route('reportes.firmar-prefecto', $reporte) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="inline-flex items-center px-3 py-2 text-xs font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md transition-colors"
                                        onclick="return confirm('¿Confirmas firmar este reporte como prefecto?');">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Firmar como Prefecto
                                    </button>
                                </form>
                            @endif

                            @if ($reporte->puedeFirmarTrabajoSocial() && auth()->user()->esTrabajadorSocial())
                                <form action="{{ route('reportes.firmar-trabajador-social', $reporte) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="inline-flex items-center px-3 py-2 text-xs font-medium text-white bg-purple-600 hover:bg-purple-700 rounded-md transition-colors"
                                        onclick="return confirm('¿Confirmas firmar este reporte como trabajador social?');">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Firmar como Trabajo Social
                                    </button>
                                </form>
                            @endif

                            <a href="{{ route('reportes.pdf', $reporte) }}" target="_blank"
                                class="inline-flex items-center px-3 py-2 text-xs font-medium text-white bg-green-600 hover:bg-green-700 rounded-md transition-colors">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                Generar PDF
                            </a>
                        </div>
                    </div>

                    <!-- Estado del reporte -->
                    <div class="mb-6">
                        @php
                            $estadoColors = [
                                'pendiente' =>
                                    'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400',
                                'no firmado' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
                                'atendido' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
                            ];
                        @endphp
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $estadoColors[$reporte->estado] ?? 'bg-gray-100 text-gray-800' }}">
                            Estado: {{ ucfirst(str_replace('_', ' ', $reporte->estado)) }}
                        </span>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Información del Estudiante -->
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
                            <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                                {{ __('Información del Estudiante') }}
                            </h4>
                            <dl class="space-y-3">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nombre Completo
                                    </dt>
                                    <dd class="text-sm text-gray-900 dark:text-gray-100">
                                        {{ $reporte->student->full_name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Grado y Grupo</dt>
                                    <dd class="text-sm text-gray-900 dark:text-gray-100">
                                        {{ $reporte->student->grado }}° {{ $reporte->student->grupo }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Matrícula</dt>
                                    <dd class="text-sm text-gray-900 dark:text-gray-100">
                                        {{ $reporte->student->matricula ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Sexo</dt>
                                    <dd class="text-sm text-gray-900 dark:text-gray-100">
                                        {{ $reporte->student->sexo == 'F' ? 'Femenino' : 'Masculino' }}</dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Información del Reporte -->
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
                            <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                                {{ __('Información del Reporte') }}
                            </h4>
                            <dl class="space-y-3">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Fecha del Reporte
                                    </dt>
                                    <dd class="text-sm text-gray-900 dark:text-gray-100">
                                        {{ $reporte->fecha_reporte ? $reporte->fecha_reporte->format('d/m/Y') : 'Fecha no disponible' }}
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Materia</dt>
                                    <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $reporte->materia }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Responsables</dt>
                                    <dd class="mt-2 space-y-2">
                                        <!-- Docente (Amber) -->
                                        <div class="flex items-center">
                                            <span
                                                class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400">
                                                <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                                                </svg>
                                                Docente: {{ $reporte->profesor->name ?? 'N/A' }}
                                            </span>
                                        </div>
                                        <!-- Prefecto (Gray) -->
                                        <div class="flex items-center">
                                            <span
                                                class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                                <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Prefecto: {{ $reporte->prefecto->name ?? 'N/A' }}
                                            </span>
                                        </div>
                                        <!-- Trabajo Social (Green) -->
                                        <div class="flex items-center">
                                            <span
                                                class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                                <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Trabajo Social: {{ $reporte->trabajadorSocial->name ?? 'N/A' }}
                                            </span>
                                        </div>
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Versión</dt>
                                    <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $reporte->version }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Descripción del Reporte -->
                    <div class="mt-6">
                        <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                            {{ __('Descripción del Reporte') }}
                        </h4>
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
                            <p class="text-sm text-gray-900 dark:text-gray-100 whitespace-pre-line">
                                {{ $reporte->descripcion_reporte }}</p>
                        </div>
                    </div>

                    <!-- Observaciones -->
                    @if ($reporte->observaciones)
                        <div class="mt-6">
                            <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                                {{ __('Observaciones Adicionales') }}
                            </h4>
                            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
                                <p class="text-sm text-gray-900 dark:text-gray-100 whitespace-pre-line">
                                    {{ $reporte->observaciones }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Firmas -->
                    @if ($reporte->prefecto || $reporte->trabajadorSocial)
                        <div class="mt-6">
                            <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                                {{ __('Firmas') }}
                            </h4>
                            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
                                <dl class="space-y-3">
                                    @if ($reporte->prefecto && $reporte->firma_prefecto_at)
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Firmado
                                                por
                                                Prefecto</dt>
                                            <dd class="text-sm text-gray-900 dark:text-gray-100">
                                                {{ $reporte->prefecto->name }} -
                                                {{ $reporte->firma_prefecto_at->format('d/m/Y H:i:s') }}
                                            </dd>
                                        </div>
                                    @endif
                                    @if ($reporte->trabajadorSocial && $reporte->firma_trabajo_social_at)
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Firmado
                                                por
                                                Trabajo Social</dt>
                                            <dd class="text-sm text-gray-900 dark:text-gray-100">
                                                {{ $reporte->trabajadorSocial->name }} -
                                                {{ $reporte->firma_trabajo_social_at->format('d/m/Y H:i:s') }}
                                            </dd>
                                        </div>
                                    @endif
                                </dl>
                            </div>
                        </div>
                    @endif

                    <!-- Botones de navegación -->
                    <div class="mt-6 flex justify-between">
                        <a href="{{ route('reportes.index') }}"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-md transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Volver a la lista
                        </a>

                        @if ($reporte->estado === 'pendiente')
                            <form action="{{ route('reportes.destroy', $reporte) }}" method="POST" class="inline"
                                onsubmit="return confirm('¿Estás seguro de eliminar este reporte?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-md transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                    Eliminar Reporte
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
