<div>
    <x-layouts.menu-home>
        <div class="bg-gray-100 max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <span class="text-2xl font-semi-bold leading-normal">{{ __('Tabla de Posiciones') }}</span>
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
            <div class="mt-6 bg-white overflow-hidden shadow-xl sm:rounded-lg pt-4 pb-4">
                <div style="overflow-x:auto">
                    <table class="min-w-full xzdivide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr class="fondo-primero text-white">
                                <th scope="col"
                                    class="cursor-pointer px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                    Posición
                                </th>
                                <th scope="col">

                                </th>
                                <th scope="col"
                                    class="cursor-pointer px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                    Equipos
                                </th>
                                <th scope="col"
                                    class="cursor-pointer px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                    Jugados
                                </th>
                                <th scope="col"
                                    class="cursor-pointer px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                    Ganados
                                </th>
                                <th scope="col"
                                    class="cursor-pointer px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                    Perdidos
                                </th>
                                <th scope="col"
                                    class="cursor-pointer px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                    Empatados
                                </th>
                                <th scope="col"
                                    class="cursor-pointer px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                    Puntos
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php $n=1?>
                            @foreach($posiciones as $datos_pos)
                                @if($datos_pos->grupo_id == 10)
                                    <tr>
                                        <td class="px-2 py-2 text-center">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $n }}
                                            </div>
                                        </td>
                                        <?php $n=$n+1?>
                                        @if ($datos_pos->logo == "")
                                            <td class="px-2 py-2">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full"
                                                        src="{{asset('storage/sistema/favicon.png')}}"
                                                        alt="">
                                                </div>
                                            </td>
                                        @else
                                            <td class="px-2 py-2">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full"
                                                            src="{{asset('storage/'.$datos_pos->logo)}}"
                                                            alt="">
                                                </div>
                                            </td>
                                        @endif
                                        <td class="px-2 py-2 text-left">
                                            <div class="text-sm font-medium text-gray-900">{{$datos_pos->posicion_equipo->nombre}}
                                            </div>
                                        </td>
                                        <td class="px-2 py-2 text-center">
                                            <div class="text-sm font-medium text-gray-900">{{$datos_pos->jugados}}
                                            </div>
                                        </td>
                                        <td class="px-2 py-2 text-center">
                                            <div class="text-sm font-medium text-gray-900">{{$datos_pos->ganados}}
                                            </div>
                                        </td>
                                        <td class="px-2 py-2 text-center">
                                            <div class="text-sm font-medium text-gray-900">{{$datos_pos->perdidos}}
                                            </div>
                                        </td>
                                        <td class="px-2 py-2 text-center">
                                            <div class="text-sm font-medium text-gray-900">{{$datos_pos->empatados}}
                                            </div>
                                        </td>
                                        <td class="px-2 py-2 text-center">
                                            <div class="text-sm font-medium text-gray-900">{{number_format($datos_pos->puntos,0)}}
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </x-layouts.menu-home>
</div>