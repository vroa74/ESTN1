<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Estudiante') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('estudiante.update', $estudiante) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Información Básica -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                                Información Básica
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Matrícula -->
                                <div>
                                    <x-label for="matricula" value="{{ __('Matrícula') }}" />
                                    <x-input id="matricula" type="text" name="matricula" :value="old('matricula', $estudiante->matricula)"
                                        class="mt-1 block w-full" />
                                    <x-input-error for="matricula" class="mt-2" />
                                </div>

                                <!-- Grado -->
                                <div>
                                    <x-label for="grado" value="{{ __('Grado') }}" />
                                    <x-input id="grado" type="number" name="grado" :value="old('grado', $estudiante->grado)"
                                        min="1" max="9" class="mt-1 block w-full" />
                                    <x-input-error for="grado" class="mt-2" />
                                </div>

                                <!-- Grupo -->
                                <div>
                                    <x-label for="grupo" value="{{ __('Grupo') }}" />
                                    <select id="grupo" name="grupo"
                                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                        required>
                                        <option value="">Seleccionar grupo</option>
                                        @foreach (['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L'] as $grupo)
                                            <option value="{{ $grupo }}"
                                                {{ old('grupo', $estudiante->grupo) == $grupo ? 'selected' : '' }}>
                                                {{ $grupo }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error for="grupo" class="mt-2" />
                                </div>

                                <!-- Fnom -->
                                <div>
                                    <x-label for="Fnom" value="{{ __('Fnom') }}" />
                                    <x-input id="Fnom" type="text" name="Fnom" :value="old('Fnom', $estudiante->Fnom)"
                                        class="mt-1 block w-full" />
                                    <x-input-error for="Fnom" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Datos Personales -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                                Datos Personales
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Nombres -->
                                <div>
                                    <x-label for="nombres" value="{{ __('Nombres') }}" />
                                    <x-input id="nombres" type="text" name="nombres" :value="old('nombres', $estudiante->nombres)"
                                        class="mt-1 block w-full" />
                                    <x-input-error for="nombres" class="mt-2" />
                                </div>

                                <!-- Apellido Paterno -->
                                <div>
                                    <x-label for="apa" value="{{ __('Apellido Paterno') }}" />
                                    <x-input id="apa" type="text" name="apa" :value="old('apa', $estudiante->apa)"
                                        class="mt-1 block w-full" />
                                    <x-input-error for="apa" class="mt-2" />
                                </div>

                                <!-- Apellido Materno -->
                                <div>
                                    <x-label for="ama" value="{{ __('Apellido Materno') }}" />
                                    <x-input id="ama" type="text" name="ama" :value="old('ama', $estudiante->ama)"
                                        class="mt-1 block w-full" />
                                    <x-input-error for="ama" class="mt-2" />
                                </div>

                                <!-- Fecha de Nacimiento -->
                                <div>
                                    <x-label for="fnac" value="{{ __('Fecha de Nacimiento') }}" />
                                    <x-input id="fnac" type="date" name="fnac" :value="old('fnac', $estudiante->fnac ? $estudiante->fnac->format('Y-m-d') : '')"
                                        class="mt-1 block w-full" />
                                    <x-input-error for="fnac" class="mt-2" />
                                </div>

                                <!-- CURP -->
                                <div>
                                    <x-label for="curp" value="{{ __('CURP') }}" />
                                    <x-input id="curp" type="text" name="curp" :value="old('curp', $estudiante->curp)"
                                        maxlength="18" class="mt-1 block w-full" />
                                    <x-input-error for="curp" class="mt-2" />
                                </div>

                                <!-- Sexo -->
                                <div>
                                    <x-label for="sexo" value="{{ __('Sexo') }}" />
                                    <select id="sexo" name="sexo"
                                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                        required>
                                        <option value="F"
                                            {{ old('sexo', $estudiante->sexo) == 'F' ? 'selected' : '' }}>Femenino
                                        </option>
                                        <option value="M"
                                            {{ old('sexo', $estudiante->sexo) == 'M' ? 'selected' : '' }}>Masculino
                                        </option>
                                    </select>
                                    <x-input-error for="sexo" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Datos de Contacto -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                                Datos de Contacto
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Email -->
                                <div>
                                    <x-label for="email" value="{{ __('Email') }}" />
                                    <x-input id="email" type="email" name="email" :value="old('email', $estudiante->email)"
                                        class="mt-1 block w-full" />
                                    <x-input-error for="email" class="mt-2" />
                                </div>

                                <!-- Teléfono -->
                                <div>
                                    <x-label for="telefono" value="{{ __('Teléfono') }}" />
                                    <x-input id="telefono" type="text" name="telefono" :value="old('telefono', $estudiante->telefono)"
                                        maxlength="15" class="mt-1 block w-full" />
                                    <x-input-error for="telefono" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Estado y Observaciones -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                                Estado y Observaciones
                            </h3>
                            <!-- Estatus -->
                            <div class="mb-4">
                                <x-label for="estatus" value="{{ __('Estatus') }}" />
                                <select id="estatus" name="estatus"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="activo"
                                        {{ old('estatus', $estudiante->estatus) == 'activo' ? 'selected' : '' }}>
                                        Activo</option>
                                    <option value="inactivo"
                                        {{ old('estatus', $estudiante->estatus) == 'inactivo' ? 'selected' : '' }}>
                                        Inactivo</option>
                                    <option value="egresado"
                                        {{ old('estatus', $estudiante->estatus) == 'egresado' ? 'selected' : '' }}>
                                        Egresado</option>
                                    <option value="baja"
                                        {{ old('estatus', $estudiante->estatus) == 'baja' ? 'selected' : '' }}>Baja
                                    </option>
                                </select>
                                <x-input-error for="estatus" class="mt-2" />
                            </div>

                            <!-- Observaciones -->
                            <div>
                                <x-label for="observaciones" value="{{ __('Observaciones') }}" />
                                <textarea id="observaciones" name="observaciones" rows="3"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('observaciones', $estudiante->observaciones) }}</textarea>
                                <x-input-error for="observaciones" class="mt-2" />
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="flex items-center justify-end space-x-2 mt-6">
                            <a href="{{ route('estudiante.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-400 dark:hover:bg-gray-600 transition ease-in-out duration-150">
                                {{ __('Cancelar') }}
                            </a>
                            <x-button>
                                {{ __('Actualizar Estudiante') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
