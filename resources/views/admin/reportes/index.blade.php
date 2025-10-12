<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestión de Reportes de Alumnos') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                <div class="p-4 sm:p-6">
                    <!-- Header con botón crear -->
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Lista de Reportes') }}
                        </h3>
                        <a href="{{ route('reportes.create') }}"
                            class="inline-flex items-center px-3 py-2 text-xs font-medium text-white bg-violet-600 hover:bg-violet-700 rounded-md transition-colors">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"></path>
                            </svg>
                            {{ __('Crear Reporte') }}
                        </a>
                    </div>

                    <!-- Filtros -->
                    <form method="GET" action="{{ route('reportes.index') }}" class="mb-4">
                        <div class="grid grid-cols-1 md:grid-cols-5 gap-3">
                            <!-- Filtro Estudiante -->
                            <div>
                                <input type="text" name="estudiante" value="{{ request('estudiante') }}"
                                    placeholder="Buscar por estudiante..."
                                    class="w-full px-3 py-2 text-xs border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-violet-500 dark:focus:border-violet-600 focus:ring-violet-500 dark:focus:ring-violet-600 rounded-md shadow-sm">
                            </div>

                            <!-- Filtro Estado -->
                            <div>
                                <select name="estado"
                                    class="w-full px-3 py-2 text-xs border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-violet-500 dark:focus:border-violet-600 focus:ring-violet-500 dark:focus:ring-violet-600 rounded-md shadow-sm">
                                    <option value="">Todos los estados</option>
                                    <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>
                                        Pendiente</option>
                                    <option value="firmado_prefecto"
                                        {{ request('estado') == 'firmado_prefecto' ? 'selected' : '' }}>Firmado por
                                        Prefecto</option>
                                    <option value="firmado_trabajo_social"
                                        {{ request('estado') == 'firmado_trabajo_social' ? 'selected' : '' }}>Firmado
                                        por Trabajo Social</option>
                                    <option value="completado"
                                        {{ request('estado') == 'completado' ? 'selected' : '' }}>Completado</option>
                                </select>
                            </div>

                            <!-- Filtro Materia -->
                            <div>
                                <input type="text" name="materia" value="{{ request('materia') }}"
                                    placeholder="Buscar por materia..."
                                    class="w-full px-3 py-2 text-xs border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-violet-500 dark:focus:border-violet-600 focus:ring-violet-500 dark:focus:ring-violet-600 rounded-md shadow-sm">
                            </div>

                            <!-- Filtro Fecha Desde -->
                            <div>
                                <input type="date" name="fecha_desde" value="{{ request('fecha_desde') }}"
                                    class="w-full px-3 py-2 text-xs border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-violet-500 dark:focus:border-violet-600 focus:ring-violet-500 dark:focus:ring-violet-600 rounded-md shadow-sm">
                            </div>

                            <!-- Filtro Fecha Hasta -->
                            <div>
                                <input type="date" name="fecha_hasta" value="{{ request('fecha_hasta') }}"
                                    class="w-full px-3 py-2 text-xs border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-violet-500 dark:focus:border-violet-600 focus:ring-violet-500 dark:focus:ring-violet-600 rounded-md shadow-sm">
                            </div>
                        </div>

                        <div class="mt-3 flex justify-end space-x-2">
                            <button type="submit"
                                class="inline-flex items-center px-3 py-2 text-xs font-medium text-white bg-violet-600 hover:bg-violet-700 rounded-md transition-colors">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                {{ __('Filtrar') }}
                            </button>
                            <a href="{{ route('reportes.index') }}"
                                class="inline-flex items-center px-3 py-2 text-xs font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-md transition-colors">
                                {{ __('Limpiar') }}
                            </a>
                        </div>
                    </form>

                    <!-- Tabla de reportes -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th
                                        class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        {{ __('Estudiante') }}
                                    </th>
                                    <th
                                        class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        {{ __('Fecha') }}
                                    </th>
                                    <th
                                        class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        {{ __('Materia') }}
                                    </th>
                                    <th
                                        class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        {{ __('Profesor') }}
                                    </th>
                                    <th
                                        class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        {{ __('Estado') }}
                                    </th>
                                    <th
                                        class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        {{ __('Acciones') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($reportes as $reporte)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                        <td
                                            class="px-3 py-2 whitespace-nowrap text-xs text-gray-900 dark:text-gray-100">
                                            {{ $reporte->student->full_name }}
                                        </td>
                                        <td
                                            class="px-3 py-2 whitespace-nowrap text-xs text-gray-900 dark:text-gray-100">
                                            {{ $reporte->fecha_reporte->format('d/m/Y') }}
                                        </td>
                                        <td
                                            class="px-3 py-2 whitespace-nowrap text-xs text-gray-900 dark:text-gray-100">
                                            {{ $reporte->materia }}
                                        </td>
                                        <td
                                            class="px-3 py-2 whitespace-nowrap text-xs text-gray-900 dark:text-gray-100">
                                            {{ $reporte->profesor->name }}
                                        </td>
                                        <td class="px-3 py-2 whitespace-nowrap text-xs">
                                            @php
                                                $estadoColors = [
                                                    'pendiente' =>
                                                        'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400',
                                                    'firmado_prefecto' =>
                                                        'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
                                                    'firmado_trabajo_social' =>
                                                        'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400',
                                                    'completado' =>
                                                        'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
                                                ];
                                            @endphp
                                            <span
                                                class="px-2 py-1 rounded-full text-xs font-medium {{ $estadoColors[$reporte->estado] ?? 'bg-gray-100 text-gray-800' }}">
                                                {{ ucfirst(str_replace('_', ' ', $reporte->estado)) }}
                                            </span>
                                        </td>
                                        <td class="px-3 py-2 whitespace-nowrap text-xs">
                                            <div class="flex space-x-1">
                                                <a href="{{ route('reportes.show', $reporte) }}"
                                                    class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300"
                                                    title="Ver">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                        </path>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                </a>
                                                @if ($reporte->estado === 'pendiente')
                                                    <a href="{{ route('reportes.edit', $reporte) }}"
                                                        class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300"
                                                        title="Editar">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                @endif
                                                <a href="{{ route('reportes.pdf', $reporte) }}"
                                                    class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300"
                                                    title="PDF" target="_blank">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                        </path>
                                                    </svg>
                                                </a>
                                                @if ($reporte->estado === 'pendiente')
                                                    <form action="{{ route('reportes.destroy', $reporte) }}"
                                                        method="POST" class="inline-block"
                                                        onsubmit="return confirm('¿Estás seguro de eliminar este reporte?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                                            title="Eliminar">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                                </path>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6"
                                            class="px-3 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                            No hay reportes registrados.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación -->
                    @if ($reportes->hasPages())
                        <div class="mt-4">
                            {{ $reportes->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
