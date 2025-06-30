<div>
    <x-layouts.menu-home>
        <div class="bg-gray-100 max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <span class="text-2xl font-semi-bold leading-normal">{{ __('Resultados') }}</span>
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
                    <select wire:model.live="torneo" style="font-size: 0.9em" class="ml-2 rounded-md border border-primary b-transparent bg-none pl-2 pr-2 py-2 focus:outline-none sm:text-sm text-left">
                        <option value="0">Seleccione</option>
                        @foreach($torneos as $tor)
                            <option value="{{ $tor->id }}">{{ $tor->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12" style="overflow-x: auto">
                <div class="overflow-hidden sm:rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2 my-2 p-2 rounded">
                        <?php $aux = 1; $x=0?>
                        @foreach($juegos as $juego)
                            @if($aux <> $juego->fecha_juego)
                                @if($x == 0)
                                    <div class="mt-2 ml-2 mr-2 p-2 mb-2 dark:bg-gray-800 rounded-lg shadow fondo-primero">
                                        <p class="text-center text-xl font-bold" style="color:white">
                                            {{ $juego->fecha_juego }}
                                            <?php $aux = $juego->fecha_juego?>
                                        </p>                                    
                                    </div>
                                    <div></div>
                                    <div></div>
                                    <?php $x=0;?>
                                @else
                                    @if($x == 1)
                                        <div></div>
                                        <div></div>
                                        <div class="mt-2 ml-2 mr-2 p-2 mb-2 dark:bg-gray-800 rounded-lg shadow fondo-primero">
                                            <p class="text-center text-xl font-bold" style="color:white">
                                                {{ $juego->fecha_juego }}
                                                <?php $aux = $juego->fecha_juego?>
                                            </p>                                    
                                        </div>
                                        <div></div>
                                        <div></div>
                                        <?php $x=0;?>
                                    @else
                                        @if($x == 2)
                                            <div></div>
                                            <div class="mt-2 ml-2 mr-2 p-2 mb-2 dark:bg-gray-800 rounded-lg shadow fondo-primero">
                                                <p class="text-center text-xl font-bold" style="color:white">
                                                    {{ $juego->fecha_juego }}
                                                    <?php $aux = $juego->fecha_juego?>
                                                </p>                                    
                                            </div>
                                            <div></div>
                                            <div></div>
                                            <?php $x=0;?>
                                        @else
                                            @if($x == 3)
                                                <div class="mt-2 ml-2 mr-2 p-2 mb-2 dark:bg-gray-800 rounded-lg shadow fondo-primero">
                                                    <p class="text-center text-xl font-bold" style="color:white">
                                                        {{ $juego->fecha_juego }}
                                                        <?php $aux = $juego->fecha_juego?>
                                                    </p>                                    
                                                </div>
                                                <div></div>
                                                <div></div>
                                                <?php $x=0;?>
                                            @endif    
                                        @endif
                                    @endif
                                @endif
                            @endif

                            <?php $x = $x +1;?>
                            @if($x > 3)
                                <?php $x=1;?>
                            @endif

                            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg pt-4 pb-2 mt-4 pl-2 pr-2">
                                <div class="px-2 py-0 w-full text-sm text-gray-700 dark:text-gray-700">
                                    <div class="px-0 py-0 w-full text-sm font-medium text-gray-900">
                                        <span style="font-size: 0.8em">
                                            @if($juego->numero_juego <> 0)
                                                <span class="text-gray-700 mr-2">
                                                    {{ "Juego ".$juego->numero_juego }}
                                                </span>
                                            @endif
                                            @if($juego->condicion == "Forfeit")
                                                <strong>
                                                    <span class="py-1 px-2 rounded" style="background-color: #a3e4d7; color:#0e6251; font-size:0.7em">
                                                        {{ $juego->condicion }}
                                                    </span>
                                                </strong>
                                            @endif
                                        </span>
                                    </div>
                                    <span>
                                        {{ $juego->fecha_juego." ".$juego->hora_juego }}
                                    </span>
                                </div>
                                <div class="px-2 py-0 w-full text-sm text-gray-700 dark:text-gray-700">
                                    <span>
                                        {{ $juego->calendario_estadio->nombre }}
                                    </span>
                                    <span class="ml-4 text-gray-500">
                                        @if($juego->grupo_id <> 10)
                                            {{ $juego->calendario_grupo->grupo }}
                                        @endif
                                    </span>
                                </div>
                                <table class="w-full p-0">
                                    <thead>
                                        <tr>
                                            <th>
                                            </th>
                                            <th>
                                            </th>
                                            <th class="text-center">
                                                <span style="font-size: 1em"><strong>C</strong></span>
                                            </th>
                                            <th class="text-center">
                                                <span style="font-size: 1em"><strong>H</strong></span>
                                            </th>
                                            <th class="text-center">
                                                <span style="font-size: 1em"><strong>E</strong></span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="45" class="text-center" >
                                                <span style="font-size: 1.3em"><img class="h-10 w-10 rounded-full" src="{{asset('storage/sistema/logo.png')}}" alt=""></span>
                                            </td>
                                            <td class="text-left p-0">
                                                <span class="ml-2 text-left" style="font-size: 1em"><strong>{{ $juego->calendario_visita->nombre }}</strong></span>
                                            </td>
                                            <td class="text-center p-0">
                                                <span style="font-size: 1.7em;">{{ $juego->anotacion_visita }}</span>
                                            </td>
                                            <td class="text-center p-0">
                                                <span style="font-size: 1.7em">{{ $juego->hits_visita }}</span>
                                            </td>
                                            <td class="text-center p-0">
                                                <span style="font-size: 1.7em">{{ $juego->errores_visita }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="45" class="text-center" >
                                                <span style="font-size: 1.3em"><img class="h-10 w-10 rounded-full" src="{{asset('storage/sistema/logo.png')}}" alt=""></span>
                                            </td>
                                            <td class="text-left p-0">
                                                <span class="ml-2 text-left" style="font-size: 1em"><strong>{{ $juego->calendario_casa->nombre }}</strong></span>
                                            </td>
                                            <td class="text-center p-0">
                                                <span style="font-size: 1.7em;">{{ $juego->anotacion_casa }}</span>
                                            </td>
                                            <td class="text-center p-0">
                                                <span style="font-size: 1.7em">{{ $juego->hits_casa }}</span>
                                            </td>
                                            <td class="text-center p-0">
                                                <span style="font-size: 1.7em">{{ $juego->errores_casa }}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-2 my-2 p-2 rounded mt-2">
                                    <div class="flex items-center mt-2">
                                        @if($juego->bat_destacado_id <> '')
                                            <a href="#" class="relative block">
                                                <img alt="profil" src="{{asset('storage/sistema/jugador.png')}}" class="mx-auto object-cover rounded-full h-10 w-10 "/>
                                            </a>
                                            <div class="flex flex-col justify-between ml-4 text-sm">
                                                <p class="text-gray-800 dark:text-white">
                                                    {{ $juego->calendario_bateador->nombre }}
                                                </p>
                                                <p class="text-gray-700 dark:text-gray-700">
                                                    {{ $juego->texto_bateador }}
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex items-center mt-2">
                                        @if($juego->pit_destacado_id <> '')
                                            <a href="#" class="relative block">
                                                <img alt="profil" src="{{asset('storage/sistema/jugador.png')}}" class="mx-auto object-cover rounded-full h-10 w-10 "/>
                                            </a>
                                            <div class="flex flex-col justify-between ml-4 text-sm">
                                                <p class="text-gray-800 dark:text-white">
                                                    {{ $juego->calendario_pitcher->nombre }}
                                                </p>
                                                <p class="text-gray-700 dark:text-gray-700">
                                                    {{ $juego->texto_pitcher }}
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="px-2 py-0 w-full text-sm text-gray-700 dark:text-gray-700">
                                    <span>
                                        {{ "Anotador : ".$juego->calendario_anotador->nombre}}
                                    </span>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2 rounded mt-2">
                                    @if($juego->arbitro1_id <> '')
                                        <div class="px-2 py-0 w-full text-sm text-gray-700 dark:text-gray-700">
                                            {{ "Arbitro : ".$juego->calendario_arbitro1->nombre }}
                                        </div>
                                    @endif
                                    @if($juego->arbitro2_id <> '')
                                        <div class="px-2 py-0 w-full text-sm text-gray-700 dark:text-gray-700">
                                            {{ "Auxiliar : ".$juego->calendario_arbitro2->nombre }}
                                        </div>
                                    @endif
                                    @if($juego->arbitro3_id <> '')
                                        <div class="px-2 py-0 w-full text-sm text-gray-700 dark:text-gray-700">
                                            {{ "Auxiliar : ".$juego->calendario_arbitro3->nombre }}
                                        </div>
                                    @endif
                                    @if($juego->arbitro4_id <> '')
                                        <div class="px-2 py-0 w-full text-sm text-gray-700 dark:text-gray-700">
                                            {{ "Auxiliar : ".$juego->calendario_arbitro4->nombre }}
                                        </div>
                                    @endif
                                </div>
                                <div class="px-2 py-0 w-full text-sm text-gray-700 dark:text-gray-700 mt-2">
                                    <a href="{{ route('box-score', $juego->id) }}" class="texto-primero">Resumen</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </x-layouts.menu-home>
</div>