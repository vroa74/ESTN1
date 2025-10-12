<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalles del Usuario') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-6">
                    <!-- Header con botones -->
                    <div class="flex justify-between items-center mb-6">
                        <div class="flex items-center space-x-4">
                            @php
                                $profilePhotoUrl = $usuario->profile_photo_path && file_exists(public_path($usuario->profile_photo_path)) 
                                    ? asset($usuario->profile_photo_path) 
                                    : "https://ui-avatars.com/api/?name=" . urlencode($usuario->name) . "&color=7F9CF5&background=EBF4FF&size=64";
                            @endphp
                            <img class="h-16 w-16 rounded-full object-cover" 
                                 src="{{ $profilePhotoUrl }}" 
                                 alt="{{ $usuario->name }}">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ $usuario->name }}
                                </h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $usuario->email }}
                                </p>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('usuarios.edit', $usuario) }}" 
                               class="inline-flex items-center px-3 py-2 text-xs font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md transition-colors">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                {{ __('Editar') }}
                            </a>
                            <a href="{{ route('usuarios.index') }}" 
                               class="inline-flex items-center px-3 py-2 text-xs font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-md transition-colors">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                {{ __('Volver') }}
                            </a>
                        </div>
                    </div>

                    <!-- Información del usuario -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Información Personal -->
                        <div class="space-y-4">
                            <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100 border-b border-gray-200 dark:border-gray-700 pb-2">
                                {{ __('Información Personal') }}
                            </h4>
                            
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">
                                        {{ __('Nombre completo') }}
                                    </label>
                                    <p class="text-sm text-gray-900 dark:text-gray-100 mt-1">
                                        {{ $usuario->name }}
                                    </p>
                                </div>

                                <div>
                                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">
                                        {{ __('Email') }}
                                    </label>
                                    <p class="text-sm text-gray-900 dark:text-gray-100 mt-1">
                                        {{ $usuario->email }}
                                    </p>
                                </div>

                                @if($usuario->rfc)
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">
                                        {{ __('RFC') }}
                                    </label>
                                    <p class="text-sm text-gray-900 dark:text-gray-100 mt-1">
                                        {{ $usuario->rfc }}
                                    </p>
                                </div>
                                @endif

                                @if($usuario->curp)
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">
                                        {{ __('CURP') }}
                                    </label>
                                    <p class="text-sm text-gray-900 dark:text-gray-100 mt-1">
                                        {{ $usuario->curp }}
                                    </p>
                                </div>
                                @endif

                                @if($usuario->sexo)
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">
                                        {{ __('Sexo') }}
                                    </label>
                                    <p class="text-sm text-gray-900 dark:text-gray-100 mt-1">
                                        {{ ucfirst($usuario->sexo) }}
                                    </p>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Información Laboral -->
                        <div class="space-y-4">
                            <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100 border-b border-gray-200 dark:border-gray-700 pb-2">
                                {{ __('Información Laboral') }}
                            </h4>
                            
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">
                                        {{ __('Puesto') }}
                                    </label>
                                    <p class="text-sm text-gray-900 dark:text-gray-100 mt-1">
                                        {{ $usuario->puesto ?? 'Sin asignar' }}
                                    </p>
                                </div>

                                <div>
                                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">
                                        {{ __('Nivel de acceso') }}
                                    </label>
                                    <div class="mt-1">
                                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full
                                            @if($usuario->nivel <= 2) bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                                            @elseif($usuario->nivel <= 4) bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                            @else bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 @endif">
                                            Nivel {{ $usuario->nivel }}
                                        </span>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">
                                        {{ __('Estado') }}
                                    </label>
                                    <div class="mt-1">
                                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full
                                            @if($usuario->estatus) bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                            @else bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 @endif">
                                            {{ $usuario->estatus ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">
                                        {{ __('Tema preferido') }}
                                    </label>
                                    <div class="mt-1">
                                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full
                                            @if($usuario->theme == 'dark') bg-gray-800 text-white
                                            @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200 @endif">
                                            {{ $usuario->theme == 'dark' ? 'Oscuro' : 'Claro' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Información del Sistema -->
                    <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100 border-b border-gray-200 dark:border-gray-700 pb-2 mb-4">
                            {{ __('Información del Sistema') }}
                        </h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">
                                    {{ __('Fecha de registro') }}
                                </label>
                                <p class="text-sm text-gray-900 dark:text-gray-100 mt-1">
                                    {{ $usuario->created_at->format('d/m/Y H:i') }}
                                </p>
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">
                                    {{ __('Última actualización') }}
                                </label>
                                <p class="text-sm text-gray-900 dark:text-gray-100 mt-1">
                                    {{ $usuario->updated_at->format('d/m/Y H:i') }}
                                </p>
                            </div>

                            @if($usuario->email_verified_at)
                            <div>
                                <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">
                                    {{ __('Email verificado') }}
                                </label>
                                <p class="text-sm text-gray-900 dark:text-gray-100 mt-1">
                                    {{ $usuario->email_verified_at->format('d/m/Y H:i') }}
                                </p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
