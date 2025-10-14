@forelse($materias as $materia)
    <tr data-materia="{{ $materia->materia }}">
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
            {{ $materia->materia }}
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
            <button type="button" onclick="selectMateria('{{ addslashes($materia->materia) }}')"
                class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-white bg-violet-600 hover:bg-violet-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-violet-500 dark:focus:ring-offset-gray-800 transition-colors">
                {{ __('Seleccionar') }}
            </button>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="2" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
            {{ __('No se encontraron materias con los criterios de búsqueda.') }}
        </td>
    </tr>
@endforelse
