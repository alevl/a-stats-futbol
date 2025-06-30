<div>
    <x-layouts.menu-admin>
        <div class="bg-gray-100 max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <span class="text-2xl font-semi-bold leading-normal">{{ __('Resultados') }}</span>
            <span class="text-2xl font-semi-bold leading-normal">{{ $datos_torneo->nombre }}</span>
            <div class="w-full flex mb-4 mt-2">
                <span class="text-2xl font-semi-bold leading-normal mr-2">{{ $datos_torneo->categoria }}</span>
            </div>
            <div class="w-full flex mb-4 mt-2">
                <x-boton-primario wire:click="$set('open_crear', true)">
                    {{ __('Agregar Juego') }}
                </x-boton-primario>
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
                                <div class="px-2 py-0 w-full text-sm font-medium text-gray-900">
                                    <div class="px-2 py-0 w-full text-sm">
                                        <strong>
                                            {{ "ID ".$juego->id." Número de Juego ".$juego->numero_juego }}
                                        </strong>
                                    </div>
                                    @if($juego->facturado_id == 1)
                                        <span style="font-size: 1em">
                                            <strong>
                                                <span class="py-1 px-2 rounded mr-2" style="background-color: #a3e4d7; color:#0e6251; font-size:0.7em">
                                                    {{ "Cobrado" }}
                                                </span>
                                            </strong>
                                            @if($juego->condicion == "Forfeit")
                                                <strong>
                                                    <span class="py-1 px-2 rounded" style="background-color: #a3e4d7; color:#0e6251; font-size:0.7em">
                                                        {{ $juego->condicion }}
                                                    </span>
                                                </strong>
                                            @endif
                                        </span>
                                    @else
                                        <span style="font-size: 1em">
                                            <strong>
                                                <span class="py-1 px-2 rounded mr-2" style="background-color: #fadbd8; color: #78281f; font-size:0.7em">
                                                    {{ "Pendiente" }}
                                                </span>
                                            </strong>
                                            @if($juego->condicion == "Forfeit")
                                                <strong>
                                                    <span class="py-1 px-2 rounded" style="background-color: #a3e4d7; color:#0e6251; font-size:0.7em">
                                                        {{ $juego->condicion }}
                                                    </span>
                                                </strong>
                                            @endif
                                        </span>
                                    @endif
                                </div>
                                <div class="px-2 py-0 w-full text-sm text-gray-400 dark:text-gray-700">
                                    <span>
                                        {{ $juego->fecha_juego." ".$juego->hora_juego }}
                                    </span>
                                </div>
                                <div class="px-2 py-0 w-full text-sm text-gray-400 dark:text-gray-700">
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
                                                <p class="text-gray-400 dark:text-gray-700">
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
                                                <p class="text-gray-400 dark:text-gray-700">
                                                    {{ $juego->texto_pitcher }}
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="px-2 py-0 w-full text-sm text-gray-400 dark:text-gray-700">
                                    <span>
                                        {{ "Anotador : ".$juego->calendario_anotador->nombre}}
                                    </span>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2 rounded mt-2">
                                    @if($juego->arbitro1_id <> '')
                                        <div class="px-2 py-0 w-full text-sm text-gray-400 dark:text-gray-700">
                                            {{ "Arbitro : ".$juego->calendario_arbitro1->nombre }}
                                        </div>
                                    @endif
                                    @if($juego->arbitro2_id <> '')
                                        <div class="px-2 py-0 w-full text-sm text-gray-400 dark:text-gray-700">
                                            {{ "Auxiliar : ".$juego->calendario_arbitro2->nombre }}
                                        </div>
                                    @endif
                                    @if($juego->arbitro3_id <> '')
                                        <div class="px-2 py-0 w-full text-sm text-gray-400 dark:text-gray-700">
                                            {{ "Auxiliar : ".$juego->calendario_arbitro3->nombre }}
                                        </div>
                                    @endif
                                    @if($juego->arbitro4_id <> '')
                                        <div class="px-2 py-0 w-full text-sm text-gray-400 dark:text-gray-700">
                                            {{ "Auxiliar : ".$juego->calendario_arbitro4->nombre }}
                                        </div>
                                    @endif
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-2 my-2 p-2 rounded mt-2 text-center">
                                    <div class="text-center mt-2">
                                        <a href="{{ route('cargar-numeritos', $juego->id) }}" class="cursor-pointer" title="{{ __('Numeritos') }}"><i class="icofont icofont-baseball texto-verde" style="font-size: 1.3em"></i></a>
                                    </div>
                                    <div class="text-center mt-2">
                                        <a wire:click="edit({{ $juego }})" class="cursor-pointer" title="{{ __('Editar') }}"><i class="icofont icofont-edit-alt texto-azul" style="font-size: 1.3em"></i></a>
                                    </div>
                                    <div class="text-center mt-2">
                                        <a wire:click="$dispatch('eliminar', {{ $juego->id }})" class="cursor-pointer" title="{{ __('Eliminar') }}"><i class="icofont icofont-bin texto-rojo" style="font-size: 1.3em"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <a href="{{ route('torneos-admin') }}" class="inline-flex items-center uppercase justify-center px-4 py-2 border border border-primary rounded font-semibold text-xs tracking-widest hover:text-blue-300 focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150 fondo-segundo text-white mb-6" >
                    Regresar
                </a>
            </div>
        </div>

        <x-dialog-modal wire:model="open_crear">
            <x-slot name="title">
                {{ __('Juego') }}
            </x-slot>
            <x-slot name="content">
                <div class="grid grid-cols-1 md:grid-cols-5 lg:grid-cols-5 gap-2 my-2 p-2 rounded">
                    <div class="mb-4">
                        <x-label value="{{ __('Número de Juego') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="numero_juego"/>
                        <x-input-error for="numero_juego"/>
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Fecha') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="fecha_crear"/>
                        <x-input-error for="fecha_crear"/>
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Hora') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="hora_crear"/>
                        <x-input-error for="hora_crear"/>
                    </div>   
                    <div class="mb-4">
                        <x-label value="{{ __('Estadio') }}" />
                        <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="estadio_id_crear" >
                            <option value="">Select...</option>
                            @foreach ($lista_estadios as $dato)
                                <option value="{{ $dato->id }}">{{ $dato->nombre }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="estadio_id_crear" />
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Grupo') }}" />
                        <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="grupo_id_crear" >
                            <option value="">Select...</option>
                            @foreach ($lista_grupos as $dato)
                                <option value="{{ $dato->id }}">{{ $dato->grupo }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="grupo_id_crear" />
                    </div>   
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-4 gap-2 my-2 p-2 rounded">
                    <div class="mb-4">
                        <x-label value="{{ __('Visitante') }}" />
                        <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="visita_id_crear" >
                            <option value="">Select...</option>
                            @foreach ($lista_equipos as $dato)
                                <option value="{{ $dato->id }}">{{ $dato->nombre }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="visita_id_crear" />
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Carreras') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="visita_carreras_crear"/>
                        <x-input-error for="visita_carreras_crear"/>
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Hits') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="visita_hits_crear"/>
                        <x-input-error for="visita_hits_crear"/>
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Errores') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="visita_errores_crear"/>
                        <x-input-error for="visita_errores_crear"/>
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Home Club') }}" />
                        <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="casa_id_crear" >
                            <option value="">Select...</option>
                            @foreach ($lista_equipos as $dato)
                                <option value="{{ $dato->id }}">{{ $dato->nombre }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="casa_id_crear" />
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Carreras') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="casa_carreras_crear"/>
                        <x-input-error for="casa_carreras_crear"/>
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Hits') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="casa_hits_crear"/>
                        <x-input-error for="casa_hits_crear"/>
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Errores') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="casa_errores_crear"/>
                        <x-input-error for="casa_errores_crear"/>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-5 lg:grid-cols-5 gap-2 my-2 p-2 rounded">
                    <div class="mb-4">
                        <x-label value="{{ __('Anotador') }}" />
                        <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="anotador_id_crear" >
                            <option value="">Select...</option>
                            @foreach ($lista_anotadores as $dato)
                                <option value="{{ $dato->id }}">{{ $dato->nombre }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="anotador_id_crear" />
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Arbitro 1') }}" />
                        <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="arbitro1_id_crear" >
                            <option value="">Select...</option>
                            @foreach ($lista_arbitros as $dato)
                                <option value="{{ $dato->id }}">{{ $dato->nombre }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="arbitro1_id_crear" />
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Arbitro 2') }}" />
                        <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="arbitro2_id_crear" >
                            <option value="">Select...</option>
                            @foreach ($lista_arbitros as $dato)
                                <option value="{{ $dato->id }}">{{ $dato->nombre }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="arbitro2_id_crear" />
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Arbitro 3') }}" />
                        <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="arbitro3_id_crear" >
                            <option value="">Select...</option>
                            @foreach ($lista_arbitros as $dato)
                                <option value="{{ $dato->id }}">{{ $dato->nombre }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="arbitro3_id_crear" />
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Arbitro 4') }}" />
                        <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="arbitro4_id_crear" >
                            <option value="">Select...</option>
                            @foreach ($lista_arbitros as $dato)
                                <option value="{{ $dato->id }}">{{ $dato->nombre }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="arbitro4_id_crear" />
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Condicion') }}" />
                        <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="condicion_crear" >
                            <option value="Normal">Normal</option>
                            <option value="Forfeit">Forfeit</option>
                        </select>
                        <x-input-error for="condicion_crear" />
                    </div>
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button wire:click="$set('open_crear', false)">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-boton-primario wire:click="save" wire:loading.attr="disabled" wire:target="save" class="disabled:opacity-25 ml-2">
                    {{ __('Registrar') }}
                </x-boton-primario>
            </x-slot>
        </x-dialog-modal>

        <x-dialog-modal wire:model="open_edit">
            <x-slot name="title">
                {{ __('Juego') }}
            </x-slot>
            <x-slot name="content">
                <div class="grid grid-cols-1 md:grid-cols-5 lg:grid-cols-5 gap-2 my-2 p-2 rounded">
                    <div class="mb-4">
                        <x-label value="{{ __('Número de Juego') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="numero_juego_editar"/>
                        <x-input-error for="numero_juego_editar"/>
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Fecha') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="fecha_juego" disabled/>
                        <x-input-error for="fecha_juego"/>
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Hora') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="hora_juego"/>
                        <x-input-error for="hora_juego"/>
                    </div>   
                    <div class="mb-4">
                        <x-label value="{{ __('Estadio') }}" />
                        <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="estadio_id" >
                            @foreach ($lista_estadios as $dato)
                                <option value="{{ $dato->id }}">{{ $dato->nombre }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="estadio_id" />
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Grupo') }}" />
                        <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="grupo_id" >
                            @foreach ($lista_grupos as $dato)
                                <option value="{{ $dato->id }}">{{ $dato->grupo }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="grupo_id" />
                    </div>   
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-4 gap-2 my-2 p-2 rounded">
                    <div class="mb-4">
                        <x-label value="{{ __('Visitante') }}" />
                        <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="visita_id" disabled >
                            @foreach ($lista_equipos as $dato)
                                <option value="{{ $dato->id }}">{{ $dato->nombre }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="visita_id" />
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Carreras') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="anotacion_visita"/>
                        <x-input-error for="anotacion_visita"/>
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Hits') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="hits_visita"/>
                        <x-input-error for="hits_visita"/>
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Errores') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="errores_visita"/>
                        <x-input-error for="errores_visita"/>
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Home Club') }}" />
                        <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="casa_id" disabled >
                            @foreach ($lista_equipos as $dato)
                                <option value="{{ $dato->id }}">{{ $dato->nombre }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="casa_id" />
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Carreras') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="anotacion_casa"/>
                        <x-input-error for="anotacion_casa"/>
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Hits') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="hits_casa"/>
                        <x-input-error for="hits_casa"/>
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Errores') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="errores_casa"/>
                        <x-input-error for="errores_casa"/>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-5 lg:grid-cols-5 gap-2 my-2 p-2 rounded">
                    <div class="mb-4">
                        <x-label value="{{ __('Anotador') }}" />
                        <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="anotador_id" >
                            @foreach ($lista_anotadores as $dato)
                                <option value="{{ $dato->id }}">{{ $dato->nombre }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="anotador_id" />
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Arbitro 1') }}" />
                        <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="arbitro1_id" >
                            @foreach ($lista_arbitros as $dato)
                                <option value="{{ $dato->id }}">{{ $dato->nombre }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="arbitro1_id" />
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Arbitro 2') }}" />
                        <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="arbitro2_id" >
                            <option value="">Select...</option>
                            @foreach ($lista_arbitros as $dato)
                                <option value="{{ $dato->id }}">{{ $dato->nombre }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="arbitro2_id" />
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Arbitro 3') }}" />
                        <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="arbitro3_id" >
                            <option value="">Select...</option>
                            @foreach ($lista_arbitros as $dato)
                                <option value="{{ $dato->id }}">{{ $dato->nombre }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="arbitro3_id" />
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Arbitro 4') }}" />
                        <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="arbitro4_id" >
                            <option value="">Select...</option>
                            @foreach ($lista_arbitros as $dato)
                                <option value="{{ $dato->id }}">{{ $dato->nombre }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="arbitro4_id" />
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Condicion') }}" />
                        <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="condicion_editar" >
                            <option value="Normal">Normal</option>
                            <option value="Forfeit">Forfeit</option>
                        </select>
                        <x-input-error for="condicion_editar" />
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2 my-2 p-2 rounded">
                    <div class="mb-4">
                        <x-label value="{{ __('Bateador Destacado') }}" />
                        <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="bat_destacado" >
                            <option value="">Select...</option>
                            @foreach ($lista_jugadores as $dato)
                                <option value="{{ $dato->id }}">{{ $dato->nombre }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="bat_destacado" />
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Resumen Bateador') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="bat_destacado_texto"/>
                        <x-input-error for="bat_destacado_texto"/>
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Pitcher Destacado') }}" />
                        <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="pit_destacado" >
                            <option value="">Select...</option>
                            @foreach ($lista_jugadores as $dato)
                                <option value="{{ $dato->id }}">{{ $dato->nombre }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="pit_destacado" />
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Resumen Pitcher') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="pit_destacado_texto"/>
                        <x-input-error for="pit_destacado_texto"/>
                    </div>
                </div>
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

        @push('js')
            <script src="sweetalert2.all.min.js"></script>

            <script>
                Livewire.on('eliminar', juegoId => { 
                        Swal.fire({
                        title: "¿{{ __('Está seguro de eliminar este juego') }}?",
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
                            @this.call('delete', juegoId)

                            Swal.fire(
                                '',
                                "{{ __('Juego eliminado') }}",
                                'success'
                            )
                        }
                    })
                });
            </script>
        @endpush
    </x-layouts.menu-admin>
</div>
