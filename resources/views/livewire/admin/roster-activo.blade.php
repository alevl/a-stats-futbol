<div>
    <x-layouts.menu-admin>
        <div class="bg-gray-100 max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <span class="text-2xl font-semi-bold leading-normal">{{ $datos_equipo->nombre }}</span>
            <div class="w-full flex mb-4 mt-2">
                <span class="text-2xl font-semi-bold leading-normal mr-2">{{ $datos_equipo->categoria }}</span>
            </div>
            <div class="w-full flex mb-4 mt-2">
                <x-boton-primario wire:click="$set('open_crear', true)">
                    {{ __('Agregar Jugador') }}
                </x-boton-primario>
            </div>
            <div class="col-12" style="overflow-x: auto">
                <div class="w-full">
                    <x-input type="text" wire:model.live="search" class="w-full border border-primary border py-2 rounded focus:outline-none" placeholder="{{ __('Buscar') }}" />
                </div>
                <table class="w-full mt-4 table bg-white rounded-lg shadow mb-12" style="font-size: 0.8em">
                    <thead>
                        <tr>
                            <th class="border-b-2 p-2 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900 text-center" style="cursor:pointer" wire:click="order('id')">
                                {{ __('ID') }}
                                @if($sort == 'id')
                                    @if($direccion == 'asc')
                                        <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                    @else
                                        <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                    @endif
                                @else
                                    <i class="icofont icofont-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th class="border-b-2 p-2 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900 text-center" style="cursor:pointer" wire:click="order('numero')">
                                {{ __('Numero') }}
                                @if($sort == 'numero')
                                    @if($direccion == 'asc')
                                        <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                    @else
                                        <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                    @endif
                                @else
                                    <i class="icofont icofont-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th class="border-b-2 p-2 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900 text-center" style="cursor:pointer" wire:click="order('nombre')">
                                {{ __('Nombre') }}
                                @if($sort == 'nombre')
                                    @if($direccion == 'asc')
                                        <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                    @else
                                        <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                    @endif
                                @else
                                    <i class="icofont icofont-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th class="border-b-2 p-2 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900 text-center" style="cursor:pointer" wire:click="order('nacimiento')">
                                {{ __('Nacimiento') }}
                                @if($sort == 'nacimiento')
                                    @if($direccion == 'asc')
                                        <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                    @else
                                        <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                    @endif
                                @else
                                    <i class="icofont icofont-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th class="border-b-2 p-2 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900 text-center" style="cursor:pointer" wire:click="order('batea')">
                                {{ __('Batea a la') }}
                                @if($sort == 'batea')
                                    @if($direccion == 'asc')
                                        <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                    @else
                                        <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                    @endif
                                @else
                                    <i class="icofont icofont-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th class="border-b-2 p-2 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900 text-center" style="cursor:pointer" wire:click="order('lanza')">
                                {{ __('Lanza a la') }}
                                @if($sort == 'lanza')
                                    @if($direccion == 'asc')
                                        <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                    @else
                                        <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                    @endif
                                @else
                                    <i class="icofont icofont-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th class="border-b-2 p-2 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900 text-center">
                                {{ __('Acción') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jugadores as $datos)
                            <tr class="text-gray-700 odd:bg-blue-50 even:bg-red-50 hover:bg-yellow-200">
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $datos->id }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $datos->numero }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                    {{ $datos->nombre }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $datos->nacimiento }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $datos->batea }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $datos->lanza }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    <a wire:click="edit({{ $datos }})" class="cursor-pointer mr-2" title="{{ __('Editar') }}"><i class="icofont icofont-edit-alt texto-azul" style="font-size: 1.3em"></i></a>

                                    <a wire:click="$dispatch('eliminar', {{ $datos->id }})" class="cursor-pointer" title="{{ __('Eliminar') }}"><i class="icofont icofont-bin texto-rojo" style="font-size: 1.3em"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('equipos-admin') }}" class="inline-flex items-center uppercase justify-center px-4 py-2 border border border-primary rounded font-semibold text-xs tracking-widest hover:text-blue-300 focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150 fondo-segundo text-white mb-6" >
                    Regresar
                </a>    
            </div>
        </div>
        <x-dialog-modal wire:model="open_edit">
            <x-slot name="title">
                {{ __('Jugador') }}
            </x-slot>
            <x-slot name="content">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2 my-2 p-2 rounded">
                    <div class="mb-4">
                        <x-label value="{{ __('Nombre') }}" />
                        <x-input wire:model.defer="nombre" type="text" class="w-full" />
                        <x-input-error for="nombre"/>
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Número') }}" />
                        <x-input wire:model.defer="numero" type="text" class="w-full" />
                        <x-input-error for="numero"/>
                    </div>    
                    <div class="mb-4">
                        <x-label value="{{ __('Nacimiento') }}" />
                        <x-input wire:model.defer="nacimiento" type="text" class="w-full" />
                        <x-input-error for="nacimiento"/>
                    </div>    
                    <div class="mb-4">
                        <x-label value="{{ __('Batea') }}" />
                        <x-input wire:model.defer="batea" type="text" class="w-full" />
                        <x-input-error for="batea"/>
                    </div>    
                    <div class="mb-4">
                        <x-label value="{{ __('Lanza') }}" />
                        <x-input wire:model.defer="lanza" type="text" class="w-full" />
                        <x-input-error for="lanza"/>
                    </div>    
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button wire:click="cerrar_ventana_update">
                    {{ __('Cancelar') }}
                </x-secondary-button>
                <x-boton-primario wire:click="update" wire:loading.attr="disabled" class="disabled:opacity-25 ml-2">
                    {{ __('Actualizar') }}
                </x-boton-primario>
            </x-slot>
        </x-dialog-modal>
        <x-dialog-modal wire:model="open_crear">
            <x-slot name="title">
                {{ __('Jugador') }}
            </x-slot>
            <x-slot name="content">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2 my-2 p-2 rounded">
                    <div class="mb-4">
                        <x-label value="{{ __('Nombre') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="nombre_crear"/>
                        <x-input-error for="nombre_crear"/>
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Número') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="numero_crear"/>
                        <x-input-error for="numero_crear"/>
                    </div>   
                    <div class="mb-4">
                        <x-label value="{{ __('Nacimiento') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="nacimiento_crear"/>
                        <x-input-error for="nacimiento_crear"/>
                    </div>   
                    <div class="mb-4">
                        <x-label value="{{ __('Batea') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="batea_crear"/>
                        <x-input-error for="batea_crear"/>
                    </div>   
                    <div class="mb-4">
                        <x-label value="{{ __('Lanza') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="lanza_crear"/>
                        <x-input-error for="lanza_crear"/>
                    </div>   
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button wire:click="cerrar_ventana_crear">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-boton-primario wire:click="save" wire:loading.attr="disabled" wire:target="save" class="disabled:opacity-25 ml-2">
                    {{ __('Registrar') }}
                </x-boton-primario>
            </x-slot>
        </x-dialog-modal>

        @push('js')
            <script src="sweetalert2.all.min.js"></script>

            <script>
                Livewire.on('eliminar', jugadorId => { 
                        Swal.fire({
                        title: "¿{{ __('Está seguro de eliminar este jugador') }}?",
                        text: "¡{{ __('Esta operación no podrá ser reversada') }}!",
                        icon: 'warning',
                        cancelButtonText: "{{ __('Cancelar') }}",
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "¡{{ __('Si, estoy seguro') }}!"
                    })
                    .then((result) => {
                        if (result.isConfirmed) {
                            @this.call('delete', jugadorId)

                            Swal.fire(
                                '',
                                "{{ __('Jugador eliminado') }}",
                                'success'
                            )
                        }
                    })
                });
            </script>
        @endpush
    </x-layouts.menu-admin>
</div>
