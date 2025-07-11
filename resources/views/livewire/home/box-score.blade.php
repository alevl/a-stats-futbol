<div>
    <x-layouts.menu-home>
        <div class="bg-gray-100 max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <span class="text-2xl font-semi-bold leading-normal">{{ __('Resumen del Juego') }}</span>
            <div class="w-full flex mb-4 mt-2">
                <span class="text-2xl font-semi-bold leading-normal mr-2">{{ $datos_juego->nombre_visita." VS ".$datos_juego->nombre_casa }}</span>
            </div>
            <nav x-data="{ open: false }" class="ml-0">
                <div class="flex justify-between h-16">
                    <div class="flex" wire:ignore>
                        <div class="sm:flex">
                            <x-nav-link id="bat" class="cursor-pointer" wire:click="$set('tipo', 'bateador')" onclick="Bat()" style="border-bottom-color: #002f67; color: #002f67">
                                {{ $datos_juego->nombre_visita }}
                            </x-nav-link>
                        </div>
                        <div class="space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <x-nav-link class="cursor-pointer" wire:click="$set('tipo', 'pitcher')" id="pit" onclick="Pit()" style="border-bottom-color: #cacfd2; color: #cacfd2">
                                {{ $datos_juego->nombre_casa }}
                            </x-nav-link>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="col-12" style="overflow-x: auto">
                @if ($tipo == "bateador")
                    <span class="text-2xl font-semi-bold leading-normal">{{ __('') }}</span>
                    <table class="w-full mt-4 table bg-white rounded-lg shadow mb-12" style="font-size: 0.8em">
                        <thead>
                            <tr class="fondo-primero text-white">
                                <th class=" p-2">Jugadores</th>
                                <th class=" p-2" title="Posición">POS</th>
                                <th class=" p-2" title="Goles">GOLES</th>
                                <th class=" p-2" title="Asistencias">ASIS.</th>
                                <th class=" p-2" title="Tiros al Arco">TIROS</th>
                                <th class=" p-2" title="Faltas Cometidas">FC</th>
                                <th class=" p-2" title="Faltas Recibidas">FR</th>
                                <th class=" p-2" title="Tarjetas Amarillas">TA</th>
                                <th class=" p-2" title="Tarjetas Rojas">TR</th>
                                <th class=" p-2" title="Penales Cobrados">PC</th>
                                <th class=" p-2" title="Penales Fallidos">PF</th>
                                <th class=" p-2" title="Fuera de Juego">OFF</th>
                                <th class=" p-2" title="Atajadas">ATA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total_goles=0;
                            $total_asistencias=0;
                            $total_tiros=0;
                            $total_faltasc=0;
                            $total_faltasr=0;
                            $total_tarjetasa=0;
                            $total_tarjetasr=0;
                            $total_penalesc=0;
                            $total_penalesf=0;
                            $total_fuera=0;
                            $total_atajadas=0;
                            ?>
                            @foreach($bateo_visita as $temporada)
                                <tr class="text-gray-700 odd:bg-blue-50 even:bg-red-50 hover:bg-yellow-200">
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                        {{ $temporada->jugador }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->posicion }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        @if($temporada->goles > 0)
                                            {{ $temporada->goles }}
                                        @endif
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        @if($temporada->asistencias > 0)
                                            {{ $temporada->asistencias }}
                                        @endif
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        @if($temporada->tiro_arco > 0)
                                            {{ $temporada->tiro_arco }}
                                        @endif
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        @if($temporada->faltas_cometidas > 0)
                                            {{ $temporada->faltas_cometidas }}
                                        @endif
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        @if($temporada->faltas_recibidas > 0)
                                            {{ $temporada->faltas_recibidas }}
                                        @endif
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        @if($temporada->tarjetas_amarilla > 0)
                                            {{ $temporada->tarjetas_amarilla }}
                                        @endif
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        @if($temporada->tarjetas_roja > 0)
                                            {{ $temporada->tarjetas_roja }}
                                        @endif
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        @if($temporada->penales_cobrados > 0)
                                            {{ $temporada->penales_cobrado }}
                                        @endif
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        @if($temporada->penales_fallados > 0)
                                            {{ $temporada->penales_fallados }}
                                        @endif
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        @if($temporada->fuera_juego > 0)
                                            {{ $temporada->fuera_juego }}
                                        @endif
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        @if($temporada->atajadas > 0)
                                            {{ $temporada->atajadas }}
                                        @endif
                                    </td>
                                </tr>
                                <?php
                                $total_goles=$total_goles+$temporada->goles;
                                $total_asistencias=$total_asistencias+$temporada->asistencias;
                                $total_tiros=$total_tiros+$temporada->tiros_arco;
                                $total_faltasc=$total_faltasc+$temporada->faltas_cometidas;
                                $total_faltasr=$total_faltasr+$temporada->faltas_recibidas;
                                $total_tarjetasa=$total_tarjetasa+$temporada->tarjetas_amarilla;
                                $total_tarjetasr=$total_tarjetasr+$temporada->tarjetas_roja;
                                $total_penalesc=$total_penalesc+$temporada->penales_cobrados;
                                $total_penalesf=$total_penalesf+$temporada->penales_fallados;
                                $total_fuera=$total_fuera+$temporada->fuera_juego;
                                $total_atajadas=$total_atajadas+$temporada->atajadas;
                                ?>
                            @endforeach
                            <tr class="text-gray-700 odd:bg-blue-50 even:bg-red-50 hover:bg-yellow-200">
                                <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                    <span class="font-bold">{{ "TOTALES" }}</span>
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    <span class="font-bold">{{ $total_goles }}</span>
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    <span class="font-bold">{{ $total_asistencias }}</span>
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    <span class="font-bold">{{ $total_tiros }}</span>
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    <span class="font-bold">{{ $total_faltasc }}</span>
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    <span class="font-bold">{{ $total_faltasr }}</span>
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    <span class="font-bold">{{ $total_tarjetasa }}</span>
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    <span class="font-bold">{{ $total_tarjetasr }}</span>
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    <span class="font-bold">{{ $total_penalesc }}</span>
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    <span class="font-bold">{{ $total_penalesf }}</span>
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    <span class="font-bold">{{ $total_fuera }}</span>
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    <span class="font-bold">{{ $total_atajadas }}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                @else
                    @if($tipo == "pitcher")
                        <span class="text-2xl font-semi-bold leading-normal">{{ __('') }}</span>
                        <table class="w-full mt-4 table bg-white rounded-lg shadow mb-12" style="font-size: 0.8em">
                            <thead>
                                <tr class="fondo-primero text-white">
                                    <th class=" p-2">Jugadores</th>
                                    <th class=" p-2" title="Posición">POS</th>
                                    <th class=" p-2" title="Goles">GOLES</th>
                                    <th class=" p-2" title="Asistencias">ASIS.</th>
                                    <th class=" p-2" title="Tiros al Arco">TIROS</th>
                                    <th class=" p-2" title="Faltas Cometidas">FC</th>
                                    <th class=" p-2" title="Faltas Recibidas">FR</th>
                                    <th class=" p-2" title="Tarjetas Amarillas">TA</th>
                                    <th class=" p-2" title="Tarjetas Rojas">TR</th>
                                    <th class=" p-2" title="Penales Cobrados">PC</th>
                                    <th class=" p-2" title="Penales Fallidos">PF</th>
                                    <th class=" p-2" title="Fuera de Juego">OFF</th>
                                    <th class=" p-2" title="Atajadas">ATA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total_goles=0;
                                $total_asistencias=0;
                                $total_tiros=0;
                                $total_faltasc=0;
                                $total_faltasr=0;
                                $total_tarjetasa=0;
                                $total_tarjetasr=0;
                                $total_penalesc=0;
                                $total_penalesf=0;
                                $total_fuera=0;
                                $total_atajadas=0;
                                ?>
                                @foreach($bateo_casa as $temporada)
                                    <tr class="text-gray-700 odd:bg-blue-50 even:bg-red-50 hover:bg-yellow-200">
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                            {{ $temporada->jugador }}
                                        </td>
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                            {{ $temporada->posicion }}
                                        </td>
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                            @if($temporada->goles > 0)
                                                {{ $temporada->goles }}
                                            @endif
                                        </td>
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                            @if($temporada->asistencias > 0)
                                                {{ $temporada->asistencias }}
                                            @endif
                                        </td>
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                            @if($temporada->tiro_arco > 0)
                                                {{ $temporada->tiro_arco }}
                                            @endif
                                        </td>
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                            @if($temporada->faltas_cometidas > 0)
                                                {{ $temporada->faltas_cometidas }}
                                            @endif
                                        </td>
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                            @if($temporada->faltas_recibidas > 0)
                                                {{ $temporada->faltas_recibidas }}
                                            @endif
                                        </td>
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                            @if($temporada->tarjetas_amarilla > 0)
                                                {{ $temporada->tarjetas_amarilla }}
                                            @endif
                                        </td>
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                            @if($temporada->tarjetas_roja > 0)
                                                {{ $temporada->tarjetas_roja }}
                                            @endif
                                        </td>
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                            @if($temporada->penales_cobrados > 0)
                                                {{ $temporada->penales_cobrado }}
                                            @endif
                                        </td>
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                            @if($temporada->penales_fallados > 0)
                                                {{ $temporada->penales_fallados }}
                                            @endif
                                        </td>
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                            @if($temporada->fuera_juego > 0)
                                                {{ $temporada->fuera_juego }}
                                            @endif
                                        </td>
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                            @if($temporada->atajadas > 0)
                                                {{ $temporada->atajadas }}
                                            @endif
                                        </td>
                                    </tr>
                                    <?php
                                    $total_goles=$total_goles+$temporada->goles;
                                    $total_asistencias=$total_asistencias+$temporada->asistencias;
                                    $total_tiros=$total_tiros+$temporada->tiros_arco;
                                    $total_faltasc=$total_faltasc+$temporada->faltas_cometidas;
                                    $total_faltasr=$total_faltasr+$temporada->faltas_recibidas;
                                    $total_tarjetasa=$total_tarjetasa+$temporada->tarjetas_amarilla;
                                    $total_tarjetasr=$total_tarjetasr+$temporada->tarjetas_roja;
                                    $total_penalesc=$total_penalesc+$temporada->penales_cobrados;
                                    $total_penalesf=$total_penalesf+$temporada->penales_fallados;
                                    $total_fuera=$total_fuera+$temporada->fuera_juego;
                                    $total_atajadas=$total_atajadas+$temporada->atajadas;
                                    ?>
                                @endforeach
                                <tr class="text-gray-700 odd:bg-blue-50 even:bg-red-50 hover:bg-yellow-200">
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                        <span class="font-bold">{{ "TOTALES" }}</span>
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        <span class="font-bold">{{ $total_goles }}</span>
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        <span class="font-bold">{{ $total_asistencias }}</span>
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        <span class="font-bold">{{ $total_tiros }}</span>
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        <span class="font-bold">{{ $total_faltasc }}</span>
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        <span class="font-bold">{{ $total_faltasr }}</span>
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        <span class="font-bold">{{ $total_tarjetasa }}</span>
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        <span class="font-bold">{{ $total_tarjetasr }}</span>
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        <span class="font-bold">{{ $total_penalesc }}</span>
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        <span class="font-bold">{{ $total_penalesf }}</span>
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        <span class="font-bold">{{ $total_fuera }}</span>
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        <span class="font-bold">{{ $total_atajadas }}</span>
                                    </td>
                                </tr>
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

        function Bat() 
        {
            bat.style.color="#002f67";
            pit.style.color="#cacfd2";

            bat.style.borderColor="#002f67";
            pit.style.borderColor="#cacfd2";
        }
        function Pit() 
        {
            bat.style.color="#cacfd2";
            pit.style.color="#002f67";

            bat.style.borderColor="#cacfd2";
            pit.style.borderColor="#002f67";
        }
    </script>
</div>
