<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Reporte de Alumno') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('reportes.update', $reporte) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Información del Estudiante -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                                {{ __('Información del Estudiante') }}
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        {{ __('Estudiante') }} <span class="text-red-500">*</span>
                                    </label>

                                    <!-- Estudiante seleccionado -->
                                    <div id="selected-student"
                                        class="mb-2 sm:mb-3 p-2 sm:p-3 bg-violet-50 dark:bg-violet-900/20 border border-violet-200 dark:border-violet-800 rounded-md {{ $reporte->student_id ? '' : 'hidden' }}">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="text-xs sm:text-sm font-medium text-violet-900 dark:text-violet-100"
                                                    id="student-name">{{ $reporte->student->full_name ?? '' }}</p>
                                                <p class="text-xs text-violet-700 dark:text-violet-300"
                                                    id="student-info">{{ $reporte->student->grado ?? '' }}°
                                                    {{ $reporte->student->grupo ?? '' }}</p>
                                            </div>
                                            <button type="button" onclick="clearSelectedStudent()"
                                                class="text-violet-500 hover:text-violet-700 dark:text-violet-400 dark:hover:text-violet-200">
                                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Botón para abrir modal -->
                                    <button type="button" id="select-student-btn" onclick="openStudentModal()"
                                        class="w-full px-2 sm:px-3 py-1.5 sm:py-2 text-xs sm:text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-100 text-left bg-white hover:bg-gray-50 dark:hover:bg-gray-600 {{ $reporte->student_id ? 'hidden' : '' }}">
                                        <span
                                            class="text-gray-500 dark:text-gray-400">{{ __('Hacer clic para seleccionar estudiante') }}</span>
                                    </button>

                                    <input type="hidden" id="student_id" name="student_id"
                                        value="{{ old('student_id', $reporte->student_id) }}">
                                    @error('student_id')
                                        <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Información del Reporte -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                                {{ __('Información del Reporte') }}
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="fecha_reporte"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        {{ __('Fecha del Reporte') }} <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" id="fecha_reporte" name="fecha_reporte" required
                                        value="{{ old('fecha_reporte', $reporte->fecha_reporte ? $reporte->fecha_reporte->format('Y-m-d') : '') }}"
                                        class="w-full px-2 sm:px-3 py-1.5 sm:py-2 text-xs sm:text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-100">
                                    @error('fecha_reporte')
                                        <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        {{ __('Materia') }} <span class="text-red-500">*</span>
                                    </label>

                                    <!-- Materia seleccionada -->
                                    <div id="selected-materia"
                                        class="mb-2 sm:mb-3 p-2 sm:p-3 bg-violet-50 dark:bg-violet-900/20 border border-violet-200 dark:border-violet-800 rounded-md {{ $reporte->materia ? '' : 'hidden' }}">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="text-xs sm:text-sm font-medium text-violet-900 dark:text-violet-100"
                                                    id="materia-name">{{ $reporte->materia ?? '' }}</p>
                                                <p class="text-xs text-violet-700 dark:text-violet-300"
                                                    id="materia-info">Materia seleccionada</p>
                                            </div>
                                            <button type="button" onclick="clearSelectedMateria()"
                                                class="text-violet-500 hover:text-violet-700 dark:text-violet-400 dark:hover:text-violet-200">
                                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Botón para abrir modal -->
                                    <button type="button" id="select-materia-btn" onclick="openMateriaModal()"
                                        class="w-full px-2 sm:px-3 py-1.5 sm:py-2 text-xs sm:text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-100 text-left bg-white hover:bg-gray-50 dark:hover:bg-gray-600 {{ $reporte->materia ? 'hidden' : '' }}">
                                        <span
                                            class="text-gray-500 dark:text-gray-400">{{ __('Hacer clic para seleccionar materia') }}</span>
                                    </button>

                                    <input type="hidden" id="materia" name="materia"
                                        value="{{ old('materia', $reporte->materia) }}">
                                    @error('materia')
                                        <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <!-- Descripción del Reporte -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                                {{ __('Descripción del Reporte') }}
                            </h3>
                            <div>
                                <label for="descripcion_reporte"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    {{ __('Descripción') }} <span class="text-red-500">*</span>
                                </label>
                                <textarea id="descripcion_reporte" name="descripcion_reporte" required rows="4"
                                    placeholder="Describe detalladamente la situación o conducta del estudiante..."
                                    class="w-full px-2 sm:px-3 py-1.5 sm:py-2 text-xs sm:text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-100">{{ old('descripcion_reporte', $reporte->descripcion_reporte) }}</textarea>
                                @error('descripcion_reporte')
                                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                    Máximo 2000 caracteres
                                </p>
                            </div>
                        </div>

                        <!-- Personal Académico -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                                {{ __('Personal Académico') }}
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <!-- Docente -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        {{ __('Docente') }} <span class="text-red-500">*</span>
                                    </label>

                                    <!-- Docente seleccionado -->
                                    <div id="selected-docente"
                                        class="mb-2 sm:mb-3 p-2 sm:p-3 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-md {{ $reporte->profesor_id ? '' : 'hidden' }}">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="text-xs sm:text-sm font-medium text-amber-900 dark:text-amber-100"
                                                    id="docente-name">{{ $reporte->profesor->name ?? '' }}</p>
                                                <p class="text-xs text-amber-700 dark:text-amber-300"
                                                    id="docente-info">{{ $reporte->profesor->email ?? '' }}</p>
                                            </div>
                                            <button type="button" onclick="clearSelectedDocente()"
                                                class="text-amber-500 hover:text-amber-700 dark:text-amber-400 dark:hover:text-amber-200">
                                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Botón para abrir modal -->
                                    <button type="button" id="select-docente-btn" onclick="openDocenteModal()"
                                        class="w-full px-2 sm:px-3 py-1.5 sm:py-2 text-xs sm:text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-amber-500 focus:border-amber-500 dark:bg-gray-700 dark:text-gray-100 text-left bg-white hover:bg-gray-50 dark:hover:bg-gray-600 {{ $reporte->profesor_id ? 'hidden' : '' }}">
                                        <span
                                            class="text-gray-500 dark:text-gray-400">{{ __('Hacer clic para seleccionar docente') }}</span>
                                    </button>

                                    <input type="hidden" id="docente_id" name="docente_id"
                                        value="{{ old('docente_id', $reporte->profesor_id) }}">
                                    @error('docente_id')
                                        <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Prefecto -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        {{ __('Prefecto') }} <span class="text-red-500">*</span>
                                    </label>

                                    <!-- Prefecto seleccionado -->
                                    <div id="selected-prefecto"
                                        class="mb-2 sm:mb-3 p-2 sm:p-3 bg-gray-50 dark:bg-gray-800/20 border border-gray-200 dark:border-gray-600 rounded-md {{ $reporte->prefecto_id ? '' : 'hidden' }}">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="text-xs sm:text-sm font-medium text-gray-900 dark:text-gray-100"
                                                    id="prefecto-name">{{ $reporte->prefecto->name ?? '' }}</p>
                                                <p class="text-xs text-gray-700 dark:text-gray-300"
                                                    id="prefecto-info">{{ $reporte->prefecto->email ?? '' }}</p>
                                            </div>
                                            <button type="button" onclick="clearSelectedPrefecto()"
                                                class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Botón para abrir modal -->
                                    <button type="button" id="select-prefecto-btn" onclick="openPrefectoModal()"
                                        class="w-full px-2 sm:px-3 py-1.5 sm:py-2 text-xs sm:text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:text-gray-100 text-left bg-white hover:bg-gray-50 dark:hover:bg-gray-600 {{ $reporte->prefecto_id ? 'hidden' : '' }}">
                                        <span
                                            class="text-gray-500 dark:text-gray-400">{{ __('Hacer clic para seleccionar prefecto') }}</span>
                                    </button>

                                    <input type="hidden" id="prefecto_id" name="prefecto_id"
                                        value="{{ old('prefecto_id', $reporte->prefecto_id) }}">
                                    @error('prefecto_id')
                                        <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Trabajador Social -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        {{ __('Trabajador Social') }} <span class="text-red-500">*</span>
                                    </label>

                                    <!-- Trabajador Social seleccionado -->
                                    <div id="selected-trabajador-social"
                                        class="mb-2 sm:mb-3 p-2 sm:p-3 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-md {{ $reporte->trabajo_social_id ? '' : 'hidden' }}">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="text-xs sm:text-sm font-medium text-green-900 dark:text-green-100"
                                                    id="trabajador-social-name">
                                                    {{ $reporte->trabajadorSocial->name ?? '' }}
                                                </p>
                                                <p class="text-xs text-green-700 dark:text-green-300"
                                                    id="trabajador-social-info">
                                                    {{ $reporte->trabajadorSocial->email ?? '' }}
                                                </p>
                                            </div>
                                            <button type="button" onclick="clearSelectedTrabajadorSocial()"
                                                class="text-green-500 hover:text-green-700 dark:text-green-400 dark:hover:text-green-200">
                                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Botón para abrir modal -->
                                    <button type="button" id="select-trabajador-social-btn"
                                        onclick="openTrabajadorSocialModal()"
                                        class="w-full px-2 sm:px-3 py-1.5 sm:py-2 text-xs sm:text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-gray-100 text-left bg-white hover:bg-gray-50 dark:hover:bg-gray-600 {{ $reporte->trabajo_social_id ? 'hidden' : '' }}">
                                        <span
                                            class="text-gray-500 dark:text-gray-400">{{ __('Hacer clic para seleccionar trabajador social') }}</span>
                                    </button>

                                    <input type="hidden" id="trabajador_social_id" name="trabajador_social_id"
                                        value="{{ old('trabajador_social_id', $reporte->trabajo_social_id) }}">
                                    @error('trabajador_social_id')
                                        <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Observaciones Adicionales -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                                {{ __('Observaciones Adicionales') }}
                            </h3>
                            <div>
                                <label for="observaciones"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    {{ __('Observaciones') }}
                                </label>
                                <textarea id="observaciones" name="observaciones" rows="3"
                                    placeholder="Observaciones adicionales (opcional)..."
                                    class="w-full px-2 sm:px-3 py-1.5 sm:py-2 text-xs sm:text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-100">{{ old('observaciones', $reporte->observaciones) }}</textarea>
                                @error('observaciones')
                                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                    Máximo 1000 caracteres
                                </p>
                            </div>
                        </div>

                        <!-- Botones de Acción -->
                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('reportes.index') }}"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-md transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                {{ __('Cancelar') }}
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-violet-600 hover:bg-violet-700 rounded-md transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                {{ __('Actualizar Reporte') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para seleccionar estudiante -->
    <div id="student-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
        <div
            class="relative top-20 mx-auto p-5 border w-11/12 max-w-5xl shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="mt-3">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Seleccionar Estudiante') }}
                    </h3>
                    <button type="button" onclick="closeStudentModal()"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        {{ __('Buscar estudiante') }}
                    </label>
                    <input type="text" id="search-student" placeholder="Nombre del estudiante..."
                        class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-100">
                </div>
                <div class="max-h-96 overflow-y-auto border border-gray-200 dark:border-gray-600 rounded-md">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('Nombre') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('Grado/Grupo') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('Acción') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody id="students-table-body"
                            class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                            <!-- Los estudiantes se cargarán aquí via AJAX -->
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 flex justify-end space-x-3">
                    <button type="button" onclick="closeStudentModal()"
                        class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-md transition-colors">
                        {{ __('Cancelar') }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para seleccionar materia -->
    <div id="materia-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
        <div
            class="relative top-20 mx-auto p-5 border w-11/12 max-w-3xl shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="mt-3">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Seleccionar Materia') }}
                    </h3>
                    <button type="button" onclick="closeMateriaModal()"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        {{ __('Buscar materia') }}
                    </label>
                    <input type="text" id="search-materia" placeholder="Nombre de la materia..."
                        class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-100">
                </div>
                <div class="max-h-96 overflow-y-auto border border-gray-200 dark:border-gray-600 rounded-md">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('Materia') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('Acción') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody id="materias-table-body"
                            class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                            <!-- Las materias se cargarán aquí via AJAX -->
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 flex justify-end space-x-3">
                    <button type="button" onclick="closeMateriaModal()"
                        class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-md transition-colors">
                        {{ __('Cancelar') }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para seleccionar docente -->
    <div id="docente-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
        <div
            class="relative top-20 mx-auto p-5 border w-11/12 max-w-3xl shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="mt-3">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Seleccionar Docente') }}
                    </h3>
                    <button type="button" onclick="closeDocenteModal()"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        {{ __('Buscar docente') }}
                    </label>
                    <input type="text" id="search-docente" placeholder="Nombre del docente..."
                        class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-100">
                </div>
                <div class="max-h-96 overflow-y-auto border border-gray-200 dark:border-gray-600 rounded-md">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('Nombre') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('Email') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('Acción') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody id="docentes-table-body"
                            class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                            <!-- Los docentes se cargarán aquí via AJAX -->
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 flex justify-end space-x-3">
                    <button type="button" onclick="closeDocenteModal()"
                        class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-md transition-colors">
                        {{ __('Cancelar') }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para seleccionar prefecto -->
    <div id="prefecto-modal"
        class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
        <div
            class="relative top-20 mx-auto p-5 border w-11/12 max-w-3xl shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="mt-3">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Seleccionar Prefecto') }}
                    </h3>
                    <button type="button" onclick="closePrefectoModal()"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        {{ __('Buscar prefecto') }}
                    </label>
                    <input type="text" id="search-prefecto" placeholder="Nombre del prefecto..."
                        class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-100">
                </div>
                <div class="max-h-96 overflow-y-auto border border-gray-200 dark:border-gray-600 rounded-md">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('Nombre') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('Email') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('Acción') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody id="prefectos-table-body"
                            class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                            <!-- Los prefectos se cargarán aquí via AJAX -->
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 flex justify-end space-x-3">
                    <button type="button" onclick="closePrefectoModal()"
                        class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-md transition-colors">
                        {{ __('Cancelar') }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para seleccionar trabajador social -->
    <div id="trabajador-social-modal"
        class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
        <div
            class="relative top-20 mx-auto p-5 border w-11/12 max-w-3xl shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="mt-3">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Seleccionar Trabajador Social') }}
                    </h3>
                    <button type="button" onclick="closeTrabajadorSocialModal()"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        {{ __('Buscar trabajador social') }}
                    </label>
                    <input type="text" id="search-trabajador-social" placeholder="Nombre del trabajador social..."
                        class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-100">
                </div>
                <div class="max-h-96 overflow-y-auto border border-gray-200 dark:border-gray-600 rounded-md">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('Nombre') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('Email') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('Acción') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody id="trabajadores-sociales-table-body"
                            class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                            <!-- Los trabajadores sociales se cargarán aquí via AJAX -->
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 flex justify-end space-x-3">
                    <button type="button" onclick="closeTrabajadorSocialModal()"
                        class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-md transition-colors">
                        {{ __('Cancelar') }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Variables globales para almacenar las selecciones
        let selectedStudent = null;
        let selectedMateria = null;
        let selectedDocente = null;
        let selectedPrefecto = null;
        let selectedTrabajadorSocial = null;

        // Funciones para el modal de estudiantes
        function openStudentModal() {
            document.getElementById('student-modal').classList.remove('hidden');
            loadStudents();
        }

        function closeStudentModal() {
            document.getElementById('student-modal').classList.add('hidden');
        }

        function loadStudents() {
            const searchTerm = document.getElementById('search-student').value;
            const tbody = document.getElementById('students-table-body');

            fetch(`{{ route('estudiante.search') }}?nombre=${encodeURIComponent(searchTerm)}`)
                .then(response => response.text())
                .then(html => {
                    tbody.innerHTML = html;
                })
                .catch(error => {
                    console.error('Error:', error);
                    tbody.innerHTML =
                        '<tr><td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">Error al cargar estudiantes</td></tr>';
                });
        }

        function selectStudent(id, name, grado, grupo) {
            selectedStudent = {
                id,
                name,
                grado,
                grupo
            };
            document.getElementById('student_id').value = id;
            document.getElementById('student-name').textContent = name;
            document.getElementById('student-info').textContent = `${grado}° ${grupo}`;
            document.getElementById('selected-student').classList.remove('hidden');
            document.getElementById('select-student-btn').classList.add('hidden');
            closeStudentModal();
        }

        function clearSelectedStudent() {
            selectedStudent = null;
            document.getElementById('student_id').value = '';
            document.getElementById('selected-student').classList.add('hidden');
            document.getElementById('select-student-btn').classList.remove('hidden');
        }

        // Funciones para el modal de materias
        function openMateriaModal() {
            document.getElementById('materia-modal').classList.remove('hidden');
            loadMaterias();
        }

        function closeMateriaModal() {
            document.getElementById('materia-modal').classList.add('hidden');
        }

        function loadMaterias() {
            const searchTerm = document.getElementById('search-materia').value;
            const tbody = document.getElementById('materias-table-body');

            fetch(`{{ route('materias.search') }}?nombre=${encodeURIComponent(searchTerm)}&modal=1`)
                .then(response => response.text())
                .then(html => {
                    tbody.innerHTML = html;
                })
                .catch(error => {
                    console.error('Error:', error);
                    tbody.innerHTML =
                        '<tr><td colspan="2" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">Error al cargar materias</td></tr>';
                });
        }

        function selectMateria(nombre) {
            selectedMateria = nombre;
            document.getElementById('materia').value = nombre;
            document.getElementById('materia-name').textContent = nombre;
            document.getElementById('selected-materia').classList.remove('hidden');
            document.getElementById('select-materia-btn').classList.add('hidden');
            closeMateriaModal();
        }

        function clearSelectedMateria() {
            selectedMateria = null;
            document.getElementById('materia').value = '';
            document.getElementById('selected-materia').classList.add('hidden');
            document.getElementById('select-materia-btn').classList.remove('hidden');
        }

        // Funciones para el modal de docentes
        function openDocenteModal() {
            document.getElementById('docente-modal').classList.remove('hidden');
            loadDocentes();
        }

        function closeDocenteModal() {
            document.getElementById('docente-modal').classList.add('hidden');
        }

        function loadDocentes() {
            const searchTerm = document.getElementById('search-docente').value;
            const tbody = document.getElementById('docentes-table-body');

            fetch(`{{ route('usuarios.search') }}?tipo=profesor&nombre=${encodeURIComponent(searchTerm)}`)
                .then(response => response.text())
                .then(html => {
                    tbody.innerHTML = html;
                })
                .catch(error => {
                    console.error('Error:', error);
                    tbody.innerHTML =
                        '<tr><td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">Error al cargar docentes</td></tr>';
                });
        }

        function selectDocente(id, name, email) {
            selectedDocente = {
                id,
                name,
                email
            };
            document.getElementById('docente_id').value = id;
            document.getElementById('docente-name').textContent = name;
            document.getElementById('docente-info').textContent = email;
            document.getElementById('selected-docente').classList.remove('hidden');
            document.getElementById('select-docente-btn').classList.add('hidden');
            closeDocenteModal();
        }

        function clearSelectedDocente() {
            selectedDocente = null;
            document.getElementById('docente_id').value = '';
            document.getElementById('selected-docente').classList.add('hidden');
            document.getElementById('select-docente-btn').classList.remove('hidden');
        }

        // Funciones para el modal de prefectos
        function openPrefectoModal() {
            document.getElementById('prefecto-modal').classList.remove('hidden');
            loadPrefectos();
        }

        function closePrefectoModal() {
            document.getElementById('prefecto-modal').classList.add('hidden');
        }

        function loadPrefectos() {
            const searchTerm = document.getElementById('search-prefecto').value;
            const tbody = document.getElementById('prefectos-table-body');

            fetch(`{{ route('usuarios.search') }}?tipo=prefecto&nombre=${encodeURIComponent(searchTerm)}`)
                .then(response => response.text())
                .then(html => {
                    tbody.innerHTML = html;
                })
                .catch(error => {
                    console.error('Error:', error);
                    tbody.innerHTML =
                        '<tr><td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">Error al cargar prefectos</td></tr>';
                });
        }

        function selectPrefecto(id, name, email) {
            selectedPrefecto = {
                id,
                name,
                email
            };
            document.getElementById('prefecto_id').value = id;
            document.getElementById('prefecto-name').textContent = name;
            document.getElementById('prefecto-info').textContent = email;
            document.getElementById('selected-prefecto').classList.remove('hidden');
            document.getElementById('select-prefecto-btn').classList.add('hidden');
            closePrefectoModal();
        }

        function clearSelectedPrefecto() {
            selectedPrefecto = null;
            document.getElementById('prefecto_id').value = '';
            document.getElementById('selected-prefecto').classList.add('hidden');
            document.getElementById('select-prefecto-btn').classList.remove('hidden');
        }

        // Funciones para el modal de trabajadores sociales
        function openTrabajadorSocialModal() {
            document.getElementById('trabajador-social-modal').classList.remove('hidden');
            loadTrabajadoresSociales();
        }

        function closeTrabajadorSocialModal() {
            document.getElementById('trabajador-social-modal').classList.add('hidden');
        }

        function loadTrabajadoresSociales() {
            const searchTerm = document.getElementById('search-trabajador-social').value;
            const tbody = document.getElementById('trabajadores-sociales-table-body');

            fetch(`{{ route('usuarios.search') }}?tipo=trabajador_social&nombre=${encodeURIComponent(searchTerm)}`)
                .then(response => response.text())
                .then(html => {
                    tbody.innerHTML = html;
                })
                .catch(error => {
                    console.error('Error:', error);
                    tbody.innerHTML =
                        '<tr><td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">Error al cargar trabajadores sociales</td></tr>';
                });
        }

        function selectTrabajadorSocial(id, name, email) {
            selectedTrabajadorSocial = {
                id,
                name,
                email
            };
            document.getElementById('trabajador_social_id').value = id;
            document.getElementById('trabajador-social-name').textContent = name;
            document.getElementById('trabajador-social-info').textContent = email;
            document.getElementById('selected-trabajador-social').classList.remove('hidden');
            document.getElementById('select-trabajador-social-btn').classList.add('hidden');
            closeTrabajadorSocialModal();
        }

        function clearSelectedTrabajadorSocial() {
            selectedTrabajadorSocial = null;
            document.getElementById('trabajador_social_id').value = '';
            document.getElementById('selected-trabajador-social').classList.add('hidden');
            document.getElementById('select-trabajador-social-btn').classList.remove('hidden');
        }

        // Event listeners para búsquedas
        document.addEventListener('DOMContentLoaded', function() {
            // Búsqueda de estudiantes
            const searchStudentInput = document.getElementById('search-student');
            if (searchStudentInput) {
                searchStudentInput.addEventListener('input', loadStudents);
            }

            // Búsqueda de materias
            const searchMateriaInput = document.getElementById('search-materia');
            if (searchMateriaInput) {
                searchMateriaInput.addEventListener('input', loadMaterias);
            }

            // Búsqueda de docentes
            const searchDocenteInput = document.getElementById('search-docente');
            if (searchDocenteInput) {
                searchDocenteInput.addEventListener('input', loadDocentes);
            }

            // Búsqueda de prefectos
            const searchPrefectoInput = document.getElementById('search-prefecto');
            if (searchPrefectoInput) {
                searchPrefectoInput.addEventListener('input', loadPrefectos);
            }

            // Búsqueda de trabajadores sociales
            const searchTrabajadorSocialInput = document.getElementById('search-trabajador-social');
            if (searchTrabajadorSocialInput) {
                searchTrabajadorSocialInput.addEventListener('input', loadTrabajadoresSociales);
            }

            // Cerrar modales al hacer clic fuera de ellos
            document.addEventListener('click', function(event) {
                const modals = ['student-modal', 'materia-modal', 'docente-modal', 'prefecto-modal',
                    'trabajador-social-modal'
                ];
                modals.forEach(modalId => {
                    const modal = document.getElementById(modalId);
                    if (modal && event.target === modal) {
                        modal.classList.add('hidden');
                    }
                });
            });

            // Los campos ya seleccionados se muestran automáticamente desde el servidor
            // Solo necesitamos verificar que los valores estén presentes
            const studentId = document.getElementById('student_id').value;
            const materia = document.getElementById('materia').value;
            const docenteId = document.getElementById('docente_id').value;
            const prefectoId = document.getElementById('prefecto_id').value;
            const trabajadorSocialId = document.getElementById('trabajador_social_id').value;

            // Log para debug
            console.log('Valores cargados:', {
                student_id: studentId,
                materia: materia,
                docente_id: docenteId,
                prefecto_id: prefectoId,
                trabajador_social_id: trabajadorSocialId
            });

            // Validar formulario antes de enviar
            document.querySelector('form').addEventListener('submit', function(e) {
                const docenteId = document.getElementById('docente_id').value;
                const prefectoId = document.getElementById('prefecto_id').value;
                const trabajadorSocialId = document.getElementById('trabajador_social_id').value;
                const studentId = document.getElementById('student_id').value;

                if (!docenteId) {
                    e.preventDefault();
                    alert('Por favor selecciona un docente');
                    return false;
                }

                if (!prefectoId) {
                    e.preventDefault();
                    alert('Por favor selecciona un prefecto');
                    return false;
                }

                if (!trabajadorSocialId) {
                    e.preventDefault();
                    alert('Por favor selecciona un trabajador social');
                    return false;
                }

                if (!studentId) {
                    e.preventDefault();
                    alert('Por favor selecciona un estudiante');
                    return false;
                }

                console.log('Enviando formulario con:', {
                    student_id: studentId,
                    docente_id: docenteId,
                    prefecto_id: prefectoId,
                    trabajador_social_id: trabajadorSocialId
                });
            });
        });
    </script>
</x-app-layout>
