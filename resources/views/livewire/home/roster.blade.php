<div>
    <x-layouts.menu-home>
        <div class="bg-gray-100 max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <span class="text-2xl font-semi-bold leading-normal">{{ __('Roster') }}</span>
            <div class="w-full flex mb-4 mt-4">
                <div class="mr-4">
                    <span class="text-s" style="font-size: 0.9em">{{ __('Categoría') }}</span>
                    <select wire:model.live="categoria" style="font-size: 0.9em" class="ml-2 rounded-md border border-primary b-transparent bg-none pl-2 pr-2 py-2 focus:outline-none sm:text-sm text-left">
                        @foreach($categorias as $cat)
                            <option value="{{ $cat->id }}" wire:click="seleccionar_categoria({{ $cat->id }})">{{ $cat->categoria }}</option>
                        @endforeach
                    </select>
                </div>
                <div> 
                    <span class="text-s" style="font-size: 0.9em">{{ __('Torneo') }}</span>
                    <select wire:model.live="torneo" style="font-size: 0.9em" class="ml-2 rounded-md border border-primary b-transparent bg-none pl-2 pr-2 py-2 focus:outline-none sm:text-sm text-left">
                        <option value="">Seleccione</option>
                        @foreach($torneos as $tor)
                            <option value="{{ $tor->id }}">{{ $tor->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div style="overflow-x:auto">
                <table class="w-full mt-4 table bg-white rounded-lg shadow mb-12" style="font-size: 0.8em; overflow-x:auto">
                    <thead>
                        <tr class="fondo-primero text-white">
                            <th class=" p-2" style="cursor:pointer" wire:click="order('nombre_equipo')">
                                {{ __('EQUIPO') }}
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($numeros_temporadas as $temporada)
                            <tr class="text-gray-700 odd:bg-blue-50 even:bg-red-50">
                                <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                    <a style="text-decoration:underline" href="{{ route('lideres-roster', [$temporada->equipo_id, $temporada->categoria_id, $temporada->campeonato_id]) }}"> {{ $temporada->nombre_equipo }}</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </x-layouts.menu-home>
</div>