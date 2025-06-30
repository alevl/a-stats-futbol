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
                    <span class="text-2xl font-semi-bold leading-normal">{{ __('Bateo') }}</span>
                    <table class="w-full mt-4 table bg-white rounded-lg shadow mb-12" style="font-size: 0.8em">
                        <thead>
                            <tr class="fondo-primero text-white">
                                <th class=" p-2">Orden</th>
                                <th class=" p-2">Jugadores</th>
                                <th class=" p-2">Pos</th>
                                <th class=" p-2">VB</th>
                                <th class=" p-2">CA</th>
                                <th class=" p-2">H</th>
                                <th class=" p-2">CI</th>
                                <th class=" p-2">BB</th>
                                <th class=" p-2">HR</th>
                                <th class=" p-2">BR</th>
                                <th class=" p-2">K</th>
                                <th class=" p-2">AVG</th>
                                <th class=" p-2">SLG</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total_vb=0;
                            $total_apariciones=0;
                            $total_anotadas=0;
                            $total_sacrificios=0;
                            $total_hit=0;
                            $total_dobles=0;
                            $total_triples=0;
                            $total_hr=0;
                            $total_rbi=0;
                            $total_boletos_recibidos=0;
                            $total_golpeados=0;
                            $total_robadas=0;
                            $total_ponches=0;
                            $total_alcanzadas=0;
                            $total_vo=0;
                            ?>
                            @foreach($bateo_visita as $temporada)
                                <tr class="text-gray-700 odd:bg-blue-50 even:bg-red-50 hover:bg-yellow-200">
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        <?php
                                        $cadena = substr($temporada->orden_bat, -2);
                                        ?>
                                        @if($cadena == .1 or $cadena == .2 or $cadena == .3)

                                        @else
                                            {{ $temporada->orden_bat }}
                                        @endif
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                        {{ $temporada->jugador }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->posicion }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        @if($temporada->vb > 0)
                                            {{ $temporada->vb }}
                                        @endif
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        @if($temporada->anotadas > 0)
                                            {{ $temporada->anotadas }}
                                        @endif
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        @if($temporada->hit > 0)
                                            {{ $temporada->hit }}
                                        @endif
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        @if($temporada->rbi > 0)
                                            {{ $temporada->rbi }}
                                        @endif
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        @if($temporada->boletos_recibidos > 0)
                                            {{ $temporada->boletos_recibidos }}
                                        @endif
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        @if($temporada->hr > 0)
                                            {{ $temporada->hr }}
                                        @endif
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        @if($temporada->robadas > 0)
                                            {{ $temporada->robadas }}
                                        @endif
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        @if($temporada->ponches > 0)
                                            {{ $temporada->ponches }}
                                        @endif
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ number_format($temporada->average,0) }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ number_format($temporada->slugging,0) }}
                                    </td>
                                </tr>
                                <?php
                                $total_apariciones=$total_apariciones+$temporada->apariciones;
                                $total_sacrificios=$total_sacrificios+$temporada->sacrificios;
                                $total_golpeados=$total_golpeados+$temporada->golpeados;
                                $total_vo=$total_vo+$temporada->vo;
                                $total_vb=$total_vb+$temporada->vb;
                                $total_anotadas=$total_anotadas+$temporada->anotadas;
                                $total_hit=$total_hit+$temporada->hit;
                                $total_dobles=$total_dobles+$temporada->dobles;
                                $total_triples=$total_triples+$temporada->triples;
                                $total_hr=$total_hr+$temporada->hr;
                                $total_rbi=$total_rbi+$temporada->rbi;
                                $total_boletos_recibidos=$total_boletos_recibidos+$temporada->boletos_recibidos;
                                $total_robadas=$total_robadas+$temporada->robadas;
                                $total_ponches=$total_ponches+$temporada->ponches;
                                $total_alcanzadas=$total_alcanzadas+$temporada->alcanzadas;
                                ?>
                            @endforeach
                            <tr class="text-gray-700 odd:bg-blue-50 even:bg-red-50 hover:bg-yellow-200">
                                <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                    <span class="font-bold">{{ "TOTALES" }}</span>
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                    
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    <span class="font-bold">{{ $total_vb }}</span>
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    <span class="font-bold">{{ $total_anotadas }}</span>
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    <span class="font-bold">{{ $total_hit }}</span>
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    <span class="font-bold">{{ $total_rbi }}</span>
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    <span class="font-bold">{{ $total_boletos_recibidos }}</span>
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    <span class="font-bold">{{ $total_hr }}</span>
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    <span class="font-bold">{{ $total_robadas }}</span>
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    <span class="font-bold">{{ $total_ponches }}</span>
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    @if($total_vb > 0)
                                        <span class="font-bold">{{ number_format(($total_hit * 1000) / $total_vb,0) }}</span>
                                    @else
                                        <span class="font-bold">0</span>
                                    @endif
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    @if($total_vb > 0)
                                        <span class="font-bold">{{ number_format(((($total_hit - $total_dobles - $total_triples - $total_hr) + ($total_dobles * 2) + ($total_triples * 3) + ($total_hr * 4)) / $total_vb) * 1000, 0) }}</span>
                                    @else
                                        <span class="font-bold">0</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <span class="text-2xl font-semi-bold leading-normal">{{ __('Pitcheo') }}</span>
                    <table class="w-full mt-4 table bg-white rounded-lg shadow mb-12" style="font-size: 0.8em">
                        <thead>
                            <tr class="fondo-primero text-white">
                                <th class=" p-2">Jugadores</th>
                                <th class=" p-2">IP</th>
                                <th class=" p-2">HP</th>
                                <th class=" p-2">CP</th>
                                <th class=" p-2">CL</th>
                                <th class=" p-2">BB</th>
                                <th class=" p-2">K</th>
                                <th class=" p-2">ERA</th>
                                <th class=" p-2">NP</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total_iniciados = 0;
                            $total_relevos = 0;
                            $total_completos = 0;
                            $total_veces_bate = 0;
                            $total_hp = 0;
                            $total_h2 = 0;
                            $total_h3 = 0;
                            $total_h4 = 0;
                            $total_gp = 0;
                            $total_wp = 0;
                            $total_bk = 0;
                            $total_pitcheos = 0;
                            $total_ip = 0;
                            $total_carreras_permitidas = 0;
                            $total_carreras_limpias = 0;
                            $total_boletos_otorgados = 0;
                            $total_ponches_propinados = 0;
                            $total_efectividad = 0;
                            ?>
                            @foreach($pitcheo_visita as $temporada)
                                <tr class="text-gray-700 odd:bg-blue-50 even:bg-red-50 hover:bg-yellow-200">
                                    @if($temporada->ganados > 0)
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                            {{ $temporada->jugador }}<span style="margin-left:5px; color:green">(GANO)</span>
                                        </td>
                                    @else
                                        @if($temporada->perdidos > 0)
                                            <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                                {{ $temporada->jugador }}<span style="margin-left:5px; color:red">(PERDIO)</span>
                                            </td>
                                        @else
                                            <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                                {{ $temporada->jugador }}
                                            </td>
                                        @endif
                                    @endif
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        @if($temporada->ip > 0)
                                            {{ $temporada->ip }}
                                        @endif
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        @if($temporada->hp > 0)
                                            {{ $temporada->hp }}
                                        @endif
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        @if($temporada->carreras_permitidas > 0)
                                            {{ $temporada->carreras_permitidas }}
                                        @endif
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        @if($temporada->carreras_limpias > 0)
                                            {{ $temporada->carreras_limpias }}
                                        @endif
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        @if($temporada->boletos_otorgados > 0)
                                            {{ $temporada->boletos_otorgados }}
                                        @endif
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        @if($temporada->ponches_propinados > 0)
                                            {{ $temporada->ponches_propinados }}
                                        @endif
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ number_format($temporada->efectividad,2) }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        @if($temporada->pitcheos > 0)
                                            {{ $temporada->pitcheos }}
                                        @endif
                                    </td>
                                </tr>
                                <?php
                                $total_iniciados = $total_iniciados +$temporada->iniciados;
                                $total_relevos = $total_relevos +$temporada->relevos;
                                $total_completos = $total_completos+$temporada->completos;
                                $total_veces_bate = $total_veces_bate+$temporada->veces_bate;
                                $total_hp = $total_hp+$temporada->hp;
                                $total_h2 = $total_h2+$temporada->h2;
                                $total_h3 = $total_h3+$temporada->h3;
                                $total_h4 = $total_h4+$temporada->h4;
                                $total_gp = $total_gp+$temporada->gp;
                                $total_wp = $total_wp+$temporada->wp;
                                $total_bk = $total_bk+$temporada->bk;
                                $total_pitcheos = $total_pitcheos+$temporada->pitcheos;
                                $total_ip = $total_ip+$temporada->ip;
                                $total_carreras_permitidas = $total_carreras_permitidas+$temporada->carreras_permitidas;
                                $total_carreras_limpias = $total_carreras_limpias+$temporada->carreras_limpias;
                                $total_boletos_otorgados = $total_boletos_otorgados+$temporada->boletos_otorgados;
                                $total_ponches_propinados = $total_ponches_propinados+$temporada->ponches_propinados;
                                ?>
                            @endforeach
                        </tbody>
                        <tr class="text-gray-700 odd:bg-blue-50 even:bg-red-50 hover:bg-yellow-200">
                            <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                <span class="font-bold">{{ "TOTALES" }}</span>
                            </td>
                            <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                <span class="font-bold">{{ $total_ip }}</span>
                            </td>
                            <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                <span class="font-bold">{{ $total_hp }}</span>
                            </td>
                            <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                <span class="font-bold">{{ $total_carreras_permitidas }}</span>
                            </td>
                            <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                <span class="font-bold">{{ $total_carreras_limpias }}</span>
                            </td>
                            <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                <span class="font-bold">{{ $total_boletos_otorgados }}</span>
                            </td>
                            <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                <span class="font-bold">{{ $total_ponches_propinados }}</span>
                            </td>
                            <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                @if($total_ip > 0)

                                    <span class="font-bold">{{ number_format(($total_carreras_limpias * 9) / $total_ip,2) }}</span>
                                @else
                                    <span class="font-bold">0</span>
                                @endif
                            </td>
                            <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                <span class="font-bold">{{ $total_pitcheos }}</span>
                            </td>
                        </tr>
                    </table>
                @else
                    @if($tipo == "pitcher")
                        <span class="text-2xl font-semi-bold leading-normal">{{ __('Bateo') }}</span>
                        <table class="w-full mt-4 table bg-white rounded-lg shadow mb-12" style="font-size: 0.8em">
                            <thead>
                                <tr class="fondo-primero text-white">
                                    <th class=" p-2">Orden</th>
                                    <th class=" p-2">Jugadores</th>
                                    <th class=" p-2">Pos</th>
                                    <th class=" p-2">VB</th>
                                    <th class=" p-2">CA</th>
                                    <th class=" p-2">H</th>
                                    <th class=" p-2">BB</th>
                                    <th class=" p-2">SF</th>
                                    <th class=" p-2">GP</th>
                                    <th class=" p-2">AL</th>
                                    <th class=" p-2">2B</th>
                                    <th class=" p-2">3B</th>
                                    <th class=" p-2">HR</th>
                                    <th class=" p-2">BA</th>
                                    <th class=" p-2">CI</th>
                                    <th class=" p-2">BR</th>
                                    <th class=" p-2">K</th>
                                    <th class=" p-2">AVG</th>
                                    <th class=" p-2">SLG</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total_vb=0;
                                $total_apariciones=0;
                                $total_anotadas=0;
                                $total_sacrificios=0;
                                $total_hit=0;
                                $total_dobles=0;
                                $total_triples=0;
                                $total_hr=0;
                                $total_rbi=0;
                                $total_boletos_recibidos=0;
                                $total_golpeados=0;
                                $total_robadas=0;
                                $total_ponches=0;
                                $total_alcanzadas=0;
                                $total_vo=0;
                                ?>
                                @foreach($bateo_casa as $temporada)
                                   <tr class="text-gray-700 odd:bg-blue-50 even:bg-red-50 hover:bg-yellow-200">
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                            <?php
                                            $cadena = substr($temporada->orden_bat, -2);
                                            ?>
                                            @if($cadena == .1 or $cadena == .2 or $cadena == .3)

                                            @else
                                                {{ $temporada->orden_bat }}
                                            @endif
                                        </td>
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                            {{ $temporada->jugador }}
                                        </td>
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                            {{ $temporada->posicion }}
                                        </td>
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                            @if($temporada->vb > 0)
                                                {{ $temporada->vb }}
                                            @endif
                                        </td>
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                            @if($temporada->anotadas > 0)
                                                {{ $temporada->anotadas }}
                                            @endif
                                        </td>
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                            @if($temporada->hit > 0)
                                                {{ $temporada->hit }}
                                            @endif
                                        </td>
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                            @if($temporada->boletos_recibidos > 0)
                                                {{ $temporada->boletos_recibidos }}
                                            @endif
                                        </td>
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                            @if($temporada->sacrificios > 0)
                                                {{ $temporada->sacrificios }}
                                            @endif
                                        </td>
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                            @if($temporada->golpeados > 0)
                                                {{ $temporada->golpeados }}
                                            @endif
                                        </td>
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                            @if($temporada->apariciones > 0)
                                                {{ $temporada->apariciones }}
                                            @endif
                                        </td>
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                            @if($temporada->dobles > 0)
                                                {{ $temporada->dobles }}
                                            @endif
                                        </td>
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                            @if($temporada->triples > 0)
                                                {{ $temporada->triples }}
                                            @endif
                                        </td>
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                            @if($temporada->hr > 0)
                                                {{ $temporada->hr }}
                                            @endif
                                        </td>
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                            @if($temporada->alcanzadas > 0)
                                                {{ $temporada->alcanzadas }}
                                            @endif
                                        </td>
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                            @if($temporada->rbi > 0)
                                                {{ $temporada->rbi }}
                                            @endif
                                        </td>
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                            @if($temporada->robadas > 0)
                                                {{ $temporada->robadas }}
                                            @endif
                                        </td>
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                            @if($temporada->ponches > 0)
                                                {{ $temporada->ponches }}
                                            @endif
                                        </td>
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                            {{ number_format($temporada->average,0) }}
                                        </td>
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                            {{ number_format($temporada->slugging,0) }}
                                        </td>
                                    </tr>
                                    <?php
                                    $total_apariciones=$total_apariciones+$temporada->apariciones;
                                    $total_sacrificios=$total_sacrificios+$temporada->sacrificios;
                                    $total_golpeados=$total_golpeados+$temporada->golpeados;
                                    $total_vo=$total_vo+$temporada->vo;
                                    $total_vb=$total_vb+$temporada->vb;
                                    $total_anotadas=$total_anotadas+$temporada->anotadas;
                                    $total_hit=$total_hit+$temporada->hit;
                                    $total_dobles=$total_dobles+$temporada->dobles;
                                    $total_triples=$total_triples+$temporada->triples;
                                    $total_hr=$total_hr+$temporada->hr;
                                    $total_rbi=$total_rbi+$temporada->rbi;
                                    $total_boletos_recibidos=$total_boletos_recibidos+$temporada->boletos_recibidos;
                                    $total_robadas=$total_robadas+$temporada->robadas;
                                    $total_ponches=$total_ponches+$temporada->ponches;
                                    $total_alcanzadas=$total_alcanzadas+$temporada->alcanzadas;
                                    ?>
                                @endforeach
                                <tr class="text-gray-700 odd:bg-blue-50 even:bg-red-50 hover:bg-yellow-200">
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-left">

                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                        <span class="font-bold">{{ "TOTALES" }}</span>
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-left">

                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        <span class="font-bold">{{ $total_vb }}</span>
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        <span class="font-bold">{{ $total_anotadas }}</span>
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        <span class="font-bold">{{ $total_hit }}</span>
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        <span class="font-bold">{{ $total_boletos_recibidos }}</span>
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        <span class="font-bold">{{ $total_sacrificios }}</span>
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        <span class="font-bold">{{ $total_golpeados }}</span>
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        <span class="font-bold">{{ $total_apariciones }}</span>
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        <span class="font-bold">{{ $total_dobles }}</span>
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        <span class="font-bold">{{ $total_triples }}</span>
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        <span class="font-bold">{{ $total_hr }}</span>
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        <span class="font-bold">{{ $total_alcanzadas }}</span>
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        <span class="font-bold">{{ $total_rbi }}</span>
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        <span class="font-bold">{{ $total_robadas }}</span>
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        <span class="font-bold">{{ $total_ponches }}</span>
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        @if($total_vb > 0)
                                            <span class="font-bold">{{ number_format(($total_hit * 1000) / $total_vb,0) }}</span>
                                        @else
                                            <span class="font-bold">0</span>
                                        @endif
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        @if($total_vb > 0)
                                            <span class="font-bold">{{ number_format(((($total_hit - $total_dobles - $total_triples - $total_hr) + ($total_dobles * 2) + ($total_triples * 3) + ($total_hr * 4)) / $total_vb) * 1000, 0) }}</span>
                                        @else
                                            <span class="font-bold">0</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <span class="text-2xl font-semi-bold leading-normal">{{ __('Pitcheo') }}</span>
                        <table class="w-full mt-4 table bg-white rounded-lg shadow mb-12" style="font-size: 0.8em">
                            <thead>
                                <tr class="fondo-primero text-white">
                                    <th class=" p-2">Jugadores</th>
                                    <th class=" p-2">IP</th>
                                    <th class=" p-2">HP</th>
                                    <th class=" p-2">CP</th>
                                    <th class=" p-2">CL</th>
                                    <th class=" p-2">BB</th>
                                    <th class=" p-2">K</th>
                                    <th class=" p-2">ERA</th>
                                    <th class=" p-2">NP</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total_iniciados = 0;
                                $total_relevos = 0;
                                $total_completos = 0;
                                $total_veces_bate = 0;
                                $total_hp = 0;
                                $total_h2 = 0;
                                $total_h3 = 0;
                                $total_h4 = 0;
                                $total_gp = 0;
                                $total_wp = 0;
                                $total_bk = 0;
                                $total_pitcheos = 0;
                                $total_ip = 0;
                                $total_carreras_permitidas = 0;
                                $total_carreras_limpias = 0;
                                $total_boletos_otorgados = 0;
                                $total_ponches_propinados = 0;
                                $total_efectividad = 0;
                                ?>
                                @foreach($pitcheo_casa as $temporada)
                                <tr class="text-gray-700 odd:bg-blue-50 even:bg-red-50 hover:bg-yellow-200">
                                    @if($temporada->ganados > 0)
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                            {{ $temporada->jugador }}<span style="margin-left:5px; color:green">(GANO)</span>
                                        </td>
                                    @else
                                        @if($temporada->perdidos > 0)
                                            <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                                {{ $temporada->jugador }}<span style="margin-left:5px; color:red">(PERDIO)</span>
                                            </td>
                                        @else
                                            <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                                {{ $temporada->jugador }}
                                            </td>
                                        @endif
                                    @endif
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        @if($temporada->ip > 0)
                                            {{ $temporada->ip }}
                                        @endif
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        @if($temporada->hp > 0)
                                            {{ $temporada->hp }}
                                        @endif
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        @if($temporada->carreras_permitidas > 0)
                                            {{ $temporada->carreras_permitidas }}
                                        @endif
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        @if($temporada->carreras_limpias > 0)
                                            {{ $temporada->carreras_limpias }}
                                        @endif
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        @if($temporada->boletos_otorgados > 0)
                                            {{ $temporada->boletos_otorgados }}
                                        @endif
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        @if($temporada->ponches_propinados > 0)
                                            {{ $temporada->ponches_propinados }}
                                        @endif
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ number_format($temporada->efectividad,2) }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        @if($temporada->pitcheos > 0)
                                            {{ $temporada->pitcheos }}
                                        @endif
                                    </td>
                                </tr>
                                <?php
                                    $total_iniciados = $total_iniciados +$temporada->iniciados;
                                    $total_relevos = $total_relevos +$temporada->relevos;
                                    $total_completos = $total_completos+$temporada->completos;
                                    $total_veces_bate = $total_veces_bate+$temporada->veces_bate;
                                    $total_hp = $total_hp+$temporada->hp;
                                    $total_h2 = $total_h2+$temporada->h2;
                                    $total_h3 = $total_h3+$temporada->h3;
                                    $total_h4 = $total_h4+$temporada->h4;
                                    $total_gp = $total_gp+$temporada->gp;
                                    $total_wp = $total_wp+$temporada->wp;
                                    $total_bk = $total_bk+$temporada->bk;
                                    $total_pitcheos = $total_pitcheos+$temporada->pitcheos;
                                    $total_ip = $total_ip+$temporada->ip;
                                    $total_carreras_permitidas = $total_carreras_permitidas+$temporada->carreras_permitidas;
                                    $total_carreras_limpias = $total_carreras_limpias+$temporada->carreras_limpias;
                                    $total_boletos_otorgados = $total_boletos_otorgados+$temporada->boletos_otorgados;
                                    $total_ponches_propinados = $total_ponches_propinados+$temporada->ponches_propinados;
                                    ?>
                                @endforeach
                                <tr class="text-gray-700 odd:bg-blue-50 even:bg-red-50 hover:bg-yellow-200">
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                        <span class="font-bold">{{ "TOTALES" }}</span>
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        <span class="font-bold">{{ $total_ip }}</span>
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        <span class="font-bold">{{ $total_hp }}</span>
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        <span class="font-bold">{{ $total_carreras_permitidas }}</span>
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        <span class="font-bold">{{ $total_carreras_limpias }}</span>
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        <span class="font-bold">{{ $total_boletos_otorgados }}</span>
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        <span class="font-bold">{{ $total_ponches_propinados }}</span>
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        @if($total_ip > 0)

                                            <span class="font-bold">{{ number_format(($total_carreras_limpias * 9) / $total_ip,2) }}</span>
                                        @else
                                            <span class="font-bold">0</span>
                                        @endif
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        <span class="font-bold">{{ $total_pitcheos }}</span>
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
