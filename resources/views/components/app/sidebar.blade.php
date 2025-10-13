<div class="min-w-fit">
    <!-- Sidebar backdrop (mobile only) -->
    <div class="fixed inset-0 bg-gray-900/30 z-40 lg:hidden lg:z-auto transition-opacity duration-200"
        :class="sidebarOpen ? 'opacity-100' : 'opacity-0 pointer-events-none'" aria-hidden="true" x-cloak></div>

    <!-- Sidebar -->
    <div id="sidebar"
        class="flex lg:flex! flex-col absolute z-40 left-0 top-0 lg:static lg:left-auto lg:top-auto lg:translate-x-0 h-[100dvh] overflow-y-scroll lg:overflow-y-auto no-scrollbar w-48 lg:w-16 lg:sidebar-expanded:!w-48 2xl:w-48! shrink-0 bg-white dark:bg-gray-800 p-3 transition-all duration-200 ease-in-out {{ $variant === 'v2' ? 'border-r border-gray-200 dark:border-gray-700/60' : 'rounded-r-2xl shadow-xs' }}"
        :class="sidebarOpen ? 'max-lg:translate-x-0' : 'max-lg:-translate-x-48'" @click.outside="sidebarOpen = false"
        @keydown.escape.window="sidebarOpen = false">

        <!-- Sidebar header -->
        <div class="flex flex-col items-center mb-8 px-3">
            <!-- Close button -->
            <button class="lg:hidden text-gray-500 hover:text-gray-400 self-end mb-4"
                @click.stop="sidebarOpen = !sidebarOpen" aria-controls="sidebar" :aria-expanded="sidebarOpen">
                <span class="sr-only">{{ __('Close sidebar') }}</span>
                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.7 18.7l1.4-1.4L7.8 13H20v-2H7.8l4.3-4.3-1.4-1.4L4 12z" />
                </svg>
            </button>
            <!-- Logo -->
            <a class="block flex items-center justify-center w-16 h-16 rounded-xl transition-all duration-200 hover:scale-105"
                href="{{ route('dashboard') }}">
                <img src="{{ asset('images/LOGO_TECNICAS_vectorized.png') }}" alt="Logo"
                    class="w-full h-full object-contain">
            </a>
            <!-- Logo text (hidden when collapsed) -->

            <div
                class="lg:opacity-0 lg:sidebar-expanded:opacity-100 dark:text-green-300 light:text-green-700  2xl:opacity-100 transition-opacity duration-200 mt-2">
                {{-- <span class="text-sm font-semibold text-gray-800 dark:text-gray-100">Admin One</span> --}}
            </div>
        </div>

        <!-- Links -->
        <div class="space-y-8">
            <!-- Pages group -->
            <div>
                <h3 class="text-xs uppercase text-gray-400 dark:text-gray-500 font-semibold pl-3">
                    <span class="hidden lg:block lg:sidebar-expanded:hidden 2xl:hidden text-center w-6"
                        aria-hidden="true">•••</span>
                    <span class="lg:hidden lg:sidebar-expanded:block 2xl:block">{{ __('Pages') }}</span>
                </h3>
                <ul class="mt-3">
                    <!-- Dashboard -->
                    <li
                        class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0 bg-linear-to-r @if (Route::is('dashboard')) {{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }} @endif">
                        <a class="block text-gray-800 dark:text-gray-100 truncate transition @if (!Route::is('dashboard')) {{ 'hover:text-gray-900 dark:hover:text-white' }} @endif"
                            href="{{ route('dashboard') }}">
                            <div class="flex items-center">
                                <svg class="shrink-0 fill-current @if (Route::is('dashboard')) {{ 'text-violet-500' }}@else{{ 'text-gray-400 dark:text-gray-500' }} @endif"
                                    xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M5.936.278A7.983 7.983 0 0 1 8 0a8 8 0 1 1-8 8c0-.722.104-1.413.278-2.064a1 1 0 1 1 1.932.516A5.99 5.99 0 0 0 2 8a6 6 0 1 0 6-6c-.53 0-1.045.076-1.548.21A1 1 0 1 1 5.936.278Z" />
                                    <path
                                        d="M6.068 7.482A2.003 2.003 0 0 0 8 10a2 2 0 1 0-.518-3.932L3.707 2.293a1 1 0 0 0-1.414 1.414l3.775 3.775Z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">{{ __('Dashboard') }}</span>
                            </div>
                        </a>
                    </li>
                    <!-- Usuarios -->
                    <li
                        class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0 bg-linear-to-r @if (Route::is('usuarios*')) {{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }} @endif">
                        <a class="block text-gray-800 dark:text-gray-100 truncate transition @if (!Route::is('usuarios*')) {{ 'hover:text-gray-900 dark:hover:text-white' }} @endif"
                            href="{{ route('usuarios.index') }}">
                            <div class="flex items-center">
                                <svg class="shrink-0 fill-current @if (Route::is('usuarios*')) {{ 'text-violet-500' }}@else{{ 'text-gray-400 dark:text-gray-500' }} @endif"
                                    xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002A.274.274 0 0 1 15 13H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">{{ __('Usuarios') }}</span>
                            </div>
                        </a>
                    </li>
                    <!-- Estudiantes -->
                    <li
                        class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0 bg-linear-to-r @if (Route::is('estudiante*')) {{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }} @endif">
                        <a class="block text-gray-800 dark:text-gray-100 truncate transition @if (!Route::is('estudiante*')) {{ 'hover:text-gray-900 dark:hover:text-white' }} @endif"
                            href="{{ route('estudiante.index') }}">
                            <div class="flex items-center">
                                <svg class="shrink-0 fill-current @if (Route::is('estudiante*')) {{ 'text-violet-500' }}@else{{ 'text-gray-400 dark:text-gray-500' }} @endif"
                                    xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M8 0a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm0 5.5a2 2 0 1 1 0-4 2 2 0 0 1 0 4ZM2 15.5c0-2.761 2.239-5 5-5h2c2.761 0 5 2.239 5 5v.5H2v-.5Z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">{{ __('Estudiantes') }}</span>
                            </div>
                        </a>
                    </li>

                    <!-- Reportes -->
                    <li
                        class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0 bg-linear-to-r @if (Route::is('reportes*')) {{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }} @endif">
                        <a class="block text-gray-800 dark:text-gray-100 truncate transition @if (!Route::is('reportes*')) {{ 'hover:text-gray-900 dark:hover:text-white' }} @endif"
                            href="{{ route('reportes.index') }}">
                            <div class="flex items-center">
                                <svg class="shrink-0 fill-current @if (Route::is('reportes*')) {{ 'text-violet-500' }}@else{{ 'text-gray-400 dark:text-gray-500' }} @endif"
                                    xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M3 0a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1H3zm1 1h8v14H4V1zm2 2h4v1H6V3zm0 2h4v1H6V5zm0 2h4v1H6V7zm0 2h4v1H6V9zm0 2h4v1H6v-1zm0 2h4v1H6v-1z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">{{ __('Reportes') }}</span>
                            </div>
                        </a>
                    </li>

                    <!-- Materias -->
                    <li
                        class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0 bg-linear-to-r @if (Route::is('materias*')) from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04] @endif">
                        <a class="block text-gray-800 dark:text-gray-100 truncate transition @if (!Route::is('materias*')) hover:text-gray-900 dark:hover:text-white @endif"
                            href="{{ route('materias.index') }}">
                            <div class="flex items-center">
                                <svg class="shrink-0 fill-current @if (Route::is('materias*')) text-violet-500 @else text-gray-400 dark:text-gray-500 @endif"
                                    xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M2 3a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H2zm0 3a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H2zm2 2h8v4H4V8z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Materias</span>
                            </div>
                        </a>
                    </li>
                    <!-- QR -->
                    <li
                        class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0 bg-linear-to-r @if (Route::is('qr')) {{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }} @endif">
                        <a class="block text-gray-800 dark:text-gray-100 truncate transition @if (!Route::is('qr')) {{ 'hover:text-gray-900 dark:hover:text-white' }} @endif"
                            href="{{ route('qr') }}">
                            <div class="flex items-center">
                                <svg class="shrink-0 fill-current @if (Route::is('qr')) {{ 'text-violet-500' }}@else{{ 'text-gray-400 dark:text-gray-500' }} @endif"
                                    xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M0 0h6v6H0V0zm1 1v4h4V1H1zm9-1h6v6h-6V0zm1 1v4h4V1h-4zM0 10h6v6H0v-6zm1 1v4h4v-4H1zm2 1h2v2H3v-2zM2 2h2v2H2V2zm10 0h2v2h-2V2zM7 7h2v2H7V7zm3 0h2v2h-2V7zm0 3h2v2h-2v-2zm-3 0h2v2H7v-2zm0 3h2v2H7v-2zm3 0h2v2h-2v-2z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">{{ __('QR') }}</span>
                            </div>
                        </a>
                    </li>
                    <!-- Componentes -->
                    <li
                        class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0 bg-linear-to-r @if (Route::is('components')) {{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }} @endif">
                        <a class="block text-gray-800 dark:text-gray-100 truncate transition @if (!Route::is('components')) {{ 'hover:text-gray-900 dark:hover:text-white' }} @endif"
                            href="{{ route('components') }}">
                            <div class="flex items-center">
                                <svg class="shrink-0 fill-current @if (Route::is('components')) {{ 'text-violet-500' }}@else{{ 'text-gray-400 dark:text-gray-500' }} @endif"
                                    xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M.06 10.003a1 1 0 0 1 1.948.455c-.019.08.01.152.078.19l5.83 3.333c.053.03.116.03.168 0l5.83-3.333a.163.163 0 0 0 .078-.188 1 1 0 0 1 1.947-.459 2.161 2.161 0 0 1-1.032 2.384l-5.83 3.331a2.168 2.168 0 0 1-2.154 0l-5.83-3.331a2.162 2.162 0 0 1-1.032-2.382Zm7.856-7.981-5.83 3.332a.17.17 0 0 0 0 .295l5.828 3.33c.054.031.118.031.17.002l5.83-3.333a.17.17 0 0 0 0-.294L8.085 2.023a.172.172 0 0 0-.17-.001ZM9.076.285l5.83 3.332c1.458.833 1.458 2.935 0 3.768l-5.83 3.333c-.667.38-1.485.38-2.153-.001l-5.83-3.332c-1.457-.833-1.457-2.935 0-3.767L6.925.285a2.173 2.173 0 0 1 2.15 0Z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">{{ __('Componentes') }}</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Expand / collapse button -->
        <div class="pt-3 hidden lg:inline-flex 2xl:hidden justify-end mt-auto">
            <div class="w-12 pl-4 pr-3 py-2">
                <button
                    class="text-gray-400 hover:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400 transition-colors"
                    @click="sidebarExpanded = !sidebarExpanded">
                    <span class="sr-only">{{ __('Expand / collapse sidebar') }}</span>
                    <svg class="shrink-0 fill-current text-gray-400 dark:text-gray-500 sidebar-expanded:rotate-180"
                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                        <path
                            d="M15 16a1 1 0 0 1-1-1V1a1 1 0 1 1 2 0v14a1 1 0 0 1-1 1ZM8.586 7H1a1 1 0 1 0 0 2h7.586l-2.793 2.793a1 1 0 1 0 1.414 1.414l4.5-4.5A.997.997 0 0 0 12 8.01M11.924 7.617a.997.997 0 0 0-.217-.324l-4.5-4.5a1 1 0 0 0-1.414 1.414L8.586 7M12 7.99a.996.996 0 0 0-.076-.373Z" />
                    </svg>
                </button>
            </div>
        </div>

    </div>
</div>
