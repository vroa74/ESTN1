<x-authentication-layout>
    <h1 class="text-3xl text-gray-800 dark:text-gray-100 font-bold mb-6">{{ __('Create your Account') }}</h1>
    <!-- Form -->
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="space-y-4">
            <!-- Nombre completo -->
            <div>
                <x-label for="name">{{ __('Full Name') }} <span class="text-red-500">*</span></x-label>
                <x-input id="name" type="text" name="name" :value="old('name')" required autofocus
                    autocomplete="name" />
            </div>

            <!-- Email -->
            <div>
                <x-label for="email">{{ __('Email Address') }} <span class="text-red-500">*</span></x-label>
                <x-input id="email" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- RFC -->
            <div>
                <x-label for="rfc">{{ __('RFC') }}</x-label>
                <x-input id="rfc" type="text" name="rfc" :value="old('rfc')" placeholder="ABCD123456EFG"
                    maxlength="14" />
            </div>

            <!-- CURP -->
            <div>
                <x-label for="curp">{{ __('CURP') }}</x-label>
                <x-input id="curp" type="text" name="curp" :value="old('curp')" placeholder="ABCD123456HDFGHG01"
                    maxlength="19" minlength="10" />
            </div>

            <!-- Sexo -->
            <div>
                <x-label for="sexo">{{ __('Gender') }}</x-label>
                <select id="sexo" name="sexo"
                    class="w-full px-3 py-2 border border-gray-200 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-800 dark:text-gray-100">
                    <option value="">{{ __('Select gender') }}</option>
                    <option value="masculino" {{ old('sexo') == 'masculino' ? 'selected' : '' }}>{{ __('Male') }}
                    </option>
                    <option value="femenino" {{ old('sexo') == 'femenino' ? 'selected' : '' }}>{{ __('Female') }}
                    </option>
                </select>
            </div>

            <!-- Puesto -->
            <div>
                <x-label for="puesto">{{ __('Position') }}</x-label>
                <select id="puesto" name="puesto"
                    class="w-full px-3 py-2 border border-gray-200 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-800 dark:text-gray-100">
                    <option value="">{{ __('Select position') }}</option>
                    <option value="Director" {{ old('puesto') == 'Director' ? 'selected' : '' }}>{{ __('Director') }}
                    </option>
                    <option value="Subdirector" {{ old('puesto') == 'Subdirector' ? 'selected' : '' }}>
                        {{ __('Subdirector') }}</option>
                    <option value="Coordinador" {{ old('puesto') == 'Coordinador' ? 'selected' : '' }}>
                        {{ __('Coordinador') }}</option>
                    <option value="Jefe de departamento"
                        {{ old('puesto') == 'Jefe de departamento' ? 'selected' : '' }}>
                        {{ __('Jefe de departamento') }}</option>
                    <option value="Analista Especializado"
                        {{ old('puesto') == 'Analista Especializado' ? 'selected' : '' }}>
                        {{ __('Analista Especializado') }}</option>
                    <option value="Analista" {{ old('puesto') == 'Analista' ? 'selected' : '' }}>{{ __('Analista') }}
                    </option>
                </select>
            </div>

            <!-- Tema preferido -->
            <div>
                <x-label for="theme">{{ __('Preferred Theme') }}</x-label>
                <select id="theme" name="theme"
                    class="w-full px-3 py-2 border border-gray-200 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-800 dark:text-gray-100">
                    <option value="light" {{ old('theme', 'light') == 'light' ? 'selected' : '' }}>
                        {{ __('Light') }}</option>
                    <option value="dark" {{ old('theme') == 'dark' ? 'selected' : '' }}>{{ __('Dark') }}</option>
                </select>
            </div>

            <!-- Contraseña -->
            <div>
                <x-label for="password" value="{{ __('Password') }}" />
                <div class="relative">
                    <x-input id="password" type="password" name="password" required autocomplete="new-password"
                        class="pr-10" />
                    <button type="button" onclick="togglePassword('password')"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg id="password-eye" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Confirmar contraseña -->
            <div>
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <div class="relative">
                    <x-input id="password_confirmation" type="password" name="password_confirmation" required
                        autocomplete="new-password" class="pr-10" />
                    <button type="button" onclick="togglePassword('password_confirmation')"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg id="password_confirmation-eye" class="w-5 h-5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div class="flex items-center justify-between mt-6">
            <div class="mr-1">
                <label class="flex items-center" name="newsletter" id="newsletter">
                    <input type="checkbox" class="form-checkbox" />
                    <span class="text-sm ml-2">{{ __('Email me about product news.') }}</span>
                </label>
            </div>
            <x-button>
                {{ __('Sign Up') }}
            </x-button>
        </div>
        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="mt-6">
                <label class="flex items-start">
                    <input type="checkbox" class="form-checkbox mt-1" name="terms" id="terms" />
                    <span class="text-sm ml-2">
                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                            'terms_of_service' =>
                                '<a target="_blank" href="' .
                                route('terms.show') .
                                '" class="text-sm underline hover:no-underline">' .
                                __('Terms of Service') .
                                '</a>',
                            'privacy_policy' =>
                                '<a target="_blank" href="' .
                                route('policy.show') .
                                '" class="text-sm underline hover:no-underline">' .
                                __('Privacy Policy') .
                                '</a>',
                        ]) !!}
                    </span>
                </label>
            </div>
        @endif
    </form>
    <x-validation-errors class="mt-4" />
    <!-- Footer -->
    <div class="pt-5 mt-6 border-t border-gray-100 dark:border-gray-700/60">
        <div class="text-sm">
            {{ __('Have an account?') }} <a
                class="font-medium text-violet-500 hover:text-violet-600 dark:hover:text-violet-400"
                href="{{ route('login') }}">{{ __('Sign In') }}</a>
        </div>
    </div>

    <!-- JavaScript para show/hide password -->
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
</x-authentication-layout>
