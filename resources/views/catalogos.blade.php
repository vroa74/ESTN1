<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Catálogos') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                        {{ __('Gestión de Catálogos') }}
                    </h3>

                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                        {{ __('Administra los catálogos del sistema como materias, grados y otros elementos de configuración.') }}
                    </p>

                    {{-- Tabs para diferentes catálogos --}}
                    <div class="mb-6">
                        <nav class="flex space-x-8" aria-label="Tabs">
                            <button
                                class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm border-violet-500 text-violet-600 dark:text-violet-400">
                                {{ __('Materias') }}
                            </button>
                            <!-- Aquí se pueden agregar más tabs para otros catálogos -->
                        </nav>
                    </div>

                    {{-- Componente Livewire de Materias --}}
                    @livewire('catalogos-materias')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
