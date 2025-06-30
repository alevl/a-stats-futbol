<div>
    <x-layouts.menu-admin>
        <div class="bg-gray-100 max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <span class="text-2xl font-semi-bold leading-normal">{{ __('Cargar Numeritos') }}</span>
            <span class="text-2xl font-semi-bold leading-normal">{{ $datos_juego->nombre }}</span>
            <div class="w-full flex mb-4 mt-2">
                <span class="text-2xl font-semi-bold leading-normal mr-2">{{ $datos_juego->categoria }}</span>
            </div>
            <div class="w-full flex mb-4 mt-2">
                <a wire:click="$set('open_crear_visita', true)" class="cursor-pointer flex inline-flex items-center uppercase justify-center px-4 py-2 border border border-primary rounded font-semibold text-xs tracking-widest hover:text-blue-300 focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150 fondo-primero text-white mb-2 mr-2" >
                    Agregar Jugador
                </a>
                <a wire:click="actualizar_roster" class="cursor-pointer flex inline-flex items-center uppercase justify-center px-4 py-2 border border border-primary rounded font-semibold text-xs tracking-widest hover:text-blue-300 focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150 fondo-segundo text-white mb-2" >
                    Actualizar Roster
                </a>
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
                        <div class="space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <x-nav-link class="cursor-pointer" wire:click="$set('tipo', 'defensa')" id="def" onclick="Def()" style="border-bottom-color: #cacfd2; color: #cacfd2">
                                {{ __('Defensiva') }}
                            </x-nav-link>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="col-12" style="overflow-x: auto">
                @if ($tipo == "bateador")
                    <table class="w-full mt-4 table bg-white rounded-lg shadow mb-12" style="font-size: 0.8em">
                        <thead>
                            <tr class="fondo-primero text-white">
                                <th class=" p-2">Orden</th>
                                <th class=" p-2">Pos</th>
                                <th class=" p-2">Jugadores</th>
                                <th class=" p-2">Equipo</th>
                                <th class=" p-2">J</th>
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
                                <th class=" p-2">VO</th>
                                <th class=" p-2">AVG</th>
                                <th class=" p-2">SLG</th>
                                <th class=" p-2">Cargar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($numeros_temporadas as $temporada)
                                <tr class="text-gray-700 odd:bg-blue-50 even:bg-red-50 hover:bg-yellow-200">
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        @if($temporada->orden_bat <> 99)
                                            {{ $temporada->orden_bat }}
                                        @endif
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->posicion }}
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
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->vo }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->average }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->slugging }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        <a wire:click="cargar_bateo({{ $temporada }})" class="cursor-pointer mr-2" title="{{ __('Cargar') }}"><i class="icofont icofont-drag1 texto-azul" style="font-size: 1.3em"></i></a>

                                        <a wire:click="mvp_bateador({{ $temporada->jugador_id }})" class="cursor-pointer" title="{{ __('MVP') }}"><i class="icofont icofont-medal-sport texto-azul" style="font-size: 1.3em"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    @if($tipo == "pitcher")
                        <table class="w-full mt-4 table bg-white rounded-lg shadow mb-12" style="font-size: 0.8em">
                            <thead>
                                <tr class="fondo-primero text-white">
                                    <th class=" p-2">Jugadores</th>
                                    <th class=" p-2">Equipo</th>
                                    <th class=" p-2">J</th>
                                    <th class=" p-2">I</th>
                                    <th class=" p-2">R</th>
                                    <th class=" p-2">C</th>
                                    <th class=" p-2">G</th>
                                    <th class=" p-2">P</th>
                                    <th class=" p-2">SV</th>
                                    <th class=" p-2">VB</th>
                                    <th class=" p-2">HP</th>
                                    <th class=" p-2">H2</th>
                                    <th class=" p-2">H3</th>
                                    <th class=" p-2">H4</th>
                                    <th class=" p-2">IP</th>
                                    <th class=" p-2">CP</th>
                                    <th class=" p-2">CL</th>
                                    <th class=" p-2">K</th>
                                    <th class=" p-2">BB</th>
                                    <th class=" p-2">GP</th>
                                    <th class=" p-2">WP</th>
                                    <th class=" p-2">BK</th>
                                    <th class=" p-2">NP</th>
                                    <th class=" p-2">ERA</th>
                                    <th class=" p-2">Cargar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($numeros_temporadas as $temporada)
                                    <tr class="text-gray-700 odd:bg-blue-50 even:bg-red-50 hover:bg-yellow-200">
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
                                            {{ $temporada->pitcheos }}
                                        </td>
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                            {{ number_format($temporada->efectividad,2) }}
                                        </td>
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                            <a wire:click="cargar_pitcheo({{ $temporada }})" class="cursor-pointer mr-2" title="{{ __('Cargar') }}"><i class="icofont icofont-edit-alt texto-azul" style="font-size: 1.3em"></i></a>

                                            <a wire:click="mvp_pitcher({{ $temporada->jugador_id }})" class="cursor-pointer" title="{{ __('MVP') }}"><i class="icofont icofont-medal-sport texto-azul" style="font-size: 1.3em"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <table class="w-full mt-4 table bg-white rounded-lg shadow mb-12" style="font-size: 0.8em">
                            <thead>
                                <tr class="fondo-primero text-white">
                                    <th class=" p-2">Jugadores</th>
                                    <th class=" p-2">Equipo</th>
                                    <th class=" p-2">J</th>
                                    <th class=" p-2">POS</th>
                                    <th class=" p-2">IJ</th>
                                    <th class=" p-2">O</th>
                                    <th class=" p-2">A</th>
                                    <th class=" p-2">E</th>
                                    <th class=" p-2">PORC</th>
                                    <th class=" p-2">Cargar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($numeros_defensiva as $temporada)
                                    <tr class="text-gray-700 odd:bg-blue-50 even:bg-red-50 hover:bg-yellow-200">
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
                                            {{ number_format($temporada->porcentaje_fildeo,0) }}
                                        </td>
                                        <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                            <a wire:click="crear_defensa({{ $temporada }})" class="cursor-pointer mr-2" title="{{ __('Cargar') }}"><i class="icofont icofont-architecture-alt texto-verde" style="font-size: 1.3em"></i></a>
                                            <a wire:click="edit_defensa({{ $temporada }})" class="cursor-pointer" title="{{ __('Editar') }}"><i class="icofont icofont-edit-alt texto-azul" style="font-size: 1.3em"></i></a>
                                        </td>
                                        </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                @endif
            </div>
        </div>
        <x-modal-ancho wire:model="open_cargar_bateo">
            <x-slot name="title">
            </x-slot>
            <x-slot name="content">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2 my-2 p-2 rounded">
                    <div class="mb-0">
                        <x-label value="{{ __('Nombre') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="nombre_bateo" disabled/>
                        <x-input-error for="nombre_bateo"/>
                    </div>
                    <div class="mb-0">
                        <x-label value="{{ __('Equipo') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="equipo_bateo" disabled/>
                        <x-input-error for="equipo_bateo"/>
                    </div>   
                    <div class="mb-0">
                        <x-label value="{{ __('Orden al Bate') }}" />
                        <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="orden_bat">
                            <option value="1">1</option>
                            <option value="1.1">1.1</option>
                            <option value="1.2">1.2</option>
                            <option value="1.3">1.3</option>
                            <option value="2">2</option>
                            <option value="2.1">2.1</option>
                            <option value="2.2">2.2</option>
                            <option value="2.3">2.3</option>
                            <option value="3">3</option>
                            <option value="3.1">3.1</option>
                            <option value="3.2">3.2</option>
                            <option value="3.3">3.3</option>

                            <option value="4">4</option>
                            <option value="4.1">4.1</option>
                            <option value="4.2">4.2</option>
                            <option value="4.3">4.3</option>

                            <option value="5">5</option>
                            <option value="5.1">5.1</option>
                            <option value="5.2">5.2</option>
                            <option value="5.3">5.3</option>

                            <option value="6">6</option>
                            <option value="6.1">6.1</option>
                            <option value="6.2">6.2</option>
                            <option value="6.3">6.3</option>

                            <option value="7">7</option>
                            <option value="7.1">7.1</option>
                            <option value="7.2">7.2</option>
                            <option value="7.3">7.3</option>

                            <option value="8">8</option>
                            <option value="8.1">8.1</option>
                            <option value="8.2">8.2</option>
                            <option value="8.3">8.3</option>

                            <option value="9">9</option>
                            <option value="9.1">9.1</option>
                            <option value="9.2">9.2</option>
                            <option value="9.3">9.3</option>

                            <option value="10">10</option>
                            <option value="10.1">10.1</option>
                            <option value="10.2">10.2</option>
                            <option value="10.3">10.3</option>

                            <option value="11">11</option>
                            <option value="11.1">11.1</option>
                            <option value="11.2">11.2</option>
                            <option value="11.3">11.3</option>

                            <option value="12">12</option>
                            <option value="12.1">12.1</option>
                            <option value="12.2">12.2</option>
                            <option value="12.3">12.3</option>

                            <option value="13">13</option>
                            <option value="13.1">13.1</option>
                            <option value="13.2">13.2</option>
                            <option value="13.3">13.3</option>

                            <option value="14">14</option>
                            <option value="14.1">14.1</option>
                            <option value="14.2">14.2</option>
                            <option value="14.3">14.3</option>

                            <option value="15">15</option>
                            <option value="15.1">15.1</option>
                            <option value="15.2">15.2</option>
                            <option value="15.3">15.3</option>
                        </select>
                        <x-input-error for="orden_bat" />
                    </div>
                    <div class="mb-0">
                        <x-label value="Posición" />
                        <x-input type="text" class="w-full" wire:model.defer="posicion_defensa" />
                        <x-input-error for="posicion_defensa"/>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-12 lg:grid-cols-12 gap-2 my-2 p-2 rounded">
                    <div class="mb-0">
                        <x-label value="VB" />
                        <x-input type="text" class="w-full" wire:model.defer="vb" />
                        <x-input-error for="vb"/>
                    </div>   
                    <div class="mb-0">
                        <x-label value="CA" />
                        <x-input type="text" class="w-full" wire:model.defer="anotadas" />
                        <x-input-error for="anotadas"/>
                    </div>   
                    <div class="mb-0">
                        <x-label value="HC" />
                        <x-input type="text" class="w-full" wire:model.defer="hit" />
                        <x-input-error for="hit"/>
                    </div>
                    <div class="mb-0">
                        <x-label value="BB" style="color:red" />
                        <x-input type="text" class="w-full" wire:model.defer="boletos_recibidos" />
                        <x-input-error for="boletos_recibidos"/>
                    </div>   
                    <div class="mb-0">
                        <x-label value="SF" style="color:red" />
                        <x-input type="text" class="w-full" wire:model.defer="sacrificios" />
                        <x-input-error for="sacrificios"/>
                    </div>   
                    <div class="mb-0">
                        <x-label value="GP" style="color:red" />
                        <x-input type="text" class="w-full" wire:model.defer="golpeados" />
                        <x-input-error for="golpeados"/>
                    </div>   
                    <div class="mb-0">
                        <x-label value="2B" style="color:red" />
                        <x-input type="text" class="w-full" wire:model.defer="dobles" />
                        <x-input-error for="dobles"/>
                    </div>   
                    <div class="mb-0">
                        <x-label value="3B" style="color:red" />
                        <x-input type="text" class="w-full" wire:model.defer="triples" />
                        <x-input-error for="triples"/>
                    </div>   
                    <div class="mb-0">
                        <x-label value="HR" style="color:red" />
                        <x-input type="text" class="w-full" wire:model.defer="hr" />
                        <x-input-error for="hr"/>
                    </div>   
                    <div class="mb-0">
                        <x-label value="CI" />
                        <x-input type="text" class="w-full" wire:model.defer="rbi" />
                        <x-input-error for="rbi"/>
                    </div>   
                    <div class="mb-0">
                        <x-label value="BR" />
                        <x-input type="text" class="w-full" wire:model.defer="robadas" />
                        <x-input-error for="robadas"/>
                    </div>
                    <div class="mb-0">
                        <x-label value="K" />
                        <x-input type="text" class="w-full" wire:model.defer="ponches" />
                        <x-input-error for="ponches"/>
                    </div>
                </div>
                <div class="mb-0">
                    <input wire:model="input_radio" id="limp" name="limp" value="limp" wire:click="anotacion('limpiar')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                    <label for="limp">Limpiar</label>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-7 lg:grid-cols-7 gap-2 my-2 p-2 rounded">
                    <div class="bg-blue-100 rounded p-2">
                        <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-2 my-2 p-2 rounded">
                            <div class="mb-0">
                                <input wire:model="uno" id="1out" name="out" value="1out" wire:click="anotacion('1out')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="1out">Out</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="uno" id="2out" name="out" value="2out" wire:click="anotacion('2out')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="2out">2 Out</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="uno" id="3out" name="out" value="3out" wire:click="anotacion('3out')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="3out">3 Out</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="uno" id="4out" name="out" value="4out" wire:click="anotacion('4out')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="4out">4 Out</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="uno" id="5out" name="out" value="5out" wire:click="anotacion('5out')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="5out">5 Out</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="uno" id="6out" name="out" value="6out" wire:click="anotacion('6out')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="6out">6 Out</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="seis" id="1ponche" name="ponche" value="1ponche" wire:click="anotacion('1ponche')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="1ponche">Ponche</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="seis" id="2ponche" name="ponche" value="2ponche" wire:click="anotacion('2ponche')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="2ponche">2 Ponches</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="seis" id="3ponche" name="ponche" value="3ponche" wire:click="anotacion('3ponche')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="3ponche">3 Ponches</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="seis" id="4ponche" name="ponche" value="4ponche" wire:click="anotacion('4ponche')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="4ponche">4 Ponches</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="seis" id="5ponche" name="ponche" value="5ponche" wire:click="anotacion('5ponche')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="5ponche">5 Ponches</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="seis" id="6ponche" name="ponche" value="6ponche" wire:click="anotacion('6ponches')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="6ponche">6 Ponches</label>
                            </div>
                        </div>
                    </div>
                    <div class="bg-green-100 rounded p-2">
                        <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-2 my-2 p-2 rounded">
                            <div class="mb-0">
                                <input wire:model="siete" id="1boleto" name="boleto" value="1boleto" wire:click="anotacion('1boleto')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="1boleto">1 Boleto</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="siete" id="2boleto" name="boleto" value="2boleto" wire:click="anotacion('2boleto')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="2boleto">2 Boletos</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="siete" id="3boleto" name="boleto" value="3boleto" wire:click="anotacion('3boleto')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="3boleto">3 Boletos</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="siete" id="4boleto" name="boleto" value="4boleto" wire:click="anotacion('4boleto')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="4boleto">4 Boletos</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="siete" id="5boleto" name="boleto" value="5boleto" wire:click="anotacion('5boleto')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="5boleto">5 Boletos</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="siete" id="6boleto" name="boleto" value="6boleto" wire:click="anotacion('6boleto')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="6boleto">6 Boletos</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="ocho" id="1golpeado" name="golpeado" value="1golpeado" wire:click="anotacion('1golpeado')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="1golpeado">1 Golpeado</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="ocho" id="2golpeado" name="golpeado" value="2golpeado" wire:click="anotacion('2golpeado')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="2golpeado">2 Golpeados</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="ocho" id="3golpeado" name="golpeado" value="3golpeado" wire:click="anotacion('3golpeado')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="3golpeado">3 Golpeados</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="ocho" id="4golpeado" name="golpeado" value="4golpeado" wire:click="anotacion('4golpeado')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="4golpeado">4 Golpeados</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="ocho" id="5golpeado" name="golpeado" value="5golpeado" wire:click="anotacion('5golpeado')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="5golpeado">5 Golpeados</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="ocho" id="6golpeado" name="golpeado" value="6golpeado" wire:click="anotacion('6golpeado')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="1golpeado">6 Golpeados</label>
                            </div>
                       </div>
                    </div>
                    <div class="bg-blue-100 rounded p-2">
                        <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-2 my-2 p-2 rounded">
                            <div class="mb-0">
                                <input wire:model="doce" id="1robo" name="robo" value="1robo" wire:click="anotacion('1robo')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="1robo">1 Robo</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="doce" id="2robo" name="robo" value="2robo" wire:click="anotacion('2robo')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="2robo">2 Robos</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="doce" id="3robo" name="robo" value="3robo" wire:click="anotacion('3robo')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="3robo">3 Robos</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="doce" id="4robo" name="robo" value="4robo" wire:click="anotacion('4robo')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="4robo">4 Robos</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="doce" id="5robo" name="robo" value="5robo" wire:click="anotacion('5robo')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="5robo">5 Robo</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="doce" id="6robo" name="robo" value="6robo" wire:click="anotacion('6robo')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="6robo">6 Robo</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="nueve" id="1sacrificio" name="sacrificio" value="1sacrificio" wire:click="anotacion('1sacrificio')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="1sacrificio">1 Sacrificio</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="nueve" id="2sacrificio" name="sacrificio" value="2sacrificio" wire:click="anotacion('2sacrificio')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="2sacrificio">2 Sacrificios</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="nueve" id="3sacrificio" name="sacrificio" value="3sacrificio" wire:click="anotacion('3sacrificio')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="3sacrificio">3 Sacrificios</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="nueve" id="4sacrificio" name="sacrificio" value="4sacrificio" wire:click="anotacion('4sacrificio')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="4sacrificio">4 Sacrificios</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="nueve" id="5sacrificio" name="sacrificio" value="5sacrificio" wire:click="anotacion('5sacrificio')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="5sacrificio">5 Sacrificios</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="nueve" id="6sacrificio" name="sacrificio" value="6sacrificio" wire:click="anotacion('6sacrificio')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="6sacrificio">6 Sacrificio</label>
                            </div>
                        </div>
                    </div>
                    <div class="bg-green-100 rounded p-2">
                        <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-2 my-2 p-2 rounded">
                            <div class="mb-0">
                                <input wire:model="dos" id="1hit" name="hit" value="1hit" wire:click="anotacion('1hit')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="1hit">1 Hit</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="dos" id="2hit" name="hit" value="2hit" wire:click="anotacion('2hit')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="2hit">2 Hits</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="dos" id="3hit" name="hit" value="3hit" wire:click="anotacion('3hit')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="3hit">3 Hits</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="dos" id="4hit" name="hit" value="4hit" wire:click="anotacion('4hit')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="4hit">4 Hit</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="dos" id="5hit" name="hit" value="5hit" wire:click="anotacion('5hit')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="5hit">5 Hits</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="dos" id="6hit" name="hit" value="6hit" wire:click="anotacion('6hit')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="6hit">6 Hits</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="tres" id="1doble" name="doble" value="1doble" wire:click="anotacion('1doble')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="1doble">1 Doble</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="tres" id="2doble" name="doble" value="2doble" wire:click="anotacion('2doble')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="2doble">2 Dobles</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="tres" id="3doble" name="doble" value="3doble" wire:click="anotacion('3doble')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="3doble">3 Dobles</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="tres" id="4doble" name="doble" value="4doble" wire:click="anotacion('4doble')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="4doble">4 Dobles</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="tres" id="5doble" name="doble" value="5doble" wire:click="anotacion('5doble')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="5doble">5 Dobles</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="tres" id="6doble" name="doble" value="6doble" wire:click="anotacion('6doble')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="6doble">6 Dobles</label>
                            </div>
                        </div>
                    </div>
                    <div class="bg-blue-100 rounded p-2">
                        <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-2 my-2 p-2 rounded">
                            <div class="mb-0">
                                <input wire:model="cinco" id="1jonron" name="jonron" value="1jonron" wire:click="anotacion('1jonron')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="1jonron">1 Jonron</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="cinco" id="2jonron" name="jonron" value="2jonron" wire:click="anotacion('2jonron')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="2jonron">2 Jonrones</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="cinco" id="3jonron" name="jonron" value="3jonron" wire:click="anotacion('3jonron')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="3jonron">3 Jonrones</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="cinco" id="4jonron" name="jonron" value="4jonron" wire:click="anotacion('4jonron')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="4jonron">4 Jonrones</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="cinco" id="5jonron" name="jonron" value="5jonron" wire:click="anotacion('5jonron')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="5jonron">5 Jonrones</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="cinco" id="6jonron" name="jonron" value="6jonron" wire:click="anotacion('6jonron')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="6jonron">6 Jonrones</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="cuatro" id="1triple" name="triple" value="1triple" wire:click="anotacion('1triple')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="1triple">1 Triple</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="cuatro" id="2triple" name="triple" value="2triple" wire:click="anotacion('2triple')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="2triple">2 Triples</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="cuatro" id="3triple" name="triple" value="3triple" wire:click="anotacion('3triple')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="3triple">3 Triples</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="cuatro" id="4triple" name="triple" value="4triple" wire:click="anotacion('4triple')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="4triple">4 Triples</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="cuatro" id="5triple" name="triple" value="5triple" wire:click="anotacion('5triple')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="5triple">5 Triples</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="cuatro" id="6triple" name="triple" value="6triple" wire:click="anotacion('6triple')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="6triple">6 Triples</label>
                            </div>
                        </div>
                    </div>
                    <div class="bg-green-100 rounded p-2">
                        <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-2 my-2 p-2 rounded">
                            <div class="mb-0">
                                <input wire:model="diez" id="1anotada" name="anotada" value="1anotada" wire:click="anotacion('1anotada')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="1anotada">1 Anotada</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="diez" id="2anotada" name="anotada" value="2anotada" wire:click="anotacion('2anotada')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="2anotada">2 Anotadas</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="diez" id="3anotada" name="anotada" value="3anotada" wire:click="anotacion('3anotada')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="3anotada">3 Anotadas</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="diez" id="4anotada" name="anotada" value="4anotada" wire:click="anotacion('4anotada')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="4anotada">4 Anotadas</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="diez" id="1anotada" name="anotada" value="5anotada" wire:click="anotacion('5anotada')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="5anotada">5 Anotadas</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="diez" id="6anotada" name="anotada" value="6anotada" wire:click="anotacion('6anotada')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="6anotada">6 Anotadas</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="once" id="1impulsada" name="impulsada" value="1impulsada" wire:click="anotacion('1impulsada')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="1impulsada">1 Impulsada</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="once" id="2impulsada" name="impulsada" value="2impulsada" wire:click="anotacion('2impulsada')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="2impulsada">2 Impulsadas</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="once" id="3impulsada" name="impulsada" value="3impulsada" wire:click="anotacion('3impulsada')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="3impulsada">3 Impulsadas</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="once" id="4impulsada" name="impulsada" value="4impulsada" wire:click="anotacion('4impulsada')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="4impulsada">4 Impulsadas</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="once" id="5impulsada" name="impulsada" value="5impulsada" wire:click="anotacion('5impulsada')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="5impulsada">5 Impulsadas</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="once" id="6impulsada" name="impulsada" value="6impulsada" wire:click="anotacion('6impulsada')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="6impulsada">6 Impulsadas</label>
                            </div>
                        </div>
                    </div>
                    <div class="bg-blue-100 rounded p-2">
                        <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-2 my-2 p-2 rounded">
                            <div class="mb-0">
                                <input wire:model="doce" id="0robo" name="robo" value="0robo" wire:click="anotacion('0robo')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="0robo">0 Robo</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="doce" id="7robo" name="robo" value="7robo" wire:click="anotacion('7robo')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="7robo">7 Robos</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="doce" id="8robo" name="robo" value="8robo" wire:click="anotacion('8robo')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="8robo">8 Robos</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="doce" id="9robo" name="robo" value="9robo" wire:click="anotacion('9robo')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="9robo">9 Robos</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="doce" id="10robo" name="robo" value="10robo" wire:click="anotacion('10robo')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="10robo">10 Robos</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="once" id="0impulsada" name="impulsada" value="0impulsada" wire:click="anotacion('0impulsada')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="0">0 Impulsada</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="once" id="7impulsada" name="impulsada" value="7impulsada" wire:click="anotacion('7impulsada')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="7impulsada">7 Impulsadas</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="once" id="8impulsada" name="impulsada" value="8impulsada" wire:click="anotacion('8impulsada')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="8impulsada">8 Impulsadas</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="once" id="9impulsada" name="impulsada" value="9impulsada" wire:click="anotacion('9impulsada')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="9impulsada">9 Impulsadas</label>
                            </div>
                            <div class="mb-0">
                                <input wire:model="once" id="10impulsada" name="impulsada" value="10impulsada" wire:click="anotacion('10impulsada')" type="radio" class="h-4 w-4 border-blue-300 text-red-600 focus:ring-red-500">
                                <label for="10impulsada">10 Impulsadas</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full mb-4">
                    <x-boton-primario wire:click="update_bateo" wire:loading.attr="disabled" class="disabled:opacity-25 ml-2">
                        {{ __('Actualizar Bateo') }}
                    </x-boton-primario>    
                </div>

                <div class="grid grid-cols-1 md:grid-cols-5 lg:grid-cols-5 gap-2 my-2 p-2 rounded">
                    <div class="mb-0">
                        <x-label value="Posición" />
                        <x-input type="text" class="w-full" wire:model.defer="posicion_crear_express" />
                        <x-input-error for="posicion_crear_express"/>
                    </div>   
                    <div class="mb-0">
                        <x-label value="Inning" />
                        <x-input type="text" class="w-full" wire:model.defer="innings_crear_express" />
                        <x-input-error for="innings_crear_express"/>
                    </div>   
                    <div class="mb-0">
                        <x-label value="Outs" />
                        <x-input type="text" class="w-full" wire:model.defer="outs_crear_express" />
                        <x-input-error for="outs_crear_express"/>
                    </div>   
                    <div class="mb-0">
                        <x-label value="Asistencias" />
                        <x-input type="text" class="w-full" wire:model.defer="asistencias_crear_express" />
                        <x-input-error for="asistencias_crear_express"/>
                    </div>   
                    <div class="mb-0">
                        <x-label value="Errores" />
                        <x-input type="text" class="w-full" wire:model.defer="errores_crear_express" />
                        <x-input-error for="errores_crear_express"/>
                    </div>
                </div>
                <div class="w-full mb-4">
                    <x-boton-primario wire:click="update_crear_defensa_express" wire:loading.attr="disabled" class="disabled:opacity-25 ml-2">
                        {{ __('Crear Defensa') }}
                    </x-boton-primario>    
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-boton-primario wire:click="$set('open_cargar_bateo', false)">
                    {{ __('Cerrar Ventana') }}
                </x-boton-primario>
            </x-slot>
        </x-modal-ancho>

        <x-modal-ancho  wire:model="open_cargar_colmena">
            <x-slot name="title">
                {{ __('Bateo') }}
            </x-slot>
            <x-slot name="content">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2 my-2 p-2 rounded">
                    <div class="mb-0">
                        <x-label value="{{ __('Nombre') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="nombre_bateo" disabled/>
                        <x-input-error for="nombre_bateo"/>
                    </div>
                    <div class="mb-0">
                        <x-label value="{{ __('Equipo') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="equipo_bateo" disabled/>
                        <x-input-error for="equipo_bateo"/>
                    </div>   
                    <div class="mb-0">
                        <x-label value="Orden al Bate" />
                        <x-input type="text" class="w-full" wire:model.defer="orden_bat" />
                        <x-input-error for="orden_bat"/>
                    </div>
                    <div class="mb-0">
                        <x-label value="Posición" />
                        <x-input type="text" class="w-full" wire:model.defer="posicion_defensa" />
                        <x-input-error for="posicion_defensa"/>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-6 lg:grid-cols-6 gap-2 my-2 p-2 rounded">
                    <div class="bg-blue-100 rounded p-2">
                        <span class="text-base font-semi-bold leading-normal">1er Turno</span>
                        <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-2 my-2 p-2 rounded">
                            <div class="mb-0">
                                <x-label value="{{ __('Acción 1') }}" />
                                <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="accion11">
                                    <option value=""></option>
                                    <option value="99">Out</option>
                                    <option value="1">Hit</option>
                                    <option value="2">Doble</option>
                                    <option value="3">Triple</option>
                                    <option value="4">Jonron</option>
                                    <option value="5">Ponche</option>
                                    <option value="6">Boleto</option>
                                    <option value="7">Golpeado</option>
                                    <option value="8">Sacrificio</option>
                                </select>
                                <x-input-error for="accion11" />
                            </div>
                            <div class="mb-0">
                                <x-label value="{{ __('Acción 2') }}" />
                                <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="accion12">
                                    <option value=""></option>
                                    <option value="robo">Robo</option>
                                </select>
                                <x-input-error for="accion12" />
                            </div>
                            <div class="mb-0">
                                <x-label value="{{ __('Acción 3') }}" />
                                <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="accion13">
                                    <option value=""></option>
                                    <option value="robo">Robo</option>
                                </select>
                                <x-input-error for="accion13" />
                            </div>
                            <div class="mb-0">
                                <x-label value="{{ __('Acción 4') }}" />
                                <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="accion14">
                                    <option value=""></option>
                                    <option value="robo">Robo</option>
                                </select>
                                <x-input-error for="accion14" />
                            </div>
                            <div class="mb-0">
                                <x-label value="{{ __('Acción 5') }}" />
                                <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="accion15">
                                    <option value=""></option>
                                    <option value="anotada">Anotada</option>
                                </select>
                                <x-input-error for="accion15" />
                            </div>
                            <div class="mb-0">
                                <x-label value="{{ __('Acción 6') }}" />
                                <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="accion16">
                                    <option value=""></option>
                                    <option value="empujo1">1 Impulsada</option>
                                    <option value="empujo2">2 Impulsadas</option>
                                    <option value="empujo3">3 Impulsadas</option>
                                    <option value="empujo4">4 Impulsadas</option>
                                </select>
                                <x-input-error for="accion16" />
                            </div>
                        </div>
                    </div>
                    <div class="bg-green-100 rounded p-2">
                        <span class="text-base font-semi-bold leading-normal">2do Turno</span>
                        <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-2 my-2 p-2 rounded">
                            <div class="mb-0">
                                <x-label value="{{ __('Acción 1') }}" />
                                <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="accion21">
                                    <option value=""></option>
                                    <option value="99">Out</option>
                                    <option value="1">Hit</option>
                                    <option value="2">Doble</option>
                                    <option value="3">Triple</option>
                                    <option value="4">Jonron</option>
                                    <option value="5">Ponche</option>
                                    <option value="6">Boleto</option>
                                    <option value="7">Golpeado</option>
                                    <option value="8">Sacrificio</option>
                                </select>
                                <x-input-error for="accion21" />
                            </div>
                            <div class="mb-0">
                                <x-label value="{{ __('Acción 2') }}" />
                                <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="accion22">
                                    <option value=""></option>
                                    <option value="robo">Robo</option>
                                </select>
                                <x-input-error for="accion22" />
                            </div>
                            <div class="mb-0">
                                <x-label value="{{ __('Acción 3') }}" />
                                <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="accion23">
                                    <option value=""></option>
                                    <option value="robo">Robo</option>
                                </select>
                                <x-input-error for="accion23" />
                            </div>
                            <div class="mb-0">
                                <x-label value="{{ __('Acción 4') }}" />
                                <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="accion24">
                                    <option value=""></option>
                                    <option value="robo">Robo</option>
                                </select>
                                <x-input-error for="accion24" />
                            </div>
                            <div class="mb-0">
                                <x-label value="{{ __('Acción 5') }}" />
                                <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="accion25">
                                    <option value=""></option>
                                    <option value="anotada">Anotada</option>
                                </select>
                                <x-input-error for="accion25" />
                            </div>
                            <div class="mb-0">
                                <x-label value="{{ __('Acción 6') }}" />
                                <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="accion26">
                                    <option value=""></option>
                                    <option value="empujo1">1 Impulsada</option>
                                    <option value="empujo2">2 Impulsadas</option>
                                    <option value="empujo3">3 Impulsadas</option>
                                    <option value="empujo4">4 Impulsadas</option>
                                </select>
                                <x-input-error for="accion26" />
                            </div>
                        </div>
                    </div>
                    <div class="bg-blue-100 rounded p-2">
                        <span class="text-base font-semi-bold leading-normal">3er Turno</span>
                        <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-2 my-2 p-2 rounded">
                            <div class="mb-0">
                                <x-label value="{{ __('Acción 1') }}" />
                                <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="accion31">
                                    <option value=""></option>
                                    <option value="99">Out</option>
                                    <option value="1">Hit</option>
                                    <option value="2">Doble</option>
                                    <option value="3">Triple</option>
                                    <option value="4">Jonron</option>
                                    <option value="5">Ponche</option>
                                    <option value="6">Boleto</option>
                                    <option value="7">Golpeado</option>
                                    <option value="8">Sacrificio</option>
                                </select>
                                <x-input-error for="accion31" />
                            </div>
                            <div class="mb-0">
                                <x-label value="{{ __('Acción 2') }}" />
                                <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="accion32">
                                    <option value=""></option>
                                    <option value="robo">Robo</option>
                                </select>
                                <x-input-error for="accion32" />
                            </div>
                            <div class="mb-0">
                                <x-label value="{{ __('Acción 3') }}" />
                                <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="accion33">
                                    <option value=""></option>
                                    <option value="robo">Robo</option>
                                </select>
                                <x-input-error for="accion33" />
                            </div>
                            <div class="mb-0">
                                <x-label value="{{ __('Acción 4') }}" />
                                <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="accion34">
                                    <option value=""></option>
                                    <option value="robo">Robo</option>
                                </select>
                                <x-input-error for="accion34" />
                            </div>
                            <div class="mb-0">
                                <x-label value="{{ __('Acción 5') }}" />
                                <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="accion35">
                                    <option value=""></option>
                                    <option value="anotada">Anotada</option>
                                </select>
                                <x-input-error for="accion35" />
                            </div>
                            <div class="mb-0">
                                <x-label value="{{ __('Acción 6') }}" />
                                <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="accion36">
                                    <option value=""></option>
                                    <option value="empujo1">1 Impulsada</option>
                                    <option value="empujo2">2 Impulsadas</option>
                                    <option value="empujo3">3 Impulsadas</option>
                                    <option value="empujo4">4 Impulsadas</option>
                                </select>
                                <x-input-error for="accion36" />
                            </div>
                        </div>
                    </div>
                    <div class="bg-green-100 rounded p-2">
                        <span class="text-base font-semi-bold leading-normal">4to Turno</span>
                        <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-2 my-2 p-2 rounded">
                            <div class="mb-0">
                                <x-label value="{{ __('Acción 1') }}" />
                                <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="accion41">
                                    <option value=""></option>
                                    <option value="99">Out</option>
                                    <option value="1">Hit</option>
                                    <option value="2">Doble</option>
                                    <option value="3">Triple</option>
                                    <option value="4">Jonron</option>
                                    <option value="5">Ponche</option>
                                    <option value="6">Boleto</option>
                                    <option value="7">Golpeado</option>
                                    <option value="8">Sacrificio</option>
                                </select>
                                <x-input-error for="accion41" />
                            </div>
                            <div class="mb-0">
                                <x-label value="{{ __('Acción 2') }}" />
                                <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="accion42">
                                    <option value=""></option>
                                    <option value="robo">Robo</option>
                                </select>
                                <x-input-error for="accion42" />
                            </div>
                            <div class="mb-0">
                                <x-label value="{{ __('Acción 3') }}" />
                                <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="accion43">
                                    <option value=""></option>
                                    <option value="robo">Robo</option>
                                </select>
                                <x-input-error for="accion43" />
                            </div>
                            <div class="mb-0">
                                <x-label value="{{ __('Acción 4') }}" />
                                <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="accion44">
                                    <option value=""></option>
                                    <option value="robo">Robo</option>
                                </select>
                                <x-input-error for="accion44" />
                            </div>
                            <div class="mb-0">
                                <x-label value="{{ __('Acción 5') }}" />
                                <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="accion45">
                                    <option value=""></option>
                                    <option value="anotada">Anotada</option>
                                </select>
                                <x-input-error for="accion45" />
                            </div>
                            <div class="mb-0">
                                <x-label value="{{ __('Acción 6') }}" />
                                <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="accion46">
                                    <option value=""></option>
                                    <option value="empujo1">1 Impulsada</option>
                                    <option value="empujo2">2 Impulsadas</option>
                                    <option value="empujo3">3 Impulsadas</option>
                                    <option value="empujo4">4 Impulsadas</option>
                                </select>
                                <x-input-error for="accion46" />
                            </div>
                        </div>
                    </div>
                    <div class="bg-blue-100 rounded p-2">
                        <span class="text-base font-semi-bold leading-normal">5to Turno</span>
                        <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-2 my-2 p-2 rounded">
                            <div class="mb-0">
                                <x-label value="{{ __('Acción 1') }}" />
                                <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="accion51">
                                    <option value=""></option>
                                    <option value="99">Out</option>
                                    <option value="1">Hit</option>
                                    <option value="2">Doble</option>
                                    <option value="3">Triple</option>
                                    <option value="4">Jonron</option>
                                    <option value="5">Ponche</option>
                                    <option value="6">Boleto</option>
                                    <option value="7">Golpeado</option>
                                    <option value="8">Sacrificio</option>
                                </select>
                                <x-input-error for="accion51" />
                            </div>
                            <div class="mb-0">
                                <x-label value="{{ __('Acción 2') }}" />
                                <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="accion52">
                                    <option value=""></option>
                                    <option value="robo">Robo</option>
                                </select>
                                <x-input-error for="accion52" />
                            </div>
                            <div class="mb-0">
                                <x-label value="{{ __('Acción 3') }}" />
                                <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="accion53">
                                    <option value=""></option>
                                    <option value="robo">Robo</option>
                                </select>
                                <x-input-error for="accion53" />
                            </div>
                            <div class="mb-0">
                                <x-label value="{{ __('Acción 4') }}" />
                                <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="accion54">
                                    <option value=""></option>
                                    <option value="robo">Robo</option>
                                </select>
                                <x-input-error for="accion54" />
                            </div>
                            <div class="mb-0">
                                <x-label value="{{ __('Acción 5') }}" />
                                <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="accion55">
                                    <option value=""></option>
                                    <option value="anotada">Anotada</option>
                                </select>
                                <x-input-error for="accion55" />
                            </div>
                            <div class="mb-0">
                                <x-label value="{{ __('Acción 6') }}" />
                                <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="accion56">
                                    <option value=""></option>
                                    <option value="empujo1">1 Impulsada</option>
                                    <option value="empujo2">2 Impulsadas</option>
                                    <option value="empujo3">3 Impulsadas</option>
                                    <option value="empujo4">4 Impulsadas</option>
                                </select>
                                <x-input-error for="accion56" />
                            </div>
                        </div>
                    </div>
                    <div class="bg-green-100 rounded p-2">
                        <span class="text-base font-semi-bold leading-normal">6to Turno</span>
                        <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-2 my-2 p-2 rounded">
                            <div class="mb-0">
                                <x-label value="{{ __('Acción 1') }}" />
                                <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="accion61">
                                    <option value=""></option>
                                    <option value="99">Out</option>
                                    <option value="1">Hit</option>
                                    <option value="2">Doble</option>
                                    <option value="3">Triple</option>
                                    <option value="4">Jonron</option>
                                    <option value="5">Ponche</option>
                                    <option value="6">Boleto</option>
                                    <option value="7">Golpeado</option>
                                    <option value="8">Sacrificio</option>
                                </select>
                                <x-input-error for="accion61" />
                            </div>
                            <div class="mb-0">
                                <x-label value="{{ __('Acción 2') }}" />
                                <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="accion62">
                                    <option value=""></option>
                                    <option value="robo">Robo</option>
                                </select>
                                <x-input-error for="accion62" />
                            </div>
                            <div class="mb-0">
                                <x-label value="{{ __('Acción 3') }}" />
                                <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="accion63">
                                    <option value=""></option>
                                    <option value="robo">Robo</option>
                                </select>
                                <x-input-error for="accion63" />
                            </div>
                            <div class="mb-0">
                                <x-label value="{{ __('Acción 4') }}" />
                                <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="accion64">
                                    <option value=""></option>
                                    <option value="robo">Robo</option>
                                </select>
                                <x-input-error for="accion64" />
                            </div>
                            <div class="mb-0">
                                <x-label value="{{ __('Acción 5') }}" />
                                <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="accion65">
                                    <option value=""></option>
                                    <option value="anotada">Anotada</option>
                                </select>
                                <x-input-error for="accion65" />
                            </div>
                            <div class="mb-0">
                                <x-label value="{{ __('Acción 6') }}" />
                                <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="accion66">
                                    <option value=""></option>
                                    <option value="empujo1">1 Impulsada</option>
                                    <option value="empujo2">2 Impulsadas</option>
                                    <option value="empujo3">3 Impulsadas</option>
                                    <option value="empujo4">4 Impulsadas</option>
                                </select>
                                <x-input-error for="accion66" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full mb-4 mt-4">
                    <x-boton-primario wire:click="update_colmena" wire:loading.attr="disabled" class="disabled:opacity-25 ml-2">
                        {{ __('Actualizar') }}
                    </x-boton-primario>    
                </div>

                <span class="text-2xl font-semi-bold leading-normal">Defensa</span>
                <div class="grid grid-cols-1 md:grid-cols-5 lg:grid-cols-5 gap-2 my-2 p-2 rounded">
                    <div class="mb-0">
                        <x-label value="Posición" />
                        <x-input type="text" class="w-full" wire:model.defer="posicion_crear_express" />
                        <x-input-error for="posicion_crear_express"/>
                    </div>   
                    <div class="mb-0">
                        <x-label value="Inning" />
                        <x-input type="text" class="w-full" wire:model.defer="innings_crear_express" />
                        <x-input-error for="innings_crear_express"/>
                    </div>   
                    <div class="mb-0">
                        <x-label value="Outs" />
                        <x-input type="text" class="w-full" wire:model.defer="outs_crear_express" />
                        <x-input-error for="outs_crear_express"/>
                    </div>   
                    <div class="mb-0">
                        <x-label value="Asistencias" />
                        <x-input type="text" class="w-full" wire:model.defer="asistencias_crear_express" />
                        <x-input-error for="asistencias_crear_express"/>
                    </div>   
                    <div class="mb-0">
                        <x-label value="Errores" />
                        <x-input type="text" class="w-full" wire:model.defer="errores_crear_express" />
                        <x-input-error for="errores_crear_express"/>
                    </div>
                </div>
                <div class="w-full mb-4">
                    <x-boton-primario wire:click="update_crear_defensa_express" wire:loading.attr="disabled" class="disabled:opacity-25 ml-2">
                        {{ __('Crear Defensa') }}
                    </x-boton-primario>    
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-boton-primario wire:click="$set('open_cargar_colmena', false)">
                    {{ __('Cerrar Ventana') }}
                </x-boton-primario>
            </x-slot>
        </x-modal-ancho>

        <x-dialog-modal wire:model="open_cargar_pitcheo">
            <x-slot name="title">
                {{ __('Pitcheo') }}
            </x-slot>
            <x-slot name="content">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2 my-2 p-2 rounded">
                    <div class="mb-4">
                        <x-label value="{{ __('Nombre') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="nombre_pitcheo" disabled/>
                        <x-input-error for="nombre_pitcheo"/>
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Equipo') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="equipo_pitcheo" disabled/>
                        <x-input-error for="equipo_pitcheo"/>
                    </div>   
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-2 my-2 p-2 rounded">
                    <div class="mb-4">
                        <x-label value="Número de Pitcheos" />
                        <x-input type="text" class="w-full" wire:model.defer="pitcheos" />
                        <x-input-error for="pitcheos"/>
                    </div>
                    <div class="mb-4">
                        <x-label value="Iniciado" />
                        <x-input type="text" class="w-full" wire:model.defer="iniciados" />
                        <x-input-error for="iniciados"/>
                    </div>   
                    <div class="mb-4">
                        <x-label value="Relevo" />
                        <x-input type="text" class="w-full" wire:model.defer="relevos" />
                        <x-input-error for="relevos"/>
                    </div>   
                    <div class="mb-4">
                        <x-label value="Completo" />
                        <x-input type="text" class="w-full" wire:model.defer="completos" />
                        <x-input-error for="completos"/>
                    </div>   
                    <div class="mb-4">
                        <x-label value="Ganado" />
                        <x-input type="text" class="w-full" wire:model.defer="ganados" />
                        <x-input-error for="ganados"/>
                    </div>   
                    <div class="mb-4">
                        <x-label value="Perdido" />
                        <x-input type="text" class="w-full" wire:model.defer="perdidos" />
                        <x-input-error for="perdidos"/>
                    </div>   
                    <div class="mb-4">
                        <x-label value="Salvado" />
                        <x-input type="text" class="w-full" wire:model.defer="salvados" />
                        <x-input-error for="salvados"/>
                    </div>
                    <div class="mb-4">
                        <x-label value="Veces al Bate" />
                        <x-input type="text" class="w-full" wire:model.defer="veces_bate" />
                        <x-input-error for="veces_bate"/>
                    </div>
                    <div class="mb-4">
                        <x-label value="Hits" />
                        <x-input type="text" class="w-full" wire:model.defer="hp" />
                        <x-input-error for="hp"/>
                    </div>
                    <div class="mb-4">
                        <x-label value="Dobles" />
                        <x-input type="text" class="w-full" wire:model.defer="h2" />
                        <x-input-error for="h2"/>
                    </div>
                    <div class="mb-4">
                        <x-label value="Triples" />
                        <x-input type="text" class="w-full" wire:model.defer="h3" />
                        <x-input-error for="h3"/>
                    </div>
                    <div class="mb-4">
                        <x-label value="Jonrones" />
                        <x-input type="text" class="w-full" wire:model.defer="h4" />
                        <x-input-error for="h4"/>
                    </div>
                    <div class="mb-4">
                        <x-label value="Innings" />
                        <x-input type="text" class="w-full" wire:model.defer="ip" />
                        <x-input-error for="ip"/>
                    </div>   
                    <div class="mb-4">
                        <x-label value="Carreras Permitidas" />
                        <x-input type="text" class="w-full" wire:model.defer="carreras_permitidas" />
                        <x-input-error for="carreras_permitidas"/>
                    </div>   
                    <div class="mb-4">
                        <x-label value="Carreras Limpias" />
                        <x-input type="text" class="w-full" wire:model.defer="carreras_limpias" />
                        <x-input-error for="carreras_limpias"/>
                    </div>   
                    <div class="mb-4">
                        <x-label value="Ponches" />
                        <x-input type="text" class="w-full" wire:model.defer="ponches_propinados" />
                        <x-input-error for="ponches_propinados"/>
                    </div>   
                    <div class="mb-4">
                        <x-label value="Boletos" />
                        <x-input type="text" class="w-full" wire:model.defer="boletos_otorgados" />
                        <x-input-error for="boletos_otorgados"/>
                    </div>   
                    <div class="mb-4">
                        <x-label value="Golpeados" />
                        <x-input type="text" class="w-full" wire:model.defer="gp" />
                        <x-input-error for="gp"/>
                    </div>   
                    <div class="mb-4">
                        <x-label value="WP" />
                        <x-input type="text" class="w-full" wire:model.defer="wp" />
                        <x-input-error for="wp"/>
                    </div>   
                    <div class="mb-4">
                        <x-label value="Blanqueo" />
                        <x-input type="text" class="w-full" wire:model.defer="bk" />
                        <x-input-error for="bk"/>
                    </div>
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button wire:click="$set('open_cargar_pitcheo', false)">
                    {{ __('Cancelar') }}
                </x-secondary-button>
                <x-boton-primario wire:click="update_pitcheo" wire:loading.attr="disabled" class="disabled:opacity-25 ml-2">
                    {{ __('Actualizar') }}
                </x-boton-primario>
            </x-slot>
        </x-dialog-modal>

        <x-dialog-modal wire:model="open_crear_defensa">
            <x-slot name="title">
                {{ __('Defensa') }}
            </x-slot>
            <x-slot name="content">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2 my-2 p-2 rounded">
                    <div class="mb-4">
                        <x-label value="{{ __('Nombre') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="nombre_defensa_crear" disabled/>
                        <x-input-error for="nombre_defensa_crear"/>
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Equipo') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="equipo_defensa_crear" disabled/>
                        <x-input-error for="equipo_defensa_crear"/>
                    </div>   
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2 my-2 p-2 rounded">
                    <div class="mb-4">
                        <x-label value="Posición" />
                        <x-input type="text" class="w-full" wire:model.defer="posicion_crear" />
                        <x-input-error for="posicion_crear"/>
                    </div>   
                    <div class="mb-4">
                        <x-label value="Inning" />
                        <x-input type="text" class="w-full" wire:model.defer="innings_crear" />
                        <x-input-error for="innings_crear"/>
                    </div>   
                    <div class="mb-4">
                        <x-label value="Outs" />
                        <x-input type="text" class="w-full" wire:model.defer="outs_crear" />
                        <x-input-error for="outs_crear"/>
                    </div>   
                    <div class="mb-4">
                        <x-label value="Asistencias" />
                        <x-input type="text" class="w-full" wire:model.defer="asistencias_crear" />
                        <x-input-error for="asistencias_crear"/>
                    </div>   
                    <div class="mb-4">
                        <x-label value="Errores" />
                        <x-input type="text" class="w-full" wire:model.defer="errores_crear" />
                        <x-input-error for="errores_crear"/>
                    </div>   
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button wire:click="$set('open_crear_defensa', false)">
                    {{ __('Cancelar') }}
                </x-secondary-button>
                <x-boton-primario wire:click="update_crear_defensa" wire:loading.attr="disabled" class="disabled:opacity-25 ml-2">
                    {{ __('Actualizar') }}
                </x-boton-primario>
            </x-slot>
        </x-dialog-modal>

        <x-dialog-modal wire:model="open_edit_defensa">
            <x-slot name="title">
                {{ __('Editar Defensa') }}
            </x-slot>
            <x-slot name="content">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2 my-2 p-2 rounded">
                    <div class="mb-4">
                        <x-label value="{{ __('Nombre') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="nombre_defensa" disabled/>
                        <x-input-error for="nombre_defensa"/>
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Equipo') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="equipo_defensa" disabled/>
                        <x-input-error for="equipo_defensa"/>
                    </div>   
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2 my-2 p-2 rounded">
                    <div class="mb-4">
                        <x-label value="Posición" />
                        <x-input type="text" class="w-full" wire:model.defer="posicion" />
                        <x-input-error for="posicion"/>
                    </div>   
                    <div class="mb-4">
                        <x-label value="Inning" />
                        <x-input type="text" class="w-full" wire:model.defer="innings" />
                        <x-input-error for="innings"/>
                    </div>   
                    <div class="mb-4">
                        <x-label value="Outs" />
                        <x-input type="text" class="w-full" wire:model.defer="outs" />
                        <x-input-error for="outs"/>
                    </div>   
                    <div class="mb-4">
                        <x-label value="Asistencias" />
                        <x-input type="text" class="w-full" wire:model.defer="asistencias" />
                        <x-input-error for="asistencias"/>
                    </div>   
                    <div class="mb-4">
                        <x-label value="Errores" />
                        <x-input type="text" class="w-full" wire:model.defer="errores" />
                        <x-input-error for="errores"/>
                    </div>   
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button wire:click="$set('open_edit_defensa', false)">
                    {{ __('Cancelar') }}
                </x-secondary-button>
                <x-boton-primario wire:click="update_edit_defensa" wire:loading.attr="disabled" class="disabled:opacity-25 ml-2">
                    {{ __('Actualizar') }}
                </x-boton-primario>
            </x-slot>
        </x-dialog-modal>

        <x-dialog-modal wire:model="open_crear_visita">
            <x-slot name="title">
                {{ __('Jugador') }}
            </x-slot>
            <x-slot name="content">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2 my-2 p-2 rounded">
                    <div class="mb-4">
                        <x-label value="{{ __('Equipo') }}" />
                        <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="equipo_crear" >
                            <option value="">Select...</option>
                            @foreach ($lista_equipos as $dato)
                                <option value="{{ $dato->visita_id }}">{{ $dato->calendario_visita->nombre }}</option>
                                <option value="{{ $dato->casa_id }}">{{ $dato->calendario_casa->nombre }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="equipo_crear" />
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Nombre') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="nombre_crear"/>
                        <x-input-error for="nombre_crear"/>
                    </div>
                    <div class="mb-4">
                        <x-label value="{{ __('Número') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="numero_crear"/>
                        <x-input-error for="numero_crear"/>
                    </div>   
                    <div class="mb-4">
                        <x-label value="{{ __('Nacimiento') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="nacimiento_crear"/>
                        <x-input-error for="nacimiento_crear"/>
                    </div>   
                    <div class="mb-4">
                        <x-label value="{{ __('Batea') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="batea_crear"/>
                        <x-input-error for="batea_crear"/>
                    </div>   
                    <div class="mb-4">
                        <x-label value="{{ __('Lanza') }}" />
                        <x-input type="text" class="w-full" wire:model.defer="lanza_crear"/>
                        <x-input-error for="lanza_crear"/>
                    </div>   
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button wire:click="$set('open_crear_visita', false)">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-boton-primario wire:click="save_visita" wire:loading.attr="disabled" wire:target="save" class="disabled:opacity-25 ml-2">
                    {{ __('Registrar') }}
                </x-boton-primario>
            </x-slot>
        </x-dialog-modal>
    </x-layouts.menu-admin>
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
