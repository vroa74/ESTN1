<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Reporte de Alumno') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
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
                                    <label for="student_id"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        {{ __('Estudiante') }} <span class="text-red-500">*</span>
                                    </label>
                                    <select id="student_id" name="student_id" required
                                        class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-100">
                                        <option value="">{{ __('Seleccionar estudiante') }}</option>
                                        @foreach ($estudiantes as $estudiante)
                                            <option value="{{ $estudiante->id }}"
                                                {{ old('student_id', $reporte->student_id) == $estudiante->id ? 'selected' : '' }}>
                                                {{ $estudiante->full_name }} - {{ $estudiante->grado }}°
                                                {{ $estudiante->grupo }}
                                            </option>
                                        @endforeach
                                    </select>
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
                                        value="{{ old('fecha_reporte', $reporte->fecha_reporte->format('Y-m-d')) }}"
                                        class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-100">
                                    @error('fecha_reporte')
                                        <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="materia"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        {{ __('Materia') }} <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="materia" name="materia" required
                                        value="{{ old('materia', $reporte->materia) }}"
                                        placeholder="Ej: Matemáticas, Español, etc."
                                        class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-100">
                                    @error('materia')
                                        <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md:col-span-2">
                                    <label for="profesor_id"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        {{ __('Profesor') }} <span class="text-red-500">*</span>
                                    </label>
                                    <select id="profesor_id" name="profesor_id" required
                                        class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-100">
                                        <option value="">{{ __('Seleccionar profesor') }}</option>
                                        @foreach ($profesores as $profesor)
                                            <option value="{{ $profesor->id }}"
                                                {{ old('profesor_id', $reporte->profesor_id) == $profesor->id ? 'selected' : '' }}>
                                                {{ $profesor->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('profesor_id')
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
                                <textarea id="descripcion_reporte" name="descripcion_reporte" required rows="6"
                                    placeholder="Describe detalladamente la situación o conducta del estudiante..."
                                    class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-100">{{ old('descripcion_reporte', $reporte->descripcion_reporte) }}</textarea>
                                @error('descripcion_reporte')
                                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                    Máximo 2000 caracteres
                                </p>
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
                                <textarea id="observaciones" name="observaciones" rows="4" placeholder="Observaciones adicionales (opcional)..."
                                    class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-100">{{ old('observaciones', $reporte->observaciones) }}</textarea>
                                @error('observaciones')
                                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                    Máximo 1000 caracteres
                                </p>
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('reportes.show', $reporte) }}"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-md transition-colors">
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
</x-app-layout>
