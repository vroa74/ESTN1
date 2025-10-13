<div>
    {{-- Barra de búsqueda --}}
    <div class="mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Búsqueda por grado --}}
            <div>
                <label for="search_grado" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Buscar por Grado
                </label>
                <select wire:model.live="search_grado" id="search_grado"
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-300">
                    <option value="">Todos los grados</option>
                    <option value="1">1°</option>
                    <option value="2">2°</option>
                    <option value="3">3°</option>
                </select>
            </div>

            {{-- Búsqueda por materia --}}
            <div>
                <label for="search_materia" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Buscar por Materia
                </label>
                <input type="text" wire:model.live.debounce.300ms="search_materia" id="search_materia"
                    placeholder="Escriba el nombre de la materia..."
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-300">
            </div>
        </div>
    </div>

    {{-- Botón para agregar nueva materia --}}
    <div class="mb-6">
        <button wire:click="crear"
            class="bg-violet-600 hover:bg-violet-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                </path>
            </svg>
            Nueva Materia
        </button>
    </div>

    {{-- Tabla de materias --}}
    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Grado
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Materia
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Fecha de Creación
                        </th>
                        <th
                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($materias as $materia)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                {{ $materia->grado }}°
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                {{ $materia->materia }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                {{ $materia->created_at ? $materia->created_at->format('d/m/Y') : 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button wire:click="editar({{ $materia->id }})"
                                    class="inline-flex items-center px-2 py-1 text-violet-600 hover:text-violet-900 dark:text-violet-400 dark:hover:text-violet-300 mr-2"
                                    title="Editar materia">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </button>
                                <button wire:click="eliminar({{ $materia->id }})"
                                    onclick="return confirm('¿Estás seguro de que deseas eliminar esta materia?')"
                                    class="inline-flex items-center px-2 py-1 text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                    title="Eliminar materia">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                No hay materias registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginación personalizada --}}
        @if ($materias->hasPages())
            <div class="mt-4 flex items-center justify-center">
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                    @foreach ($materias->getUrlRange(1, $materias->lastPage()) as $page => $url)
                        @if ($page == $materias->currentPage())
                            <span
                                class="relative inline-flex items-center px-4 py-2 border border-violet-500 bg-violet-50 text-sm font-medium text-violet-600 dark:bg-violet-900 dark:text-violet-300">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                </nav>
            </div>
        @endif
    </div>

    {{-- Modal para crear/editar materia --}}
    @if ($showModal)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50"
            wire:click="cerrarModal">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800"
                wire:click.stop>
                <div class="mt-3">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                        {{ $modalTitle }}
                    </h3>

                    <form wire:submit.prevent="guardar">
                        <div class="mb-4">
                            <label for="grado"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Grado
                            </label>
                            <select wire:model="grado" id="grado"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-300">
                                <option value="">Seleccionar grado</option>
                                <option value="1">1°</option>
                                <option value="2">2°</option>
                                <option value="3">3°</option>
                            </select>
                            @error('grado')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="materia"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Materia
                            </label>
                            <input type="text" wire:model="materia" id="materia"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:text-gray-300"
                                placeholder="Nombre de la materia">
                            @error('materia')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex justify-end space-x-3">
                            <button type="button" wire:click="cerrarModal"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-medium py-2 px-4 rounded-lg transition duration-200">
                                Cancelar
                            </button>
                            <button type="submit"
                                class="bg-violet-600 hover:bg-violet-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                                {{ $isEdit ? 'Actualizar' : 'Guardar' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    {{-- Mensajes de éxito --}}
    @if (session()->has('success'))
        <div class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50"
            x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
            {{ session('success') }}
        </div>
    @endif
</div>
