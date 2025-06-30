<div>
    <x-layouts.menu-admin>
        <div class="bg-gray-100 max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <span class="text-2xl font-semi-bold leading-normal">{{ __('Juegos por Anotadores') }}</span>
            <div class="w-full flex mb-4 mt-4">
                <div class="mr-4">
                    <span class="text-s" style="font-size: 0.9em">{{ __('Categoría') }}</span>
                    <select wire:model.live="anotador_id" style="font-size: 0.9em" class="ml-2 rounded-md border border-primary b-transparent bg-none pl-2 pr-2 py-2 focus:outline-none sm:text-sm text-left">
                        <option value="0">Todos</option>
                        @foreach($lista_anotadores as $anot)
                            <option value="{{ $anot->id }}">{{ $anot->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div> 
                    <span class="text-s" style="font-size: 0.9em">{{ __('Juegos Cobrado') }}</span>
                    <select wire:model.live="estatus_id" style="font-size: 0.9em" class="ml-2 rounded-md border border-primary b-transparent bg-none pl-2 pr-2 py-2 focus:outline-none sm:text-sm text-left">
                        <option value="0">Todos</option>
                        @foreach($lista_condiciones as $esta)
                            <option value="{{ $esta->id }}">{{ $esta->condicion }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12" style="overflow-x: auto">
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
                            <th class="border-b-2 p-2 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900 text-center" style="cursor:pointer" wire:click="order('fecha_juego')">
                                {{ __('Fecha') }}
                                @if($sort == 'fecha_juego')
                                    @if($direccion == 'asc')
                                        <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                    @else
                                        <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                    @endif
                                @else
                                    <i class="icofont icofont-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th class="border-b-2 p-2 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900 text-center" style="cursor:pointer" wire:click="order('numero_juego')">
                                {{ __('# Juego') }}
                                @if($sort == 'numero_juego')
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
                            <th class="border-b-2 p-2 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900 text-center" style="cursor:pointer" wire:click="order('visita_id')">
                                {{ __('Visitante') }}
                                @if($sort == 'visita_id')
                                    @if($direccion == 'asc')
                                        <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                    @else
                                        <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                    @endif
                                @else
                                    <i class="icofont icofont-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th class="border-b-2 p-2 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900 text-center" style="cursor:pointer" wire:click="order('casa_id')">
                                {{ __('Home Club') }}
                                @if($sort == 'casa_id')
                                    @if($direccion == 'asc')
                                        <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                    @else
                                        <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                    @endif
                                @else
                                    <i class="icofont icofont-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th class="border-b-2 p-2 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900 text-center" style="cursor:pointer" wire:click="order('anotador_id')">
                                {{ __('Anotador') }}
                                @if($sort == 'anotador_id')
                                    @if($direccion == 'asc')
                                        <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                    @else
                                        <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                    @endif
                                @else
                                    <i class="icofont icofont-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th class="border-b-2 p-2 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900 text-center" style="cursor:pointer" wire:click="order('facturado_id')">
                                {{ __('¿Cobrado?') }}
                                @if($sort == 'facturado_id')
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
                                {{ __('Editar') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($juegos as $datos)
                            <tr class="text-gray-700 odd:bg-blue-50 even:bg-red-50 hover:bg-yellow-200">
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $datos->id }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $datos->fecha_juego }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $datos->numero_juego }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $datos->calendario_categoria->categoria }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $datos->calendario_torneo->nombre }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $datos->calendario_visita->nombre }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $datos->calendario_casa->nombre }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $datos->calendario_anotador->nombre }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $datos->calendario_facturado->condicion }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    <a wire:click="edit({{ $datos }})" class="cursor-pointer"><i class="icofont icofont-edit-alt texto-azul" style="font-size: 1.3em"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <x-dialog-modal wire:model="open_edit">
            <x-slot name="title">
                {{ __('Juego') }}
            </x-slot>
            <x-slot name="content">
                <div class="mb-4">
                    <x-label value="{{ __('Juego Cobrado') }}" />
                    <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="facturado_id" >
                        @foreach ($lista_condiciones as $dato)
                            <option value="{{ $dato->id }}">{{ $dato->condicion }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="facturado_id" />
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button wire:click="$set('open_edit', false)">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-boton-primario wire:click="update" wire:loading.attr="disabled" wire:target="save" class="disabled:opacity-25 ml-2">
                    {{ __('Registrar') }}
                </x-boton-primario>
            </x-slot>
        </x-dialog-modal>
    </x-layouts.menu-admin>
</div>
