<!-- ARCHIVO PARTIAL TABLE - VERSIÓN CON CAMPO SEXO -->
<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                <th
                    class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    {{ __('Matrícula') }}
                </th>
                <th
                    class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    {{ __('Nombre Completo') }}
                </th>
                <th
                    class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    {{ __('Grado') }}
                </th>
                <th
                    class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    {{ __('Grupo') }}
                </th>
                <th
                    class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    {{ __('Email') }}
                </th>
                <th
                    class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    SEXO
                </th>
                <th
                    class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    {{ __('Estatus') }}
                </th>
                <th
                    class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    {{ __('Acciones') }}
                </th>
            </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($students as $student)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
                    data-student-id="{{ $student->id }}">
                    <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-900 dark:text-gray-100">
                        {{ $student->matricula ?? 'N/A' }}
                    </td>
                    <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-900 dark:text-gray-100">
                        {{ $student->full_name }}
                    </td>
                    <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-900 dark:text-gray-100">
                        {{ $student->grado ?? 'N/A' }}
                    </td>
                    <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-900 dark:text-gray-100">
                        {{ $student->grupo }}
                    </td>
                    <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-900 dark:text-gray-100">
                        {{ $student->email ?? 'N/A' }}
                    </td>
                    <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-900 dark:text-gray-100">
                        <button
                            class="toggle-sexo-btn px-2 py-1 rounded-full text-xs font-medium transition-colors duration-200 hover:opacity-80 cursor-pointer
                                {{ $student->sexo == 'F' ? 'bg-pink-100 text-pink-800 dark:bg-pink-900/30 dark:text-pink-400' : 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400' }}"
                            data-student-id="{{ $student->id }}" data-current-sexo="{{ $student->sexo }}"
                            onclick="toggleSexo({{ $student->id }})">
                            {{ $student->sexo == 'F' ? 'Femenino' : 'Masculino' }}
                        </button>
                    </td>
                    <td class="px-3 py-2 whitespace-nowrap text-xs">
                        @php
                            $estatusColors = [
                                'activo' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
                                'inactivo' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-400',
                                'egresado' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
                                'baja' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400',
                            ];
                        @endphp
                        <span
                            class="px-2 py-1 rounded-full text-xs font-medium {{ $estatusColors[$student->estatus] ?? $estatusColors['inactivo'] }}">
                            {{ ucfirst($student->estatus) }}
                        </span>
                    </td>
                    <td class="px-3 py-2 whitespace-nowrap text-xs">
                        <div class="flex space-x-1">
                            <a href="{{ route('estudiante.show', $student) }}"
                                class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300"
                                title="Ver">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                            </a>
                            <a href="{{ route('estudiante.edit', $student) }}"
                                class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300"
                                title="Editar">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                            </a>
                            <form action="{{ route('estudiante.destroy', $student) }}" method="POST"
                                class="inline-block"
                                onsubmit="return confirm('¿Estás seguro de eliminar este estudiante?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                    title="Eliminar">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="px-3 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                        No hay estudiantes registrados.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Paginación -->
@if ($students->hasPages())
    <div class="mt-4">
        {{ $students->links() }}
    </div>
@endif

<script>
    function toggleSexo(studentId) {
        // Encontrar el botón que se hizo clic
        const button = document.querySelector(`button[data-student-id="${studentId}"]`);

        if (!button) return;

        // Deshabilitar el botón temporalmente
        button.disabled = true;
        button.classList.add('opacity-50');

        // Obtener el token CSRF
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Hacer la petición AJAX
        fetch(`/estudiante/${studentId}/toggle-sexo`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Actualizar el botón con el nuevo valor
                    button.textContent = data.sexo_text;

                    // Actualizar las clases CSS según el nuevo sexo
                    button.classList.remove('bg-pink-100', 'text-pink-800', 'dark:bg-pink-900/30',
                        'dark:text-pink-400');
                    button.classList.remove('bg-blue-100', 'text-blue-800', 'dark:bg-blue-900/30',
                        'dark:text-blue-400');

                    if (data.sexo === 'F') {
                        button.classList.add('bg-pink-100', 'text-pink-800', 'dark:bg-pink-900/30',
                            'dark:text-pink-400');
                    } else {
                        button.classList.add('bg-blue-100', 'text-blue-800', 'dark:bg-blue-900/30',
                            'dark:text-blue-400');
                    }

                    // Actualizar el atributo data
                    button.setAttribute('data-current-sexo', data.sexo);

                    // Mostrar mensaje de éxito (opcional)
                    console.log('Sexo actualizado exitosamente');
                } else {
                    alert('Error al actualizar el sexo: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al actualizar el sexo');
            })
            .finally(() => {
                // Rehabilitar el botón
                button.disabled = false;
                button.classList.remove('opacity-50');
            });
    }
</script>
