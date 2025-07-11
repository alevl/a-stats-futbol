<div>
    <x-layouts.menu-home>
        <div class="bg-gray-100 max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <span class="text-2xl font-semi-bold leading-normal">{{ __('Lideres del Equipo') }}</span>
            <div style="overflow-x:auto">
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
                            <th class=" p-2" style="cursor:pointer" wire:click="order('juegos')" title="Juegos Jugados">
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
                            <th class=" p-2" style="cursor:pointer" wire:click="order('goles')" title="Goles">
                                {{ __('GOLES') }}
                                @if($sort == 'goles')
                                    @if($direccion == 'asc')
                                        <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                    @else
                                        <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                    @endif
                                @else
                                    <i class="icofont icofont-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th class=" p-2" style="cursor:pointer" wire:click="order('asistencias')" title="Asistencias">
                                {{ __('ASIS.') }}
                                @if($sort == 'asistencias')
                                    @if($direccion == 'asc')
                                        <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                    @else
                                        <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                    @endif
                                @else
                                    <i class="icofont icofont-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th class=" p-2" style="cursor:pointer" wire:click="order('tiros_arco')" title="Tiros al Arco">
                                {{ __('TIROS') }}
                                @if($sort == 'tiros_arco')
                                    @if($direccion == 'asc')
                                        <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                    @else
                                        <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                    @endif
                                @else
                                    <i class="icofont icofont-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th class=" p-2" style="cursor:pointer" wire:click="order('faltas_cometidas')" title="Faltas Cometidas">
                                {{ __('FC') }}
                                @if($sort == 'faltas_cometidas')
                                    @if($direccion == 'asc')
                                        <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                    @else
                                        <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                    @endif
                                @else
                                    <i class="icofont icofont-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th class=" p-2" style="cursor:pointer" wire:click="order('faltas_recibidas')" title="Faltas Recibidas">
                                {{ __('FR') }}
                                @if($sort == 'faltas_recibidas')
                                    @if($direccion == 'asc')
                                        <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                    @else
                                        <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                    @endif
                                @else
                                    <i class="icofont icofont-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th class=" p-2" style="cursor:pointer" wire:click="order('tarjetas_amarilla')" title="Tarjetas Amarillas">
                                {{ __('TA') }}
                                @if($sort == 'tarjetas_amarilla')
                                    @if($direccion == 'asc')
                                        <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                    @else
                                        <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                    @endif
                                @else
                                    <i class="icofont icofont-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th class=" p-2" style="cursor:pointer" wire:click="order('tarjetas_roja')" title="Tarjetas Rojas">
                                {{ __('TR') }}
                                @if($sort == 'tarjetas_roja')
                                    @if($direccion == 'asc')
                                        <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                    @else
                                        <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                    @endif
                                @else
                                    <i class="icofont icofont-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th class=" p-2" style="cursor:pointer" wire:click="order('penales_cobrados')" title="Penales Cobrados">
                                {{ __('PC') }}
                                @if($sort == 'penales_cobrados')
                                    @if($direccion == 'asc')
                                        <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                    @else
                                        <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                    @endif
                                @else
                                    <i class="icofont icofont-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th class=" p-2" style="cursor:pointer" wire:click="order('penales_fallados')" title="Penales Fallados">
                                {{ __('PF') }}
                                @if($sort == 'penales_fallados')
                                    @if($direccion == 'asc')
                                        <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                    @else
                                        <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                    @endif
                                @else
                                    <i class="icofont icofont-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th class=" p-2" style="cursor:pointer" wire:click="order('fuera_juego')" title="Fuera de Juego">
                                {{ __('OFF') }}
                                @if($sort == 'fuera_juego')
                                    @if($direccion == 'asc')
                                        <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                    @else
                                        <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                    @endif
                                @else
                                    <i class="icofont icofont-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th class=" p-2" style="cursor:pointer" wire:click="order('atajadas')" title="Atajadas">
                                {{ __('ATA') }}
                                @if($sort == 'atajadas')
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
                                    {{ $temporada->goles }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $temporada->asistencias }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $temporada->tiros_arco }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $temporada->faltas_cometidas }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $temporada->faltas_recibidas }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $temporada->tarjetas_amarilla }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $temporada->tarjetas_roja }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $temporada->penales_cobrados }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $temporada->penales_fallados }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $temporada->fuera_juego }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $temporada->atajadas }}
                                </td>
                            </tr>
                            <?php $m=$m+1?>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <a class="inline-flex items-center uppercase justify-center px-4 py-2 border border border-primary rounded font-semibold text-xs tracking-widest hover:text-blue-300 focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150 fondo-segundo text-white mb-6" href="{{ route('roster') }}">
                Regresar
            </a>
        </div>
    </x-layouts.menu-home>
</div>