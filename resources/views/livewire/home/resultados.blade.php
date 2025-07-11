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

                            <div class="bg-white shadow-xl sm:rounded-lg p-4 mt-4">
                                {{-- Encabezado del juego --}}
                                <div class="flex justify-between items-center mb-2 text-sm text-gray-700">
                                    <div>
                                        @if($juego->numero_juego != 0)
                                            <span class="font-semibold">Juego {{ $juego->numero_juego }}</span>
                                        @endif
                                        @if($juego->condicion == "Forfeit")
                                            <span class="ml-2 bg-green-100 text-green-800 text-xs font-bold px-2 py-1 rounded">{{ $juego->condicion }}</span>
                                        @endif
                                    </div>
                                    <div>
                                        {{ $juego->fecha_juego }} {{ $juego->hora_juego }}
                                    </div>
                                </div>

                                {{-- Estadio y grupo --}}
                                <div class="text-sm text-gray-600 mb-4">
                                    <span>{{ $juego->calendario_estadio->nombre }}</span>
                                    @if($juego->grupo_id != 10)
                                        <span class="ml-4 text-gray-500">{{ "(GRUPO ".$juego->calendario_grupo->grupo.")" }}</span>
                                    @endif
                                </div>

                                {{-- Tabla de resultados --}}
                                <table class="w-full text-center text-sm mb-4">
                                    <thead>
                                        <tr class="text-gray-600">
                                            <th></th>
                                            <th class="text-left">Equipo</th>
                                            <th>Goles</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- Visitante --}}
                                        <tr class="border-b">
                                            <td class="w-12 mr-4">
                                                <img src="{{ asset('storage/sistema/favicon.png') }}" alt="logo" class="h-10 w-10 rounded-full mx-auto">
                                            </td>
                                            <td class="text-left font-semibold">
                                                {{ $juego->calendario_visita->nombre }}
                                                <div class="text-xs mt-1">
                                                    <span class="text-yellow-600 mr-2">🟨 {{ $juego->tarjetas_amarilla_visita ?? 0 }}</span>
                                                    <span class="text-red-600">🟥 {{ $juego->tarjetas_roja_visita ?? 0 }}</span>
                                                </div>
                                            </td>
                                            <td class="text-lg font-bold">{{ $juego->anotacion_visita }}</td>
                                        </tr>

                                        {{-- Local --}}
                                        <tr>
                                            <td class="w-12">
                                                <img src="{{ asset('storage/sistema/favicon.png') }}" alt="logo" class="h-10 w-10 rounded-full mx-auto">
                                            </td>
                                            <td class="text-left font-semibold">
                                                {{ $juego->calendario_casa->nombre }}
                                                <div class="text-xs mt-1">
                                                    <span class="text-yellow-600 mr-2">🟨 {{ $juego->tarjeta_amarilla_casa ?? 0 }}</span>
                                                    <span class="text-red-600">🟥 {{ $juego->tarjetas_roja_casa ?? 0 }}</span>
                                                </div>
                                            </td>
                                            <td class="text-lg font-bold">{{ $juego->anotacion_casa }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                {{-- Jugadores destacados --}}
                                <div class="grid md:grid-cols-2 gap-4 mb-4">
                                    @if($juego->visita_destacado_id)
                                        <div class="flex items-center">
                                            <img src="{{ asset('storage/sistema/jugador.png') }}" alt="bateador" class="h-10 w-10 rounded-full">
                                            <div class="ml-3 text-sm">
                                                <p class="text-gray-800 font-semibold">{{ $juego->calendario_bateador->nombre }}</p>
                                                <p class="text-gray-600">{{ $juego->texto_visita }}</p>
                                            </div>
                                        </div>
                                    @endif

                                    @if($juego->casa_destacado_id)
                                        <div class="flex items-center">
                                            <img src="{{ asset('storage/sistema/jugador.png') }}" alt="pitcher" class="h-10 w-10 rounded-full">
                                            <div class="ml-3 text-sm">
                                                <p class="text-gray-800 font-semibold">{{ $juego->calendario_pitcher->nombre }}</p>
                                                <p class="text-gray-600">{{ $juego->texto_casa }}</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                {{-- Árbitros y anotador --}}
                                <div class="text-sm text-gray-700 space-y-1 mb-4">
                                    <p><strong>Anotador:</strong> {{ $juego->calendario_anotador->nombre }}</p>
                                    @if($juego->arbitro1_id)
                                        <p><strong>Árbitro:</strong> {{ $juego->calendario_arbitro1->nombre }}</p>
                                    @endif
                                    @if($juego->arbitro2_id)
                                        <p><strong>Auxiliar:</strong> {{ $juego->calendario_arbitro2->nombre }}</p>
                                    @endif
                                    @if($juego->arbitro3_id)
                                        <p><strong>Auxiliar:</strong> {{ $juego->calendario_arbitro3->nombre }}</p>
                                    @endif
                                    @if($juego->arbitro4_id)
                                        <p><strong>Auxiliar:</strong> {{ $juego->calendario_arbitro4->nombre }}</p>
                                    @endif
                                </div>

                                {{-- Link a resumen --}}
                                <div class="text-right">
                                    <a href="{{ route('box-score', $juego->id) }}" class="text-blue-600 hover:underline font-medium text-sm">Ver resumen del juego</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </x-layouts.menu-home>
</div>