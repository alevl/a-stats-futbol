<div>
    <x-layouts.menu-admin>
        <div class="bg-gray-100 max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <span class="text-2xl font-semi-bold leading-normal">{{ __('Jugadores') }}</span>
            <div class="w-full flex mb-4 mt-2">
                <x-boton-primario wire:click="$set('open_consolidar', true)">
                    {{ __('Consolidar Jugador') }}
                </x-boton-primario>
            </div>
            <div class="col-12" style="overflow-x: auto">
                <div class="w-full mt-2">
                    <x-input type="text" wire:model.live="search" class="w-full border border-primary border py-2 rounded focus:outline-none" placeholder="{{ __('Buscar') }}" />
                </div>
                <div class="py-2 flex items-center">
                    <div class="flex items-center">
                        <span class="text-s" style="font-size: 0.9em">{{ __('Mostrar') }}</span>
                        <select wire:model.live="cant" style="font-size: 0.9em" class="ml-2 rounded-md border border-primary b-transparent bg-none pl-2 pr-2 py-2 focus:outline-none sm:text-sm text-center">
                            <option value="100">100</option>
                            <option value="200">200</option>
                            <option value="500">500</option>
                          </select>
                        <span class="ml-2 text-s" style="font-size: 0.9em">{{ __('Registros') }}</span>
                    </div>
                </div>
                <table class="w-full mt-4 table bg-white rounded-lg shadow mb-12" style="font-size: 0.8em">
                    <thead>
                        <tr>
                            <th class="border-b-2 p-2 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900 text-center" style="cursor:pointer" wire:click="order('id_jugador')">
                                {{ __('ID') }}
                                @if($sort == 'id_jugador')
                                    @if($direccion == 'asc')
                                        <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                    @else
                                        <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                    @endif
                                @else
                                    <i class="icofont icofont-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th class="border-b-2 p-2 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900 text-center" style="cursor:pointer" wire:click="order('nombre_jugador')">
                                {{ __('Nombre') }}
                                @if($sort == 'nombre_jugador')
                                    @if($direccion == 'asc')
                                        <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                    @else
                                        <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                    @endif
                                @else
                                    <i class="icofont icofont-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th class="border-b-2 p-2 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900 text-center" style="cursor:pointer" wire:click="order('nombre_equipo')">
                                {{ __('Equipo') }}
                                @if($sort == 'nombre_equipo')
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
                                {{ __('Categoria') }}
                                @if($sort == 'equipo_id')
                                    @if($direccion == 'asc')
                                        <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                    @else
                                        <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                    @endif
                                @else
                                    <i class="icofont icofont-sort float-right mt-1"></i>
                                @endif
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jugadores as $datos)
                            <tr class="text-gray-700 odd:bg-blue-50 even:bg-red-50">
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $datos->id_jugador }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                    <a href="{{ route('jugador-numeritos-admin', [$datos->id_jugador]) }}" style="text-decoration:underline">{{ $datos->nombre_jugador }}</a>
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $datos->nombre_equipo }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $datos->categoria }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($jugadores->hasPages())
                <div class="px-6 py-3">
                    {{ $jugadores->links() }}
                </div>                    
            @endif
        </div>
        <x-dialog-modal wire:model="open_consolidar">
            <x-slot name="title">
                {{ __('Consolidar Jugador') }}
            </x-slot>
            <x-slot name="content">
                <div class="mb-0">
                    <x-label value="{{ __('Jugador Origen') }}" />
                    <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model='jugador_origen'>
                        <option value="">Seleccione</option>
                        @foreach($lista_jugadores as $jugador)
                            <option value="{{ $jugador->id }}">{{ $jugador->id." // ".$jugador->nombre }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="jugador_origen" />
                </div>
                <div class="mb-0">
                    <x-label value="{{ __('Jugador Destino') }}" />
                    <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model='jugador_destino'>
                        <option value="">Seleccione</option>
                        @foreach($lista_jugadores as $jugador)
                            <option value="{{ $jugador->id }}">{{ $jugador->id." // ".$jugador->nombre }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="jugador_destino" />
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button wire:click="$set('open_consolidar', false)">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-boton-primario wire:click="consolidar" wire:loading.attr="disabled" wire:target="consolidar" class="disabled:opacity-25 ml-2">
                    {{ __('Consolidar') }}
                </x-boton-primario>
            </x-slot>
        </x-dialog-modal>
    </x-layouts.menu-admin>
</div>
