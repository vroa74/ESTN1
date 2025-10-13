<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Reporte de Alumno') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('reportes.store') }}" method="POST">
                        @csrf

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
                                        class="hidden mb-3 p-3 bg-violet-50 dark:bg-violet-900/20 border border-violet-200 dark:border-violet-800 rounded-md">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="text-sm font-medium text-violet-900 dark:text-violet-100"
                                                    id="student-name"></p>
                                                <p class="text-xs text-violet-700 dark:text-violet-300"
                                                    id="student-info"></p>
                                            </div>
                                            <button type="button" onclick="clearSelectedStudent()"
                                                class="text-violet-500 hover:text-violet-700 dark:text-violet-400 dark:hover:text-violet-200">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Botón para abrir modal -->
                                    <button type="button" id="select-student-btn" onclick="openStudentModal()"
                                        class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-100 text-left bg-white hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <span
                                            class="text-gray-500 dark:text-gray-400">{{ __('Hacer clic para seleccionar estudiante') }}</span>
                                    </button>

                                    <input type="hidden" id="student_id" name="student_id"
                                        value="{{ old('student_id') }}">
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
                                        value="{{ old('fecha_reporte', date('Y-m-d')) }}"
                                        class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-100">
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
                                        class="hidden mb-3 p-3 bg-violet-50 dark:bg-violet-900/20 border border-violet-200 dark:border-violet-800 rounded-md">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="text-sm font-medium text-violet-900 dark:text-violet-100"
                                                    id="materia-name"></p>
                                                <p class="text-xs text-violet-700 dark:text-violet-300"
                                                    id="materia-info"></p>
                                            </div>
                                            <button type="button" onclick="clearSelectedMateria()"
                                                class="text-violet-500 hover:text-violet-700 dark:text-violet-400 dark:hover:text-violet-200">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Botón para abrir modal -->
                                    <button type="button" id="select-materia-btn" onclick="openMateriaModal()"
                                        class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-100 text-left bg-white hover:bg-gray-50 dark:hover:bg-gray-600"
                                        disabled>
                                        <span
                                            class="text-gray-500 dark:text-gray-400">{{ __('Primero selecciona un estudiante') }}</span>
                                    </button>

                                    <input type="hidden" id="materia" name="materia" value="{{ old('materia') }}">
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
                                                {{ old('profesor_id') == $profesor->id ? 'selected' : '' }}>
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
                                    class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-100">{{ old('descripcion_reporte') }}</textarea>
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
                                <textarea id="observaciones" name="observaciones" rows="4"
                                    placeholder="Observaciones adicionales (opcional)..."
                                    class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-100">{{ old('observaciones') }}</textarea>
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
                            <a href="{{ route('reportes.index') }}"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-md transition-colors">
                                {{ __('Cancelar') }}
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-violet-600 hover:bg-violet-700 rounded-md transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                {{ __('Crear Reporte') }}
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
            class="relative top-20 mx-auto p-5 border w-11/12 max-w-4xl shadow-lg rounded-md bg-white dark:bg-gray-800">
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

                <!-- Filtros -->
                <div class="mb-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            {{ __('Buscar por nombre') }}
                        </label>
                        <input type="text" id="search-name" placeholder="Nombre del estudiante..."
                            class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-100">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            {{ __('Grado') }}
                        </label>
                        <select id="search-grado"
                            class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-100">
                            <option value="">{{ __('Todos los grados') }}</option>
                            <option value="1">1°</option>
                            <option value="2">2°</option>
                            <option value="3">3°</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            {{ __('Grupo') }}
                        </label>
                        <select id="search-grupo"
                            class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-100">
                            <option value="">{{ __('Todos los grupos') }}</option>
                            @foreach (['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L'] as $g)
                                <option value="{{ $g }}">{{ $g }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Tabla de estudiantes -->
                <div class="max-h-96 overflow-y-auto border border-gray-200 dark:border-gray-600 rounded-md">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('Matrícula') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('Nombre') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('Grado') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('Grupo') }}
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

                <!-- Información del estudiante seleccionado -->
                <div id="student-info-modal"
                    class="mb-4 p-3 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-md">
                    <p class="text-sm font-medium text-blue-900 dark:text-blue-100">
                        {{ __('Mostrando materias para el grado:') }} <span id="student-grado-modal"></span>
                    </p>
                </div>

                <!-- Filtros -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        {{ __('Buscar materia') }}
                    </label>
                    <input type="text" id="search-materia" placeholder="Nombre de la materia..."
                        class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-100">
                </div>

                <!-- Tabla de materias -->
                <div class="max-h-96 overflow-y-auto border border-gray-200 dark:border-gray-600 rounded-md">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('Grado') }}
                                </th>
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

    <script>
        let selectedStudent = null;

        function openStudentModal() {
            document.getElementById('student-modal').classList.remove('hidden');
            loadStudents();
        }

        function closeStudentModal() {
            document.getElementById('student-modal').classList.add('hidden');
        }

        function loadStudents() {
            const name = document.getElementById('search-name').value;
            const grado = document.getElementById('search-grado').value;
            const grupo = document.getElementById('search-grupo').value;

            const params = new URLSearchParams({
                nombre: name,
                grado: grado,
                grupo: grupo
            });

            // Mostrar loading
            document.getElementById('students-table-body').innerHTML = `
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                        <div class="flex items-center justify-center">
                            <svg class="animate-spin h-5 w-5 text-violet-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Cargando estudiantes...
                        </div>
                    </td>
                </tr>
            `;

            fetch(`{{ route('estudiante.index') }}?${params.toString()}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'text/html'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    console.log('HTML recibido:', html); // Debug
                    // Extraer solo el tbody de la respuesta
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const tbody = doc.querySelector('tbody');
                    console.log('Tbody encontrado:', tbody); // Debug

                    if (tbody) {
                        // Convertir los enlaces de acciones a botones de selección
                        const rows = tbody.querySelectorAll('tr');
                        rows.forEach(row => {
                            const actionCell = row.querySelector('td:last-child');
                            if (actionCell) {
                                const studentId = row.getAttribute('data-student-id');
                                if (studentId) {
                                    actionCell.innerHTML = `
                                    <button type="button" onclick="selectStudent(${studentId})"
                                        class="bg-violet-600 hover:bg-violet-700 text-white px-3 py-1 rounded text-xs">
                                        Seleccionar
                                    </button>
                                `;
                                }
                            }
                        });
                        document.getElementById('students-table-body').innerHTML = tbody.innerHTML;
                    } else {
                        // Si no encuentra estudiantes, mostrar mensaje
                        document.getElementById('students-table-body').innerHTML = `
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                    No se encontraron estudiantes con los filtros aplicados.
                                </td>
                            </tr>
                        `;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('students-table-body').innerHTML = `
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-sm text-red-500">
                                Error al cargar los estudiantes. Inténtalo de nuevo.
                            </td>
                        </tr>
                    `;
                });
        }

        function selectStudent(studentId) {
            // Encontrar la fila del estudiante para obtener sus datos
            const row = document.querySelector(`[data-student-id="${studentId}"]`);
            if (row) {
                const cells = row.querySelectorAll('td');
                // Estructura de la tabla: [0] Matrícula, [1] Nombre, [2] Grado, [3] Grupo
                const matricula = cells[0]?.textContent?.trim();
                const nombre = cells[1]?.textContent?.trim();
                const grado = cells[2]?.textContent?.trim();
                const grupo = cells[3]?.textContent?.trim();

                selectedStudent = {
                    id: studentId,
                    matricula: matricula,
                    nombre: nombre,
                    grado: grado,
                    grupo: grupo
                };

                // Actualizar la UI
                document.getElementById('student_id').value = studentId;
                document.getElementById('student-name').textContent = `${nombre} (${matricula})`;
                document.getElementById('student-info').textContent = `${grado}° - Grupo ${grupo}`;
                document.getElementById('selected-student').classList.remove('hidden');
                document.getElementById('select-student-btn').style.display = 'none';

                // Habilitar el botón de materia
                const materiaBtn = document.getElementById('select-materia-btn');
                materiaBtn.disabled = false;
                materiaBtn.querySelector('span').textContent = 'Hacer clic para seleccionar materia';

                closeStudentModal();
            }
        }

        function clearSelectedStudent() {
            selectedStudent = null;
            document.getElementById('student_id').value = '';
            document.getElementById('selected-student').classList.add('hidden');
            document.getElementById('select-student-btn').style.display = 'block';

            // Deshabilitar el botón de materia
            const materiaBtn = document.getElementById('select-materia-btn');
            materiaBtn.disabled = true;
            materiaBtn.querySelector('span').textContent = 'Primero selecciona un estudiante';

            // Limpiar también la materia seleccionada
            clearSelectedMateria();
        }

        // Variables para materias
        let selectedMateria = null;

        function openMateriaModal() {
            if (!selectedStudent) {
                alert('Primero debes seleccionar un estudiante');
                return;
            }

            document.getElementById('student-grado-modal').textContent = selectedStudent.grado + '°';
            document.getElementById('materia-modal').classList.remove('hidden');
            loadMaterias();
        }

        function closeMateriaModal() {
            document.getElementById('materia-modal').classList.add('hidden');
        }

        function loadMaterias() {
            const searchTerm = document.getElementById('search-materia').value;
            const grado = selectedStudent ? selectedStudent.grado : null;

            if (!grado) {
                document.getElementById('materias-table-body').innerHTML = `
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center text-sm text-red-500">
                            Error: No se ha seleccionado un estudiante.
                        </td>
                    </tr>
                `;
                return;
            }

            // Mostrar loading
            document.getElementById('materias-table-body').innerHTML = `
                <tr>
                    <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                        <div class="flex items-center justify-center">
                            <svg class="animate-spin h-5 w-5 text-violet-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Cargando materias...
                        </div>
                    </td>
                </tr>
            `;

            const params = new URLSearchParams({
                grado: grado,
                materia: searchTerm
            });

            fetch(`{{ route('materias.search') }}?${params.toString()}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    const tbody = document.getElementById('materias-table-body');

                    if (data.materias && data.materias.length > 0) {
                        let html = '';
                        data.materias.forEach(materia => {
                            html += `
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    ${materia.grado}°
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    ${materia.materia}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    <button type="button" onclick="selectMateria('${materia.materia}', ${materia.grado})"
                                        class="bg-violet-600 hover:bg-violet-700 text-white px-3 py-1 rounded text-xs">
                                        Seleccionar
                                    </button>
                                </td>
                            </tr>
                        `;
                        });
                        tbody.innerHTML = html;
                    } else {
                        tbody.innerHTML = `
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                No se encontraron materias para el grado ${grado}°.
                            </td>
                        </tr>
                    `;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('materias-table-body').innerHTML = `
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center text-sm text-red-500">
                            Error al cargar las materias. Inténtalo de nuevo.
                        </td>
                    </tr>
                `;
                });
        }

        function selectMateria(materiaNombre, grado) {
            selectedMateria = {
                nombre: materiaNombre,
                grado: grado
            };

            // Actualizar la UI
            document.getElementById('materia').value = materiaNombre;
            document.getElementById('materia-name').textContent = materiaNombre;
            document.getElementById('materia-info').textContent = `Grado ${grado}°`;
            document.getElementById('selected-materia').classList.remove('hidden');
            document.getElementById('select-materia-btn').style.display = 'none';

            closeMateriaModal();
        }

        function clearSelectedMateria() {
            selectedMateria = null;
            document.getElementById('materia').value = '';
            document.getElementById('selected-materia').classList.add('hidden');
            document.getElementById('select-materia-btn').style.display = 'block';
        }

        // Event listeners para los filtros
        document.getElementById('search-name').addEventListener('input', loadStudents);
        document.getElementById('search-grado').addEventListener('change', loadStudents);
        document.getElementById('search-grupo').addEventListener('change', loadStudents);
        document.getElementById('search-materia').addEventListener('input', loadMaterias);

        // Cerrar modal al hacer clic fuera de él
        document.getElementById('student-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeStudentModal();
            }
        });
    </script>
</x-app-layout>
