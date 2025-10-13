<tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
    @forelse($usuarios as $usuario)
        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                {{ $usuario->name }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                {{ $usuario->email }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                {{ $usuario->puesto ?? 'N/A' }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <button type="button"
                    onclick="selectUsuarioDirect({{ $usuario->id }}, '{{ $usuario->name }}', '{{ $usuario->email }}', '{{ $usuario->puesto ?? 'N/A' }}')"
                    class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-white bg-violet-600 hover:bg-violet-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-violet-500 dark:focus:ring-offset-gray-800 transition-colors">
                    {{ __('Seleccionar') }}
                </button>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                {{ __('No se encontraron usuarios.') }}
            </td>
        </tr>
    @endforelse
</tbody>
