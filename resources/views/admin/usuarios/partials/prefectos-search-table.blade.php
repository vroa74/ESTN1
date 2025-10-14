<tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
    @forelse($usuarios as $usuario)
        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors" data-user-id="{{ $usuario->id }}">
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                {{ $usuario->name }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                {{ $usuario->email }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <button type="button"
                    onclick="selectPrefecto({{ $usuario->id }}, '{{ addslashes($usuario->name) }}', '{{ addslashes($usuario->email) }}')"
                    class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 dark:focus:ring-offset-gray-800 transition-colors">
                    {{ __('Seleccionar') }}
                </button>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                {{ __('No se encontraron prefectos.') }}
            </td>
        </tr>
    @endforelse
</tbody>
