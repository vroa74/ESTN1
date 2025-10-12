<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Page header -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">{{ __('Componentes') }}</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-2">{{ __('Lista de todos los componentes disponibles en el proyecto') }}</p>
            </div>

        </div>

        <!-- Installed Packages Section -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-6">{{ __('Paquetes Instalados') }}</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- PHP Dependencies (Composer) -->
                <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ __('Dependencias PHP (Composer)') }}
                    </h3>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between py-2 px-3 bg-blue-50 dark:bg-blue-900/20 rounded">
                            <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">laravel/framework</span>
                            <span class="text-xs text-blue-600 dark:text-blue-400">^11.0</span>
                        </div>
                        <div class="flex items-center justify-between py-2 px-3 bg-blue-50 dark:bg-blue-900/20 rounded">
                            <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">laravel/jetstream</span>
                            <span class="text-xs text-blue-600 dark:text-blue-400">^5.0</span>
                        </div>
                        <div class="flex items-center justify-between py-2 px-3 bg-blue-50 dark:bg-blue-900/20 rounded">
                            <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">laravel/sanctum</span>
                            <span class="text-xs text-blue-600 dark:text-blue-400">^4.0</span>
                        </div>
                        <div class="flex items-center justify-between py-2 px-3 bg-blue-50 dark:bg-blue-900/20 rounded">
                            <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">livewire/livewire</span>
                            <span class="text-xs text-blue-600 dark:text-blue-400">^3.4</span>
                        </div>
                        <div class="flex items-center justify-between py-2 px-3 bg-blue-50 dark:bg-blue-900/20 rounded">
                            <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">guzzlehttp/guzzle</span>
                            <span class="text-xs text-blue-600 dark:text-blue-400">^7.2</span>
                        </div>
                        <div class="flex items-center justify-between py-2 px-3 bg-blue-50 dark:bg-blue-900/20 rounded">
                            <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">laravel/tinker</span>
                            <span class="text-xs text-blue-600 dark:text-blue-400">^2.8</span>
                        </div>
                        <div class="flex items-center justify-between py-2 px-3 bg-blue-50 dark:bg-blue-900/20 rounded">
                            <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">barryvdh/laravel-dompdf</span>
                            <span class="text-xs text-blue-600 dark:text-blue-400">^3.1</span>
                        </div>
                        <div class="flex items-center justify-between py-2 px-3 bg-blue-50 dark:bg-blue-900/20 rounded">
                            <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">endroid/qr-code</span>
                            <span class="text-xs text-blue-600 dark:text-blue-400">^6.0</span>
                        </div>
                    </div>
                </div>

                <!-- Node.js Dependencies -->
                <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ __('Dependencias Node.js') }}
                    </h3>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between py-2 px-3 bg-green-50 dark:bg-green-900/20 rounded">
                            <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">alpinejs</span>
                            <span class="text-xs text-green-600 dark:text-green-400">^3.14.8</span>
                        </div>
                        <div class="flex items-center justify-between py-2 px-3 bg-green-50 dark:bg-green-900/20 rounded">
                            <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">chart.js</span>
                            <span class="text-xs text-green-600 dark:text-green-400">^4.4.7</span>
                        </div>
                        <div class="flex items-center justify-between py-2 px-3 bg-green-50 dark:bg-green-900/20 rounded">
                            <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">tailwindcss</span>
                            <span class="text-xs text-green-600 dark:text-green-400">^4.0.3</span>
                        </div>
                        <div class="flex items-center justify-between py-2 px-3 bg-green-50 dark:bg-green-900/20 rounded">
                            <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">vite</span>
                            <span class="text-xs text-green-600 dark:text-green-400">^6.0.11</span>
                        </div>
                        <div class="flex items-center justify-between py-2 px-3 bg-green-50 dark:bg-green-900/20 rounded">
                            <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">axios</span>
                            <span class="text-xs text-green-600 dark:text-green-400">^1.7.9</span>
                        </div>
                        <div class="flex items-center justify-between py-2 px-3 bg-green-50 dark:bg-green-900/20 rounded">
                            <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">flatpickr</span>
                            <span class="text-xs text-green-600 dark:text-green-400">^4.6.13</span>
                        </div>
                        <div class="flex items-center justify-between py-2 px-3 bg-green-50 dark:bg-green-900/20 rounded">
                            <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">moment</span>
                            <span class="text-xs text-green-600 dark:text-green-400">^2.30.1</span>
                        </div>
                        <div class="flex items-center justify-between py-2 px-3 bg-green-50 dark:bg-green-900/20 rounded">
                            <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">nprogress</span>
                            <span class="text-xs text-green-600 dark:text-green-400">^0.2.0</span>
                        </div>
                        <div class="flex items-center justify-between py-2 px-3 bg-green-50 dark:bg-green-900/20 rounded">
                            <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">flowbite</span>
                            <span class="text-xs text-green-600 dark:text-green-400">^3.1.2</span>
                        </div>
                        <div class="flex items-center justify-between py-2 px-3 bg-green-50 dark:bg-green-900/20 rounded">
                            <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">lucide</span>
                            <span class="text-xs text-green-600 dark:text-green-400">^0.545.0</span>
                        </div>
                        <div class="flex items-center justify-between py-2 px-3 bg-green-50 dark:bg-green-900/20 rounded">
                            <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">remixicon</span>
                            <span class="text-xs text-green-600 dark:text-green-400">^4.6.0</span>
                        </div>
                        <div class="flex items-center justify-between py-2 px-3 bg-green-50 dark:bg-green-900/20 rounded">
                            <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">sweetalert2</span>
                            <span class="text-xs text-green-600 dark:text-green-400">^11.25.0</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Development Dependencies -->
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">{{ __('Dependencias de Desarrollo') }}</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- PHP Dev Dependencies -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6">
                        <h4 class="text-md font-semibold text-gray-800 dark:text-gray-100 mb-4 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"></path>
                            </svg>
                            {{ __('PHP (Dev)') }}
                        </h4>
                        <div class="space-y-2">
                            <div class="flex items-center justify-between py-2 px-3 bg-yellow-50 dark:bg-yellow-900/20 rounded">
                                <span class="text-sm text-gray-700 dark:text-gray-300">phpunit/phpunit</span>
                                <span class="text-xs text-yellow-600 dark:text-yellow-400">^10.1</span>
                            </div>
                            <div class="flex items-center justify-between py-2 px-3 bg-yellow-50 dark:bg-yellow-900/20 rounded">
                                <span class="text-sm text-gray-700 dark:text-gray-300">fakerphp/faker</span>
                                <span class="text-xs text-yellow-600 dark:text-yellow-400">^1.9.1</span>
                            </div>
                            <div class="flex items-center justify-between py-2 px-3 bg-yellow-50 dark:bg-yellow-900/20 rounded">
                                <span class="text-sm text-gray-700 dark:text-gray-300">laravel/pint</span>
                                <span class="text-xs text-yellow-600 dark:text-yellow-400">^1.0</span>
                            </div>
                            <div class="flex items-center justify-between py-2 px-3 bg-yellow-50 dark:bg-yellow-900/20 rounded">
                                <span class="text-sm text-gray-700 dark:text-gray-300">mockery/mockery</span>
                                <span class="text-xs text-yellow-600 dark:text-yellow-400">^1.4.4</span>
                            </div>
                            <div class="flex items-center justify-between py-2 px-3 bg-yellow-50 dark:bg-yellow-900/20 rounded">
                                <span class="text-sm text-gray-700 dark:text-gray-300">spatie/laravel-ignition</span>
                                <span class="text-xs text-yellow-600 dark:text-yellow-400">^2.0</span>
                            </div>
                        </div>
                    </div>

                    <!-- Node.js Dev Dependencies -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6">
                        <h4 class="text-md font-semibold text-gray-800 dark:text-gray-100 mb-4 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"></path>
                            </svg>
                            {{ __('Node.js (Dev)') }}
                        </h4>
                        <div class="space-y-2">
                            <div class="flex items-center justify-between py-2 px-3 bg-orange-50 dark:bg-orange-900/20 rounded">
                                <span class="text-sm text-gray-700 dark:text-gray-300">@tailwindcss/forms</span>
                                <span class="text-xs text-orange-600 dark:text-orange-400">^0.5.10</span>
                            </div>
                            <div class="flex items-center justify-between py-2 px-3 bg-orange-50 dark:bg-orange-900/20 rounded">
                                <span class="text-sm text-gray-700 dark:text-gray-300">@tailwindcss/typography</span>
                                <span class="text-xs text-orange-600 dark:text-orange-400">^0.5.16</span>
                            </div>
                            <div class="flex items-center justify-between py-2 px-3 bg-orange-50 dark:bg-orange-900/20 rounded">
                                <span class="text-sm text-gray-700 dark:text-gray-300">laravel-vite-plugin</span>
                                <span class="text-xs text-orange-600 dark:text-orange-400">^1.2.0</span>
                            </div>
                            <div class="flex items-center justify-between py-2 px-3 bg-orange-50 dark:bg-orange-900/20 rounded">
                                <span class="text-sm text-gray-700 dark:text-gray-300">postcss</span>
                                <span class="text-xs text-orange-600 dark:text-orange-400">^8.5.1</span>
                            </div>
                            <div class="flex items-center justify-between py-2 px-3 bg-orange-50 dark:bg-orange-900/20 rounded">
                                <span class="text-sm text-gray-700 dark:text-gray-300">esbuild</span>
                                <span class="text-xs text-orange-600 dark:text-orange-400">^0.24.2</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Template Information -->
        <div class="mb-8">
            <div class="bg-gradient-to-r from-violet-50 to-violet-100 dark:from-violet-900/20 dark:to-violet-800/20 rounded-lg border border-violet-200 dark:border-violet-700 p-6">
                <h3 class="text-lg font-semibold text-violet-800 dark:text-violet-200 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    {{ __('Framework de Componentes Principal') }}
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-white/50 dark:bg-violet-900/30 rounded-lg p-4">
                        <h4 class="font-semibold text-violet-800 dark:text-violet-200 mb-2">{{ __('Mosaic Lite Laravel') }}</h4>
                        <p class="text-sm text-violet-700 dark:text-violet-300 mb-3">{{ __('Template principal de administración desarrollado por Cruip.com') }}</p>
                        <div class="space-y-1">
                            <div class="flex justify-between text-xs">
                                <span class="text-violet-600 dark:text-violet-400">{{ __('Versión') }}:</span>
                                <span class="text-violet-800 dark:text-violet-200 font-medium">4.0.1</span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span class="text-violet-600 dark:text-violet-400">{{ __('Laravel') }}:</span>
                                <span class="text-violet-800 dark:text-violet-200 font-medium">^11.0</span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span class="text-violet-600 dark:text-violet-400">{{ __('Base') }}:</span>
                                <span class="text-violet-800 dark:text-violet-200 font-medium">{{ __('Admin One Vue Tailwind') }}</span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span class="text-violet-600 dark:text-violet-400">{{ __('Stack') }}:</span>
                                <span class="text-violet-800 dark:text-violet-200 font-medium">{{ __('Laravel Jetstream + Livewire') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white/50 dark:bg-violet-900/30 rounded-lg p-4">
                        <h4 class="font-semibold text-violet-800 dark:text-violet-200 mb-2">{{ __('Características') }}</h4>
                        <div class="space-y-1 text-xs text-violet-700 dark:text-violet-300">
                            <div>• 47+ componentes Blade personalizados</div>
                            <div>• Tema oscuro/claro integrado</div>
                            <div>• Sistema de colores personalizado</div>
                            <div>• Componentes responsivos</div>
                            <div>• Integración con Alpine.js</div>
                            <div>• Soporte para TailwindCSS v4</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Blade Components Section -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-6">{{ __('Componentes Blade Personalizados') }}</h2>
            <p class="text-gray-600 dark:text-gray-400 mb-4">{{ __('Componentes desarrollados específicamente para este template') }}</p>
        </div>

        <!-- Components Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- General Components -->
            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">{{ __('Componentes Generales') }}</h3>
                <div class="space-y-2">
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">action-message</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Mensaje de acción</span>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">action-section</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Sección de acción</span>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">button</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Botón básico</span>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">danger-button</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Botón de peligro</span>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">secondary-button</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Botón secundario</span>
                    </div>
                </div>
            </div>

            <!-- Form Components -->
            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">{{ __('Componentes de Formulario') }}</h3>
                <div class="space-y-2">
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">input</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Campo de entrada</span>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">label</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Etiqueta</span>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">input-error</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Error de entrada</span>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">validation-errors</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Errores de validación</span>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">form-section</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Sección de formulario</span>
                    </div>
                </div>
            </div>

            <!-- Navigation Components -->
            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">{{ __('Componentes de Navegación') }}</h3>
                <div class="space-y-2">
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">nav-link</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Enlace de navegación</span>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">responsive-nav-link</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Enlace responsivo</span>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">dropdown</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Menú desplegable</span>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">dropdown-link</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Enlace desplegable</span>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">dropdown-profile</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Perfil desplegable</span>
                    </div>
                </div>
            </div>

            <!-- Modal Components -->
            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">{{ __('Componentes Modales') }}</h3>
                <div class="space-y-2">
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">modal</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Modal básico</span>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">dialog-modal</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Modal de diálogo</span>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">confirmation-modal</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Modal de confirmación</span>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">modal-search</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Modal de búsqueda</span>
                    </div>
                </div>
            </div>

            <!-- Dashboard Components -->
            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">{{ __('Componentes de Dashboard') }}</h3>
                <div class="space-y-2">
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">dashboard-card-01</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Tarjeta Acme Plus</span>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">dashboard-card-02</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Tarjeta Acme Advanced</span>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">dashboard-card-03</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Tarjeta Acme Professional</span>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">dashboard-card-04</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Gráfico de barras</span>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">dashboard-card-05</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Valor en tiempo real</span>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">dashboard-card-06</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Países principales</span>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">dashboard-card-07</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Canales principales</span>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">dashboard-card-08</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Ventas en el tiempo</span>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">dashboard-card-09</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Ventas vs Reembolsos</span>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">dashboard-card-10</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Clientes</span>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">dashboard-card-11</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Razones de reembolso</span>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">dashboard-card-12</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Actividad reciente</span>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">dashboard-card-13</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Ingresos/Gastos</span>
                    </div>
                </div>
            </div>

            <!-- Utility Components -->
            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">{{ __('Componentes de Utilidad') }}</h3>
                <div class="space-y-2">
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">datepicker</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Selector de fecha</span>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">date-select</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Selección de fecha</span>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">dropdown-filter</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Filtro desplegable</span>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">dropdown-help</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Ayuda desplegable</span>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">dropdown-notifications</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Notificaciones</span>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">search-form</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Formulario de búsqueda</span>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">theme-toggle</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Cambio de tema</span>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">switchable-team</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Equipo intercambiable</span>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">confirms-password</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Confirmación de contraseña</span>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">section-border</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Borde de sección</span>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">section-title</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Título de sección</span>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">pagination-classic</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Paginación clásica</span>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">pagination-numeric</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Paginación numérica</span>
                    </div>
                </div>
            </div>

        </div>

    </div>
</x-app-layout>
