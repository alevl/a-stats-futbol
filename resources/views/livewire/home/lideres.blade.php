<div>
    <x-layouts.menu-home>
        <div class="bg-gray-100 max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <span class="text-2xl font-semi-bold leading-normal">{{ __('Lideres') }}</span>
            <div class="w-full flex mb-4 mt-4">
                <div class="mr-4">
                    <span class="text-s" style="font-size: 0.9em">{{ __('Categoría') }}</span>
                    <select wire:model.live="categoria" style="font-size: 0.9em" class="ml-2 rounded-md border border-primary b-transparent bg-none pl-2 pr-2 py-2 focus:outline-none sm:text-sm text-left">
                        <option value="0">Seleccione</option>
                        @foreach($categorias as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->categoria }}</option>
                        @endforeach
                    </select>
                </div>
                <div> 
                    <span class="text-s" style="font-size: 0.9em">{{ __('Torneo') }}</span>
                    <select wire:model.live="torneo" style="font-size: 0.9em" class="ml-2 rounded-md border border-primary b-transparent bg-none pl-2 pr-2 py-2 focus:outline-none sm:text-sm text-left" autocomplete="off">
                        <option value="0">Seleccione</option>
                        @foreach($torneos as $tor)
                            <option value="{{ $tor->id }}" >{{ $tor->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <nav x-data="{ open: false }" class="ml-0">
                <div class="flex justify-between h-16">
                    <div class="flex" wire:ignore>
                        <div class="sm:flex">
                            <x-nav-link id="bat" class="cursor-pointer" wire:click="$set('tipo', 'bateador')" onclick="Bat()" style="border-bottom-color: #002f67; color: #002f67">
                                {{ __('Bateadores') }}
                            </x-nav-link>
                        </div>
                        <div class="space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <x-nav-link class="cursor-pointer" wire:click="$set('tipo', 'pitcher')" id="pit" onclick="Pit()" style="border-bottom-color: #cacfd2; color: #cacfd2">
                                {{ __('Pitchers') }}
                            </x-nav-link>
                        </div>
                    </div>
                </div>
            </nav>
            <div style="overflow-x:auto">
                @if ($tipo == "bateador")
                    <table class="w-full mt-4 table bg-white rounded-lg shadow mb-12" style="font-size: 0.8em">
                        <thead>
                            <tr class="fondo-primero text-white">
                                <th class=" p-2 text-center">
                                    {{ __('#') }}
                                </th>
                                <th class=" p-2" style="cursor:pointer" wire:click="order('jugadores.nombre')">
                                    {{ __('JUGADORES') }}
                                    @if($sort == 'jugadores.nombre')
                                        @if($direccion == 'asc')
                                            <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                        @else
                                            <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                        @endif
                                    @else
                                        <i class="icofont icofont-sort float-right mt-1"></i>
                                    @endif
                                </th>
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
                                <th class=" p-2" style="cursor:pointer" wire:click="order('juegos')">
                                    {{ __('J') }}
                                    @if($sort == 'juegos')
                                        @if($direccion == 'asc')
                                            <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                        @else
                                            <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                        @endif
                                    @else
                                        <i class="icofont icofont-sort float-right mt-1"></i>
                                    @endif
                                </th>
                                <th class=" p-2" style="cursor:pointer" wire:click="order('vb')">
                                    {{ __('VB') }}
                                    @if($sort == 'vb')
                                        @if($direccion == 'asc')
                                            <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                        @else
                                            <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                        @endif
                                    @else
                                        <i class="icofont icofont-sort float-right mt-1"></i>
                                    @endif
                                </th>
                                <th class=" p-2" style="cursor:pointer" wire:click="order('anotadas')">
                                    {{ __('CA') }}
                                    @if($sort == 'anotadas')
                                        @if($direccion == 'asc')
                                            <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                        @else
                                            <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                        @endif
                                    @else
                                        <i class="icofont icofont-sort float-right mt-1"></i>
                                    @endif
                                </th>
                                <th class=" p-2" style="cursor:pointer" wire:click="order('hit')">
                                    {{ __('H') }}
                                    @if($sort == 'hit')
                                        @if($direccion == 'asc')
                                            <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                        @else
                                            <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                        @endif
                                    @else
                                        <i class="icofont icofont-sort float-right mt-1"></i>
                                    @endif
                                </th>
                                <th class=" p-2" style="cursor:pointer" wire:click="order('boletos_recibidos')">
                                    {{ __('BB') }}
                                    @if($sort == 'boletos_recibidos')
                                        @if($direccion == 'asc')
                                            <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                        @else
                                            <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                        @endif
                                    @else
                                        <i class="icofont icofont-sort float-right mt-1"></i>
                                    @endif
                                </th>
                                <th class=" p-2" style="cursor:pointer" wire:click="order('sacrificios')">
                                    {{ __('SF') }}
                                    @if($sort == 'sacrificios')
                                        @if($direccion == 'asc')
                                            <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                        @else
                                            <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                        @endif
                                    @else
                                        <i class="icofont icofont-sort float-right mt-1"></i>
                                    @endif
                                </th>
                                <th class=" p-2" style="cursor:pointer" wire:click="order('golpeados')">
                                    {{ __('GP') }}
                                    @if($sort == 'golpeados')
                                        @if($direccion == 'asc')
                                            <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                        @else
                                            <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                        @endif
                                    @else
                                        <i class="icofont icofont-sort float-right mt-1"></i>
                                    @endif
                                </th>
                                <th class=" p-2" style="cursor:pointer" wire:click="order('apariciones')">
                                    {{ __('AL') }}
                                    @if($sort == 'apariciones')
                                        @if($direccion == 'asc')
                                            <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                        @else
                                            <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                        @endif
                                    @else
                                        <i class="icofont icofont-sort float-right mt-1"></i>
                                    @endif
                                </th>
                                <th class=" p-2" style="cursor:pointer" wire:click="order('dobles')">
                                    {{ __('2B') }}
                                    @if($sort == 'dobles')
                                        @if($direccion == 'asc')
                                            <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                        @else
                                            <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                        @endif
                                    @else
                                        <i class="icofont icofont-sort float-right mt-1"></i>
                                    @endif
                                </th>
                                <th class=" p-2" style="cursor:pointer" wire:click="order('triples')">
                                    {{ __('3B') }}
                                    @if($sort == 'triples')
                                        @if($direccion == 'asc')
                                            <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                        @else
                                            <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                        @endif
                                    @else
                                        <i class="icofont icofont-sort float-right mt-1"></i>
                                    @endif
                                </th>
                                <th class=" p-2" style="cursor:pointer" wire:click="order('hr')">
                                    {{ __('HR') }}
                                    @if($sort == 'hr')
                                        @if($direccion == 'asc')
                                            <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                        @else
                                            <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                        @endif
                                    @else
                                        <i class="icofont icofont-sort float-right mt-1"></i>
                                    @endif
                                </th>
                                <th class=" p-2" style="cursor:pointer" wire:click="order('alcanzadas')">
                                    {{ __('BA') }}
                                    @if($sort == 'alcanzadas')
                                        @if($direccion == 'asc')
                                            <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                        @else
                                            <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                        @endif
                                    @else
                                        <i class="icofont icofont-sort float-right mt-1"></i>
                                    @endif
                                </th>
                                <th class=" p-2" style="cursor:pointer" wire:click="order('rbi')">
                                    {{ __('CI') }}
                                    @if($sort == 'rbi')
                                        @if($direccion == 'asc')
                                            <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                        @else
                                            <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                        @endif
                                    @else
                                        <i class="icofont icofont-sort float-right mt-1"></i>
                                    @endif
                                </th>
                                <th class=" p-2" style="cursor:pointer" wire:click="order('robadas')">
                                    {{ __('BR') }}
                                    @if($sort == 'robadas')
                                        @if($direccion == 'asc')
                                            <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                        @else
                                            <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                        @endif
                                    @else
                                        <i class="icofont icofont-sort float-right mt-1"></i>
                                    @endif
                                </th>
                                <th class=" p-2" style="cursor:pointer" wire:click="order('ponches')">
                                    {{ __('K') }}
                                    @if($sort == 'ponches')
                                        @if($direccion == 'asc')
                                            <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                        @else
                                            <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                        @endif
                                    @else
                                        <i class="icofont icofont-sort float-right mt-1"></i>
                                    @endif
                                </th>
                                <th class=" p-2" style="cursor:pointer" wire:click="order('porcentaje_bateo')">
                                    {{ __('AVG') }}
                                    @if($sort == 'porcentaje_bateo')
                                        @if($direccion == 'asc')
                                            <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                        @else
                                            <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                        @endif
                                    @else
                                        <i class="icofont icofont-sort float-right mt-1"></i>
                                    @endif
                                </th>
                                <th class=" p-2" style="cursor:pointer" wire:click="order('porcentaje_slugging')">
                                    {{ __('SLG') }}
                                    @if($sort == 'porcentaje_slugging')
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
                            <?php $m=1?>
                            @foreach($numeros_temporadas as $temporada)
                                <tr class="text-gray-700 odd:bg-blue-50 even:bg-red-50">
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $m }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                        {{ $temporada->jugador }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                        {{ $temporada->nombre_equipo }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->juegos }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->vb }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->anotadas }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->hit }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->boletos_recibidos }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->sacrificios }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->golpeados }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->apariciones }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->dobles }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->triples }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->hr }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->alcanzadas }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->rbi }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->robadas }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->ponches }}
                                    </td>
                                    @if($temporada->vb > 0)
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                            {{ number_format($temporada->porcentaje_bateo,0) }}
                                        </td>
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                            {{ number_format($temporada->porcentaje_slugging,0) }}
                                        </td>
                                    @else
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                            
                                        </td>
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-center">

                                        </td>
                                    @endif
                                </tr>
                                <?php $m=$m+1?>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    @if($tipo == "pitcher")
                        <table class="w-full mt-4 table bg-white rounded-lg shadow mb-12" style="font-size: 0.8em">
                            <thead>
                                <tr class="fondo-primero text-white">
                                    <th class=" p-2 text-center">
                                        {{ __('#') }}
                                    </th>
                                    <th class=" p-2" style="cursor:pointer" wire:click="order('jugadores.nombre')">
                                        {{ __('JUGADORES') }}
                                        @if($sort == 'jugadores.nombre')
                                            @if($direccion == 'asc')
                                                <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                            @else
                                                <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                            @endif
                                        @else
                                            <i class="icofont icofont-sort float-right mt-1"></i>
                                        @endif
                                    </th>
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
                                    <th class=" p-2" style="cursor:pointer" wire:click="order('j')">
                                        {{ __('J') }}
                                        @if($sort == 'j')
                                            @if($direccion == 'asc')
                                                <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                            @else
                                                <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                            @endif
                                        @else
                                            <i class="icofont icofont-sort float-right mt-1"></i>
                                        @endif
                                    </th>
                                    <th class=" p-2" style="cursor:pointer" wire:click="order('iniciados')">
                                        {{ __('I') }}
                                        @if($sort == 'iniciados')
                                            @if($direccion == 'asc')
                                                <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                            @else
                                                <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                            @endif
                                        @else
                                            <i class="icofont icofont-sort float-right mt-1"></i>
                                        @endif
                                    </th>
                                    <th class=" p-2" style="cursor:pointer" wire:click="order('relevos')">
                                        {{ __('R') }}
                                        @if($sort == 'relevos')
                                            @if($direccion == 'asc')
                                                <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                            @else
                                                <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                            @endif
                                        @else
                                            <i class="icofont icofont-sort float-right mt-1"></i>
                                        @endif
                                    </th>
                                    <th class=" p-2" style="cursor:pointer" wire:click="order('completos')">
                                        {{ __('C') }}
                                        @if($sort == 'completos')
                                            @if($direccion == 'asc')
                                                <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                            @else
                                                <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                            @endif
                                        @else
                                            <i class="icofont icofont-sort float-right mt-1"></i>
                                        @endif
                                    </th>
                                    <th class=" p-2" style="cursor:pointer" wire:click="order('ganados')">
                                        {{ __('G') }}
                                        @if($sort == 'ganados')
                                            @if($direccion == 'asc')
                                                <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                            @else
                                                <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                            @endif
                                        @else
                                            <i class="icofont icofont-sort float-right mt-1"></i>
                                        @endif
                                    </th>
                                    <th class=" p-2" style="cursor:pointer" wire:click="order('perdidos')">
                                        {{ __('P') }}
                                        @if($sort == 'perdidosj')
                                            @if($direccion == 'asc')
                                                <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                            @else
                                                <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                            @endif
                                        @else
                                            <i class="icofont icofont-sort float-right mt-1"></i>
                                        @endif
                                    </th>
                                    <th class=" p-2" style="cursor:pointer" wire:click="order('salvados')">
                                        {{ __('SV') }}
                                        @if($sort == 'salvados')
                                            @if($direccion == 'asc')
                                                <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                            @else
                                                <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                            @endif
                                        @else
                                            <i class="icofont icofont-sort float-right mt-1"></i>
                                        @endif
                                    </th>
                                    <th class=" p-2" style="cursor:pointer" wire:click="order('veces_bate')">
                                        {{ __('VB') }}
                                        @if($sort == 'veces_bate')
                                            @if($direccion == 'asc')
                                                <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                            @else
                                                <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                            @endif
                                        @else
                                            <i class="icofont icofont-sort float-right mt-1"></i>
                                        @endif
                                    </th>
                                    <th class=" p-2" style="cursor:pointer" wire:click="order('hp')">
                                        {{ __('HP') }}
                                        @if($sort == 'hp')
                                            @if($direccion == 'asc')
                                                <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                            @else
                                                <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                            @endif
                                        @else
                                            <i class="icofont icofont-sort float-right mt-1"></i>
                                        @endif
                                    </th>
                                    <th class=" p-2" style="cursor:pointer" wire:click="order('h2')">
                                        {{ __('H2') }}
                                        @if($sort == 'h2')
                                            @if($direccion == 'asc')
                                                <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                            @else
                                                <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                            @endif
                                        @else
                                            <i class="icofont icofont-sort float-right mt-1"></i>
                                        @endif
                                    </th>
                                    <th class=" p-2" style="cursor:pointer" wire:click="order('h3')">
                                        {{ __('H3') }}
                                        @if($sort == 'h3')
                                            @if($direccion == 'asc')
                                                <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                            @else
                                                <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                            @endif
                                        @else
                                            <i class="icofont icofont-sort float-right mt-1"></i>
                                        @endif
                                    </th>
                                    <th class=" p-2" style="cursor:pointer" wire:click="order('h4')">
                                        {{ __('HR') }}
                                        @if($sort == 'h4')
                                            @if($direccion == 'asc')
                                                <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                            @else
                                                <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                            @endif
                                        @else
                                            <i class="icofont icofont-sort float-right mt-1"></i>
                                        @endif
                                    </th>
                                    <th class=" p-2" style="cursor:pointer" wire:click="order('ip')">
                                        {{ __('IP') }}
                                        @if($sort == 'ip')
                                            @if($direccion == 'asc')
                                                <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                            @else
                                                <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                            @endif
                                        @else
                                            <i class="icofont icofont-sort float-right mt-1"></i>
                                        @endif
                                    </th>
                                    <th class=" p-2" style="cursor:pointer" wire:click="order('carreras_permitidas')">
                                        {{ __('CP') }}
                                        @if($sort == 'carreras_permitidas')
                                            @if($direccion == 'asc')
                                                <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                            @else
                                                <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                            @endif
                                        @else
                                            <i class="icofont icofont-sort float-right mt-1"></i>
                                        @endif
                                    </th>
                                    <th class=" p-2" style="cursor:pointer" wire:click="order('carreras_limpias')">
                                        {{ __('CL') }}
                                        @if($sort == 'carreras_limpias')
                                            @if($direccion == 'asc')
                                                <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                            @else
                                                <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                            @endif
                                        @else
                                            <i class="icofont icofont-sort float-right mt-1"></i>
                                        @endif
                                    </th>
                                    <th class=" p-2" style="cursor:pointer" wire:click="order('ponches_propinados')">
                                        {{ __('K') }}
                                        @if($sort == 'ponches_propinados')
                                            @if($direccion == 'asc')
                                                <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                            @else
                                                <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                            @endif
                                        @else
                                            <i class="icofont icofont-sort float-right mt-1"></i>
                                        @endif
                                    </th>
                                    <th class=" p-2" style="cursor:pointer" wire:click="order('boletos_otorgados')">
                                        {{ __('BB') }}
                                        @if($sort == 'boletos_otorgados')
                                            @if($direccion == 'asc')
                                                <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                            @else
                                                <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                            @endif
                                        @else
                                            <i class="icofont icofont-sort float-right mt-1"></i>
                                        @endif
                                    </th>
                                    <th class=" p-2" style="cursor:pointer" wire:click="order('gp')">
                                        {{ __('GP') }}
                                        @if($sort == 'gp')
                                            @if($direccion == 'asc')
                                                <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                            @else
                                                <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                            @endif
                                        @else
                                            <i class="icofont icofont-sort float-right mt-1"></i>
                                        @endif
                                    </th>
                                    <th class=" p-2" style="cursor:pointer" wire:click="order('wp')">
                                        {{ __('WP') }}
                                        @if($sort == 'wp')
                                            @if($direccion == 'asc')
                                                <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                            @else
                                                <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                            @endif
                                        @else
                                            <i class="icofont icofont-sort float-right mt-1"></i>
                                        @endif
                                    </th>
                                    <th class=" p-2" style="cursor:pointer" wire:click="order('bk')">
                                        {{ __('B') }}
                                        @if($sort == 'bk')
                                            @if($direccion == 'asc')
                                                <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                            @else
                                                <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                            @endif
                                        @else
                                            <i class="icofont icofont-sort float-right mt-1"></i>
                                        @endif
                                    </th>
                                    <th class=" p-2" style="cursor:pointer" wire:click="order('porcentaje_efectividad')">
                                        {{ __('ERA') }}
                                        @if($sort == 'porcentaje_efectividad')
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
                                <?php $m=1?>
                                @foreach($numeros_temporadas as $temporada)
                                    @if($temporada->ip > 0)
                                        <tr class="text-gray-700 odd:bg-blue-50 even:bg-red-50">
                                            <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                                {{ $m }}
                                            </td>
                                            <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                                {{ $temporada->jugador }}
                                            </td>
                                            <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                                {{ $temporada->nombre_equipo }}
                                            </td>
                                            <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                                {{ $temporada->j }}
                                            </td>
                                            <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                                {{ $temporada->iniciados }}
                                            </td>
                                            <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                                {{ $temporada->relevos }}
                                            </td>
                                            <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                                {{ $temporada->completos }}
                                            </td>
                                            <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                                {{ $temporada->ganados }}
                                            </td>
                                            <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                                {{ $temporada->perdidos }}
                                            </td>
                                            <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                                {{ $temporada->salvados }}
                                            </td>
                                            <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                                {{ $temporada->veces_bate }}
                                            </td>
                                            <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                                {{ $temporada->hp }}
                                            </td>
                                            <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                                {{ $temporada->h2 }}
                                            </td>
                                            <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                                {{ $temporada->h3 }}
                                            </td>
                                            <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                                {{ $temporada->h4 }}
                                            </td>
                                            <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                                {{ $temporada->ip }}
                                            </td>
                                            <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                                {{ $temporada->carreras_permitidas }}
                                            </td>
                                            <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                                {{ $temporada->carreras_limpias }}
                                            </td>
                                            <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                                {{ $temporada->ponches_propinados }}
                                            </td>
                                            <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                                {{ $temporada->boletos_otorgados }}
                                            </td>
                                            <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                                {{ $temporada->gp }}
                                            </td>
                                            <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                                {{ $temporada->wp }}
                                            </td>
                                            <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                                {{ $temporada->bk }}
                                            </td>
                                            <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                                {{ number_format($temporada->porcentaje_efectividad,2) }}
                                            </td>    
                                        </tr>
                                    @endif
                                    <?php $m=$m+1?>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <table class="w-full mt-4 table bg-white rounded-lg shadow mb-12" style="font-size: 0.8em">
                            <thead>
                                <tr class="fondo-primero text-white">
                                    <th class=" p-2 text-center">
                                        {{ __('#') }}
                                    </th>
                                    <th class=" p-2" style="cursor:pointer" wire:click="order2('jugadores.nombre')">
                                        {{ __('JUGADORES') }}
                                        @if($sort2 == 'jugadores.nombre')
                                            @if($direc == 'asc')
                                                <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                            @else
                                                <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                            @endif
                                        @else
                                            <i class="icofont icofont-sort float-right mt-1"></i>
                                        @endif
                                    </th>
                                    <th class=" p-2" style="cursor:pointer" wire:click="order2('nombre_equipo')">
                                        {{ __('EQUIPO') }}
                                        @if($sort2 == 'nombre_equipo')
                                            @if($direc == 'asc')
                                                <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                            @else
                                                <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                            @endif
                                        @else
                                            <i class="icofont icofont-sort float-right mt-1"></i>
                                        @endif
                                    </th>
                                    <th class=" p-2" style="cursor:pointer" wire:click="order2('juegos')">
                                        {{ __('J') }}
                                        @if($sort2 == 'jjuegos')
                                            @if($direc == 'asc')
                                                <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                            @else
                                                <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                            @endif
                                        @else
                                            <i class="icofont icofont-sort float-right mt-1"></i>
                                        @endif
                                    </th>
                                    <th class=" p-2" style="cursor:pointer" wire:click="order2('posicion')">
                                        {{ __('POS') }}
                                        @if($sort2 == 'posicion')
                                            @if($direc == 'asc')
                                                <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                            @else
                                                <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                            @endif
                                        @else
                                            <i class="icofont icofont-sort float-right mt-1"></i>
                                        @endif
                                    </th>
                                    <th class=" p-2" style="cursor:pointer" wire:click="order2('innings')">
                                        {{ __('IJ') }}
                                        @if($sort2 == 'innings')
                                            @if($direc == 'asc')
                                                <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                            @else
                                                <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                            @endif
                                        @else
                                            <i class="icofont icofont-sort float-right mt-1"></i>
                                        @endif
                                    </th>
                                    <th class=" p-2" style="cursor:pointer" wire:click="order2('outs')">
                                        {{ __('O') }}
                                        @if($sort2 == 'outs')
                                            @if($direc == 'asc')
                                                <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                            @else
                                                <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                            @endif
                                        @else
                                            <i class="icofont icofont-sort float-right mt-1"></i>
                                        @endif
                                    </th>
                                    <th class=" p-2" style="cursor:pointer" wire:click="order2('asistencias')">
                                        {{ __('A') }}
                                        @if($sort2 == 'asistencias')
                                            @if($direc == 'asc')
                                                <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                            @else
                                                <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                            @endif
                                        @else
                                            <i class="icofont icofont-sort float-right mt-1"></i>
                                        @endif
                                    </th>
                                    <th class=" p-2" style="cursor:pointer" wire:click="order2('errores')">
                                        {{ __('E') }}
                                        @if($sort2 == 'errores')
                                            @if($direc == 'asc')
                                                <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                            @else
                                                <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                            @endif
                                        @else
                                            <i class="icofont icofont-sort float-right mt-1"></i>
                                        @endif
                                    </th>
                                    <th class=" p-2" style="cursor:pointer" wire:click="order2('porcentaje_defensa')">
                                        {{ __('PORC') }}
                                        @if($sort2 == 'porcentaje_defensa')
                                            @if($direc == 'asc')
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
                                <?php $m=1?>
                                @foreach($numeros_defensiva as $temporada)
                                    @if(($temporada->outs + $temporada->asistencias + $temporada->errores) > 0)
                                        <tr class="text-gray-700 odd:bg-blue-50 even:bg-red-50">
                                            <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                                {{ $m }}
                                            </td>
                                            <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                                {{ $temporada->jugador }}
                                            </td>
                                            <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                                {{ $temporada->nombre_equipo }}
                                            </td>
                                            <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                                {{ $temporada->juegos }}
                                            </td>
                                            <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                                {{ $temporada->posicion }}
                                            </td>
                                            <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                                {{ $temporada->innings }}
                                            </td>
                                            <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                                {{ $temporada->outs }}
                                            </td>
                                            <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                                {{ $temporada->asistencias }}
                                            </td>
                                            <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                                {{ $temporada->errores }}
                                            </td>
                                            <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                                {{ number_format($temporada->porcentaje_defensa,0) }}
                                            </td>
                                        </tr>
                                    @endif
                                    <?php $m=$m+1?>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                @endif
            </div>
        </div>
    </x-layouts.menu-home>
    <script>
        const bat = document.querySelector("#bat")
        const pit = document.querySelector("#pit")
        const def = document.querySelector("#def")

        function Bat() 
        {
            bat.style.color="#002f67";
            pit.style.color="#cacfd2";
            def.style.color="#cacfd2";

            bat.style.borderColor="#002f67";
            pit.style.borderColor="#cacfd2";
            def.style.borderColor="#cacfd2";
        }
        function Pit() 
        {
            bat.style.color="#cacfd2";
            pit.style.color="#002f67";
            def.style.color="#cacfd2";

            bat.style.borderColor="#cacfd2";
            pit.style.borderColor="#002f67";
            def.style.borderColor="#cacfd2";
        }

        function Def() 
        {
            def.style.color="#002f67";
            bat.style.color="#cacfd2";
            pit.style.color="#cacfd2";

            def.style.borderColor="#002f67";
            bat.style.borderColor="#cacfd2";
            pit.style.borderColor="#cacfd2";
        }
    </script>
</div>