<div>
    <x-layouts.menu-admin>
        <div class="bg-gray-100 max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <span class="text-2xl font-semi-bold leading-normal">{{ __('Perfil') }}</span>

            <div class="bg-white rounded shadow p-4 mt-6" >
                <div class="flex flex-wrap -mb-6 mt-6">
                    <h4 class="text-lg font-semibold mb-6 texto-azul">{{ __('Información Personal') }}</h4>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 my-4 p-2 rounded">
                    <div class="mb-4">
                        <x-label value="{{ __('Usuario') }}" />
                        <x-input wire:model.defer="username" type="text" class="w-full" disabled />
                        <x-input-error for="username"/>
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Nombre y Apellido') }}" />
                        <x-input wire:model.defer="name" type="text" class="w-full" />
                        <x-input-error for="name"/>
                    </div>
                </div>
                <x-boton-primario wire:click="actualizar" wire:loading.attr="disabled" class="disabled:opacity-25 ml-2 bg-primary text-white p-2 mb-6">
                    {{ __('Actualizar Información') }}
                </x-boton-primario>
            </div>

            <div class="bg-white rounded shadow p-4 mt-6" >
                <div class="flex flex-wrap -mb-6 mt-4">
                    <h4 class="text-lg font-semibold mb-6 texto-azul">{{ __('Cambiar Password') }}</h4>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 my-4 p-2 rounded">
                    <div class="mb-4">
                        <x-label value="{{ __('Password') }}" />
                        <x-input wire:model.defer="password1" type="password" class="w-full" />
                        <x-input-error for="password1"/>
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Confirmar Password') }}" />
                        <x-input wire:model.defer="password2" type="password" class="w-full" />
                        <x-input-error for="password2"/>
                    </div>
                </div>
                <x-boton-primario wire:click="actualizar_clave" wire:loading.attr="disabled" class="disabled:opacity-25 ml-2 bg-primary text-white p-2">
                    {{ __('Actualizar Password') }}
                </x-boton-primario>
            </div>
        </div>
    </x-layouts.menu-admin>
</div>