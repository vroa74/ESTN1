<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestión de Estudiantes') }}
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

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg" x-data="{
                matricula: '{{ request('matricula') }}',
                nombre: '{{ request('nombre') }}',
                grado: '{{ request('grado') }}',
                grupo: '{{ request('grupo') }}',
                email: '{{ request('email') }}',
                loading: false,
                filterStudents() {
                    this.loading = true;
                    const params = new URLSearchParams({
                        matricula: this.matricula,
                        nombre: this.nombre,
                        grado: this.grado,
                        grupo: this.grupo,
                        email: this.email
                    });
            
                    fetch('{{ route('estudiante.index') }}?' + params.toString(), {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'text/html'
                            }
                        })
                        .then(response => response.text())
                        .then(html => {
                            document.getElementById('students-table').innerHTML = html;
                            this.loading = false;
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            this.loading = false;
                        });
                }
            }"
                x-init="$watch('matricula', () => filterStudents());
                $watch('nombre', () => filterStudents());
                $watch('grado', () => filterStudents());
                $watch('grupo', () => filterStudents());
                $watch('email', () => filterStudents());">
                <div class="p-4 sm:p-6">
                    <!-- Header con botón crear -->
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Lista de Estudiantes') }}
                        </h3>
                        <a href="{{ route('estudiante.create') }}"
                            class="inline-flex items-center px-3 py-2 text-xs font-medium text-white bg-violet-600 hover:bg-violet-700 rounded-md transition-colors">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"></path>
                            </svg>
                            {{ __('Crear Estudiante') }}
                        </a>
                    </div>

                    <!-- Filtros -->
                    <div class="mb-4 grid grid-cols-1 md:grid-cols-5 gap-3">
                        <!-- Filtro Matrícula -->
                        <div>
                            <input type="text" x-model.debounce.500ms="matricula"
                                placeholder="Buscar por matrícula..."
                                class="w-full px-3 py-2 text-xs border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-violet-500 dark:focus:border-violet-600 focus:ring-violet-500 dark:focus:ring-violet-600 rounded-md shadow-sm">
                        </div>

                        <!-- Filtro Nombre -->
                        <div>
                            <input type="text" x-model.debounce.500ms="nombre" placeholder="Buscar por nombre..."
                                class="w-full px-3 py-2 text-xs border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-violet-500 dark:focus:border-violet-600 focus:ring-violet-500 dark:focus:ring-violet-600 rounded-md shadow-sm">
                        </div>

                        <!-- Filtro Grado -->
                        <div>
                            <select x-model="grado"
                                class="w-full px-3 py-2 text-xs border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-violet-500 dark:focus:border-violet-600 focus:ring-violet-500 dark:focus:ring-violet-600 rounded-md shadow-sm">
                                <option value="">Todos los grados</option>
                                @for ($i = 1; $i <= 9; $i++)
                                    <option value="{{ $i }}">{{ $i }}°</option>
                                @endfor
                            </select>
                        </div>

                        <!-- Filtro Grupo -->
                        <div>
                            <select x-model="grupo"
                                class="w-full px-3 py-2 text-xs border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-violet-500 dark:focus:border-violet-600 focus:ring-violet-500 dark:focus:ring-violet-600 rounded-md shadow-sm">
                                <option value="">Todos los grupos</option>
                                @foreach (['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L'] as $g)
                                    <option value="{{ $g }}">{{ $g }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Filtro Email -->
                        <div>
                            <input type="text" x-model.debounce.500ms="email" placeholder="Buscar por email..."
                                class="w-full px-3 py-2 text-xs border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-violet-500 dark:focus:border-violet-600 focus:ring-violet-500 dark:focus:ring-violet-600 rounded-md shadow-sm">
                        </div>
                    </div>

                    <!-- Loading indicator -->
                    <div x-show="loading" class="mb-4">
                        <div class="flex items-center justify-center py-2">
                            <svg class="animate-spin h-5 w-5 text-violet-600" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                        </path>
                                                    </svg>
                            <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Buscando...</span>
                                            </div>
                    </div>

                    <!-- Tabla de estudiantes -->
                    <div id="students-table">
                        @include('admin.students.partials.table', ['students' => $students])
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
