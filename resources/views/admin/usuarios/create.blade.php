<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Usuario') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-6">
                    <form method="POST" action="{{ route('usuarios.store') }}" enctype="multipart/form-data"
                        class="space-y-4">
                        @csrf

                        <!-- Información Básica -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="name"
                                    class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    {{ __('Nombre completo') }} <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                    class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-100">
                                @error('name')
                                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email"
                                    class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    {{ __('Email') }} <span class="text-red-500">*</span>
                                </label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                    class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-100">
                                @error('email')
                                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Contraseñas -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="password"
                                    class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    {{ __('Contraseña') }} <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="password" id="password" name="password" required
                                        class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-100 pr-10">
                                    <button type="button" onclick="togglePassword('password')"
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                                        <svg id="password-eye" class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                                @error('password')
                                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation"
                                    class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    {{ __('Confirmar contraseña') }} <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        required
                                        class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-100 pr-10">
                                    <button type="button" onclick="togglePassword('password_confirmation')"
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                                        <svg id="password_confirmation-eye" class="w-4 h-4" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                                @error('password_confirmation')
                                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Información Personal -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="rfc"
                                    class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    {{ __('RFC') }}
                                </label>
                                <input type="text" id="rfc" name="rfc" value="{{ old('rfc') }}"
                                    maxlength="14" placeholder="ABCD123456EFG"
                                    class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-100">
                                @error('rfc')
                                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="curp"
                                    class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    {{ __('CURP') }}
                                </label>
                                <input type="text" id="curp" name="curp" value="{{ old('curp') }}"
                                    maxlength="19" minlength="10" placeholder="ABCD123456HDFGHG01"
                                    class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-100">
                                @error('curp')
                                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="sexo"
                                    class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    {{ __('Sexo') }}
                                </label>
                                <select id="sexo" name="sexo"
                                    class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-100">
                                    <option value="">{{ __('Seleccionar sexo') }}</option>
                                    <option value="masculino" {{ old('sexo') == 'masculino' ? 'selected' : '' }}>
                                        {{ __('Masculino') }}</option>
                                    <option value="femenino" {{ old('sexo') == 'femenino' ? 'selected' : '' }}>
                                        {{ __('Femenino') }}</option>
                                </select>
                                @error('sexo')
                                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Información Laboral -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="puesto"
                                    class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    {{ __('Puesto') }}
                                </label>
                                <select id="puesto" name="puesto"
                                    class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-100">
                                    <option value="">{{ __('Seleccionar puesto') }}</option>
                                    <option value="Director" {{ old('puesto') == 'Director' ? 'selected' : '' }}>
                                        {{ __('Director') }}</option>
                                    <option value="Subdirector"
                                        {{ old('puesto') == 'Subdirector' ? 'selected' : '' }}>{{ __('Subdirector') }}
                                    </option>
                                    <option value="Coordinador"
                                        {{ old('puesto') == 'Coordinador' ? 'selected' : '' }}>{{ __('Coordinador') }}
                                    </option>
                                    <option value="Jefe de departamento"
                                        {{ old('puesto') == 'Jefe de departamento' ? 'selected' : '' }}>
                                        {{ __('Jefe de departamento') }}</option>
                                    <option value="Analista Especializado"
                                        {{ old('puesto') == 'Analista Especializado' ? 'selected' : '' }}>
                                        {{ __('Analista Especializado') }}</option>
                                    <option value="Analista" {{ old('puesto') == 'Analista' ? 'selected' : '' }}>
                                        {{ __('Analista') }}</option>
                                </select>
                                @error('puesto')
                                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="nivel"
                                    class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    {{ __('Nivel de acceso') }}
                                </label>
                                <select id="nivel" name="nivel"
                                    class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-100">
                                    <option value="7" {{ old('nivel', 7) == 7 ? 'selected' : '' }}>Nivel 7 -
                                        Usuario básico</option>
                                    <option value="6" {{ old('nivel') == 6 ? 'selected' : '' }}>Nivel 6 - Usuario
                                        avanzado</option>
                                    <option value="5" {{ old('nivel') == 5 ? 'selected' : '' }}>Nivel 5 -
                                        Operador</option>
                                    <option value="4" {{ old('nivel') == 4 ? 'selected' : '' }}>Nivel 4 -
                                        Supervisor</option>
                                    <option value="3" {{ old('nivel') == 3 ? 'selected' : '' }}>Nivel 3 -
                                        Coordinador</option>
                                    <option value="2" {{ old('nivel') == 2 ? 'selected' : '' }}>Nivel 2 -
                                        Administrador</option>
                                    <option value="1" {{ old('nivel') == 1 ? 'selected' : '' }}>Nivel 1 - Super
                                        Admin</option>
                                </select>
                                @error('nivel')
                                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="theme"
                                    class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    {{ __('Tema preferido') }}
                                </label>
                                <select id="theme" name="theme"
                                    class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-100">
                                    <option value="light" {{ old('theme', 'light') == 'light' ? 'selected' : '' }}>
                                        {{ __('Claro') }}</option>
                                    <option value="dark" {{ old('theme') == 'dark' ? 'selected' : '' }}>
                                        {{ __('Oscuro') }}</option>
                                </select>
                                @error('theme')
                                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Estado y Foto -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="estatus"
                                    class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    {{ __('Estado del usuario') }}
                                </label>
                                <select id="estatus" name="estatus"
                                    class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-100">
                                    <option value="1" {{ old('estatus', 1) == 1 ? 'selected' : '' }}>
                                        {{ __('Activo') }}</option>
                                    <option value="0" {{ old('estatus') == 0 ? 'selected' : '' }}>
                                        {{ __('Inactivo') }}</option>
                                </select>
                                @error('estatus')
                                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="photo"
                                    class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    {{ __('Foto de perfil') }}
                                </label>
                                <input type="file" id="photo" name="photo" accept="image/*"
                                    class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-100 file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100">
                                @error('photo')
                                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="flex justify-end space-x-3 pt-4">
                            <a href="{{ route('usuarios.index') }}"
                                class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-md transition-colors">
                                {{ __('Cancelar') }}
                            </a>
                            <button type="submit"
                                class="px-4 py-2 text-sm font-medium text-white bg-violet-600 hover:bg-violet-700 rounded-md transition-colors">
                                {{ __('Crear Usuario') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const eyeIcon = document.getElementById(fieldId + '-eye');

            if (field.type === 'password') {
                field.type = 'text';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                `;
            } else {
                field.type = 'password';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                `;
            }
        }
    </script>
</x-app-layout>
