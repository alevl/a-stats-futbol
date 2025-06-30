<div>
    <x-layouts.menu-admin>
        <div class="bg-gray-100 max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <span class="text-2xl font-semi-bold leading-normal">{{ __('Ligas') }}</span>
            <div class="w-full flex mb-4 mt-2">
                <x-boton-primario wire:click="$set('open_crear', true)">
                    {{ __('Crear Liga') }}
                </x-boton-primario>
            </div>
            <div class="col-12" style="overflow-x: auto">
                <div class="w-full">
                    <x-input type="text" wire:model.live="search" class="w-full border border-primary border py-2 rounded focus:outline-none" placeholder="{{ __('Buscar') }}" />
                </div>
                <div class="py-2 flex items-center">
                    <div class="flex items-center">
                        <span class="text-s" style="font-size: 0.9em">{{ __('Mostrar') }}</span>
                        <select wire:model.live="cant" style="font-size: 0.9em" class="ml-2 rounded-md border border-primary b-transparent bg-none pl-2 pr-2 py-2 focus:outline-none sm:text-sm text-center">
                            <option value="50">50</option>
                            <option value="80">80</option>
                            <option value="100">100</option>
                          </select>
                        <span class="ml-2 text-s" style="font-size: 0.9em">{{ __('Registros') }}</span>
                    </div>
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
                            <th class="border-b-2 p-2 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900 text-center" style="cursor:pointer" wire:click="order('liga')">
                                {{ __('Liga') }}
                                @if($sort == 'liga')
                                    @if($direccion == 'asc')
                                        <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                    @else
                                        <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                    @endif
                                @else
                                    <i class="icofont icofont-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th class="border-b-2 p-2 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900 text-center" style="cursor:pointer" wire:click="order('ubicacion')">
                                {{ __('Ubicación') }}
                                @if($sort == 'ubicacion')
                                    @if($direccion == 'asc')
                                        <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                    @else
                                        <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                    @endif
                                @else
                                    <i class="icofont icofont-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th class="border-b-2 p-2 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900 text-center" style="cursor:pointer" wire:click="order('deporte_id')">
                                {{ __('Deporte') }}
                                @if($sort == 'deporte_id')
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
                        @foreach($ligas as $datos)
                            <tr class="text-gray-700 odd:bg-blue-50 even:bg-red-50 hover:bg-yellow-200">
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $datos->id }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $datos->liga }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $datos->ubicacion }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $datos->liga_deporte->deporte }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    <a wire:click="edit({{ $datos }})" class="cursor-pointer" title="{{ __('Editar') }}"><i class="icofont icofont-edit-alt texto-azul" style="font-size: 1.3em"></i></a>

                                    <a wire:click="$dispatch('eliminar', {{ $datos->id }})" class="cursor-pointer" title="{{ __('Eliminar') }}"><i class="icofont icofont-bin texto-rojo" style="font-size: 1.3em"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($ligas->hasPages())
                <div class="px-6 py-3">
                    {{ $ligas->links() }}
                </div>                    
            @endif
        </div>
        <x-dialog-modal wire:model="open_edit">
            <x-slot name="title">
                {{ __('Liga') }}
            </x-slot>
            <x-slot name="content">
                <div class="mb-4">
                    <x-label value="{{ __('Liga') }}" />
                    <x-input wire:model.defer="liga" type="text" class="w-full" />
                    <x-input-error for="liga"/>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2 my-2 p-2 rounded">
                    <div class="mb-4">
                        <x-label value="{{ __('Ubicación') }}" />
                        <x-input wire:model.defer="ubicacion" type="text" class="w-full" />
                        <x-input-error for="ubicacion"/>
                    </div>    
                    <div class="mb-4">
                        <x-label value="{{ __('Deporte') }}" />
                        <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-300 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="deporte_id" >
                            @foreach ($lista_deportes as $deportes)
                                <option value="{{ $deportes->id }}">{{ $deportes->deporte }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="deporte_id" />
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
                {{ __('Liga') }}
            </x-slot>
            <x-slot name="content">
                <div class="mb-4">
                    <x-label value="{{ __('Liga') }}" />
                    <x-input type="text" class="w-full" wire:model.defer="liga_crear"/>
                    <x-input-error for="liga_crear"/>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2 my-2 p-2 rounded">
                    <div class="mb-4">
                        <x-label value="{{ __('Ubicación') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="ubicacion_crear"/>
                        <x-input-error for="ubicacion_crear"/>
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Deporte') }}" />
                        <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="deporte_id_crear" >
                            <option value="">Select...</option>
                            @foreach ($lista_deportes as $deportes)
                                <option value="{{ $deportes->id }}">{{ $deportes->deporte }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="deporte_id_crear" />
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
                Livewire.on('eliminar', ligaId => { 
                        Swal.fire({
                        title: "¿{{ __('Está seguro de eliminar esta liga') }}?",
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
                            @this.call('delete', ligaId)

                            Swal.fire(
                                '',
                                "{{ __('Liga eliminada') }}",
                                'success'
                            )
                        }
                    })
                });
            </script>
        @endpush
    </x-layouts.menu-admin>
</div>
