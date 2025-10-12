<div>
    <x-form-section submit="updateAdditionalInformation">
        <x-slot name="title">
            {{ __('Additional Information') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Update your additional profile information.') }}
        </x-slot>

        <x-slot name="form">
            <!-- RFC -->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="rfc" value="{{ __('RFC') }}" />
                <x-input id="rfc" type="text" class="mt-1 block w-full" wire:model.live="state.rfc" maxlength="14" placeholder="ABCD123456EFG" />
                <x-input-error for="rfc" class="mt-2" />
            </div>

            <!-- CURP -->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="curp" value="{{ __('CURP') }}" />
                <x-input id="curp" type="text" class="mt-1 block w-full" wire:model.live="state.curp" maxlength="22" placeholder="ABCD123456HDFGHG01" />
                <x-input-error for="curp" class="mt-2" />
            </div>

            <!-- Sexo -->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="sexo" value="{{ __('Gender') }}" />
                <select id="sexo" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-violet-500 dark:focus:border-violet-600 focus:ring-violet-500 dark:focus:ring-violet-600 rounded-md shadow-sm" wire:model.live="state.sexo">
                    <option value="">{{ __('Select gender') }}</option>
                    <option value="masculino">{{ __('Male') }}</option>
                    <option value="femenino">{{ __('Female') }}</option>
                </select>
                <x-input-error for="sexo" class="mt-2" />
            </div>

            <!-- Puesto -->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="puesto" value="{{ __('Position') }}" />
                <select id="puesto" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-violet-500 dark:focus:border-violet-600 focus:ring-violet-500 dark:focus:ring-violet-600 rounded-md shadow-sm" wire:model.live="state.puesto">
                    <option value="">{{ __('Select position') }}</option>
                    <option value="Director">{{ __('Director') }}</option>
                    <option value="Subdirector">{{ __('Subdirector') }}</option>
                    <option value="Coordinador">{{ __('Coordinador') }}</option>
                    <option value="Jefe de departamento">{{ __('Jefe de departamento') }}</option>
                    <option value="Analista Especializado">{{ __('Analista Especializado') }}</option>
                    <option value="Analista">{{ __('Analista') }}</option>
                </select>
                <x-input-error for="puesto" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-action-message class="me-3" on="saved">
                {{ __('Saved.') }}
            </x-action-message>

            <x-button wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-form-section>
</div>
