<div>
    <x-layouts.menu-admin>
        <div class="bg-gray-100 max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <span class="text-2xl font-semi-bold leading-normal">{{ __('Equipos') }}</span>
            <div class="w-full flex mb-4 mt-2">
                <x-boton-primario wire:click="$set('open_crear', true)">
                    {{ __('Crear Equipo') }}
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
                            <th class="border-b-2 p-2 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900 text-center" style="cursor:pointer" wire:click="order('abreviacion')">
                                {{ __('Abreviación') }}
                                @if($sort == 'abreviacion')
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
                            <th class="border-b-2 p-2 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900 text-center" style="cursor:pointer" wire:click="order('liga_id')">
                                {{ __('Liga') }}
                                @if($sort == 'liga_id')
                                    @if($direccion == 'asc')
                                        <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                    @else
                                        <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                    @endif
                                @else
                                    <i class="icofont icofont-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th class="border-b-2 p-2 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900 text-center" style="cursor:pointer" wire:click="order('campeonato_id')">
                                {{ __('Torneo') }}
                                @if($sort == 'campeonato_id')
                                    @if($direccion == 'asc')
                                        <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                    @else
                                        <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                    @endif
                                @else
                                    <i class="icofont icofont-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th class="border-b-2 p-2 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900 text-center" style="cursor:pointer" wire:click="order('categoria_id')">
                                {{ __('Categoría') }}
                                @if($sort == 'categoria_id')
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
                        @foreach($equipos as $datos)
                            <tr class="text-gray-700 odd:bg-blue-50 even:bg-red-50 hover:bg-yellow-200">
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $datos->id }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                    {{ $datos->nombre }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $datos->abreviacion }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $datos->equipo_deporte->deporte }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $datos->equipo_liga->liga }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $datos->equipo_torneo->nombre }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $datos->equipo_categoria->categoria }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    <a href="{{ route('roster-activo', $datos->id) }}" class="cursor-pointer" title="{{ __('Roster') }}"><i class="icofont icofont-list texto-verde mr-2" style="font-size: 1.3em"></i></a>

                                    <a wire:click="edit({{ $datos }})" class="cursor-pointer" title="{{ __('Editar') }}"><i class="icofont icofont-edit-alt texto-azul mr-2" style="font-size: 1.3em"></i></a>

                                    <a wire:click="$dispatch('eliminar', {{ $datos->id }})" class="cursor-pointer" title="{{ __('Eliminar') }}"><i class="icofont icofont-bin texto-rojo" style="font-size: 1.3em"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($equipos->hasPages())
                <div class="px-6 py-3">
                    {{ $equipos->links() }}
                </div>                    
            @endif
        </div>
        <x-dialog-modal wire:model="open_edit">
            <x-slot name="title">
                {{ __('Equipo') }}
            </x-slot>
            <x-slot name="content">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2 my-2 p-2 rounded">
                    <div class="mb-4">
                        <x-label value="{{ __('Nombre') }}" />
                        <x-input wire:model.defer="nombre" type="text" class="w-full" />
                        <x-input-error for="nombre"/>
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Abreviación') }}" />
                        <x-input wire:model.defer="abreviacion" type="text" class="w-full" />
                        <x-input-error for="abreviacion"/>
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
                    <div class="mb-4">
                        <x-label value="{{ __('Liga') }}" />
                        <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-300 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="liga_id" >
                            @foreach ($lista_ligas as $ligas)
                                <option value="{{ $ligas->id }}">{{ $ligas->liga }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="liga_id" />
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Torneo') }}" />
                        <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-300 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="campeonato_id" >
                            @foreach ($lista_torneos as $torneo)
                                <option value="{{ $torneo->id }}">{{ $torneo->nombre }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="campeonato_id" />
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Categoría') }}" />
                        <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-300 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="categoria_id" >
                            @foreach ($lista_categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="categoria_id" />
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
                {{ __('Equipo') }}
            </x-slot>
            <x-slot name="content">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2 my-2 p-2 rounded">
                    <div class="mb-4">
                        <x-label value="{{ __('Nombre') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="nombre_crear"/>
                        <x-input-error for="nombre_crear"/>
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Abreviación') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="abreviacion_crear"/>
                        <x-input-error for="abreviacion_crear"/>
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
                    <div class="mb-4">
                        <x-label value="{{ __('Liga') }}" />
                        <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="liga_id_crear" >
                            <option value="">Select...</option>
                            @foreach ($lista_ligas as $ligas)
                                <option value="{{ $ligas->id }}">{{ $ligas->liga }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="liga_id_crear" />
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Torneo') }}" />
                        <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="campeonato_id_crear" >
                            <option value="">Select...</option>
                            @foreach ($lista_torneos as $torneo)
                                <option value="{{ $torneo->id }}">{{ $torneo->nombre }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="campeonato_id_crear" />
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Categoría') }}" />
                        <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="categoria_id_crear" >
                            <option value="">Select...</option>
                            @foreach ($lista_categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="categoria_id_crear" />
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
                Livewire.on('eliminar', equipoId => { 
                        Swal.fire({
                        title: "¿{{ __('Está seguro de eliminar este equipo') }}?",
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
                            @this.call('delete', equipoId)

                            Swal.fire(
                                '',
                                "{{ __('Equipo eliminado') }}",
                                'success'
                            )
                        }
                    })
                });
            </script>
        @endpush
    </x-layouts.menu-admin>
</div>
