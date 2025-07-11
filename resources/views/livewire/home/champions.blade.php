<div>
    <x-layouts.menu-home>
        <div class="bg-gray-100 max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <span class="text-2xl font-semi-bold leading-normal">{{ __('Champions') }}</span>
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
            <div style="overflow-x:auto">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 my-4 p-2 rounded">
                    <div class="container flex flex-col items-center justify-center w-full mx-auto">
                        <div class="w-full px-1 py-2 mb-2 fondo-primero border rounded-md shadow sm:px-6 dark:bg-gray-800">
                            <h3 class="text-lg font-medium leading-6 text-white dark:text-white">
                                GOLES
                            </h3>
                        </div>
                        <ul class="w-full flex flex-col">
                            <?php $pos = 1?>
                            @foreach($goles as $dato)
                                @if($dato->goles > 0)
                                    <li class="flex flex-row mb-2 border-gray-400">
                                        <div class="shadow border select-none bg-white dark:bg-gray-800 rounded-md flex flex-1 items-center p-1 px-4">
                                            <div class="flex flex-col items-center justify-center w-10 h-10 mr-4">
                                                {{ $pos }}
                                            </div>
                                            <div class="flex-1 pl-1 md:mr-16">
                                                <div class="font-medium dark:text-white">
                                                    {{ $dato->jugador }}
                                                </div>
                                                <div class="text-sm text-gray-600 dark:text-gray-200">
                                                    {{ $dato->nombre_equipo }}
                                                </div>
                                            </div>
                                            <div class="text-m text-gray-600 dark:text-gray-200">
                                                {{ number_format($dato->goles,0) }}
                                            </div>
                                        </div>
                                    </li>
                                @else
                                    <li class="flex flex-row mb-2 border-gray-400">
                                        <div class="shadow border select-none bg-white dark:bg-gray-800 rounded-md flex flex-1 items-center py-1 px-4">
                                            <div class="flex flex-col items-center justify-center w-10 h-10 mr-4">
                                            </div>
                                            <div class="flex-1 pl-1 md:mr-16">
                                            </div>
                                            <div class="text-m text-gray-600 dark:text-gray-200">
                                            </div>
                                        </div>
                                    </li>
                                @endif
                                <?php $pos = $pos + 1?>
                            @endforeach
                        </ul>
                    </div>
                    <div class="container flex flex-col items-center justify-center w-full mx-auto">
                        <div class="w-full px-1 py-2 mb-2 fondo-primero border rounded-md shadow sm:px-6 dark:bg-gray-800">
                            <h3 class="text-lg font-medium leading-6 text-white dark:text-white">
                                ASISTENCIAS
                            </h3>
                        </div>
                        <ul class="w-full flex flex-col">
                            <?php $pos = 1?>
                            @foreach($asistencias as $dato)
                                @if($dato->asistencias > 0)
                                    <li class="flex flex-row mb-2 border-gray-400">
                                        <div class="shadow border select-none bg-white dark:bg-gray-800 rounded-md flex flex-1 items-center py-1 px-4">
                                            <div class="flex flex-col items-center justify-center w-10 h-10 mr-4">
                                                {{ $pos }}
                                            </div>
                                            <div class="flex-1 pl-1 md:mr-16">
                                                <div class="font-medium dark:text-white">
                                                    {{ $dato->jugador }}
                                                </div>
                                                <div class="text-sm text-gray-600 dark:text-gray-200">
                                                    {{ $dato->nombre_equipo }}
                                                </div>
                                            </div>
                                            <div class="text-m text-gray-600 dark:text-gray-200">
                                                {{ number_format($dato->asistencias,0) }}
                                            </div>
                                        </div>
                                    </li>
                                @else
                                    <li class="flex flex-row mb-2 border-gray-400">
                                        <div class="shadow border select-none bg-white dark:bg-gray-800 rounded-md flex flex-1 items-center py-1 px-4">
                                            <div class="flex flex-col items-center justify-center w-10 h-10 mr-4">
                                            </div>
                                            <div class="flex-1 pl-1 md:mr-16">
                                            </div>
                                            <div class="text-m text-gray-600 dark:text-gray-200">
                                            </div>
                                        </div>
                                    </li>
                                @endif
                                <?php $pos = $pos + 1?>
                            @endforeach
                        </ul>
                    </div>
                    <div class="container flex flex-col items-center justify-center w-full mx-auto">
                        <div class="w-full px-1 py-2 mb-2 fondo-primero border rounded-md shadow sm:px-6 dark:bg-gray-800">
                            <h3 class="text-lg font-medium leading-6 text-white dark:text-white">
                                TIROS AL ARCO
                            </h3>
                        </div>
                        <ul class="w-full flex flex-col">
                            <?php $pos = 1?>
                            @foreach($tiros_arco as $dato)
                                @if($dato->tiros_arco > 0)
                                    <li class="flex flex-row mb-2 border-gray-400">
                                        <div class="shadow border select-none bg-white dark:bg-gray-800 rounded-md flex flex-1 items-center py-1 px-4">
                                            <div class="flex flex-col items-center justify-center w-10 h-10 mr-4">
                                                {{ $pos }}
                                            </div>
                                            <div class="flex-1 pl-1 md:mr-16">
                                                <div class="font-medium dark:text-white">
                                                    {{ $dato->jugador }}
                                                </div>
                                                <div class="text-sm text-gray-600 dark:text-gray-200">
                                                    {{ $dato->nombre_equipo }}
                                                </div>
                                            </div>
                                            <div class="text-m text-gray-600 dark:text-gray-200">
                                                {{ number_format($dato->tiros_arco,0) }}
                                            </div>
                                        </div>
                                    </li>
                                @else
                                    <li class="flex flex-row mb-2 border-gray-400">
                                        <div class="shadow border select-none bg-white dark:bg-gray-800 rounded-md flex flex-1 items-center py-1 px-4">
                                            <div class="flex flex-col items-center justify-center w-10 h-10 mr-4">
                                            </div>
                                            <div class="flex-1 pl-1 md:mr-16">
                                            </div>
                                            <div class="text-m text-gray-600 dark:text-gray-200">
                                            </div>
                                        </div>
                                    </li>
                                @endif
                                <?php $pos = $pos + 1?>
                            @endforeach
                        </ul>
                    </div>
                    <div class="container flex flex-col items-center justify-center w-full mx-auto">
                        <div class="w-full px-1 py-2 mb-2 fondo-primero border rounded-md shadow sm:px-6 dark:bg-gray-800">
                            <h3 class="text-lg font-medium leading-6 text-white dark:text-white">
                                ATAJADAS
                            </h3>
                        </div>
                        <ul class="w-full flex flex-col">
                            <?php $pos = 1?>
                            @foreach($atajadas as $dato)
                                @if($dato->atajadas > 0)
                                    <li class="flex flex-row mb-2 border-gray-400">
                                        <div class="shadow border select-none bg-white dark:bg-gray-800 rounded-md flex flex-1 items-center py-1 px-4">
                                            <div class="flex flex-col items-center justify-center w-10 h-10 mr-4">
                                                {{ $pos }}
                                            </div>
                                            <div class="flex-1 pl-1 md:mr-16">
                                                <div class="font-medium dark:text-white">
                                                    {{ $dato->jugador }}
                                                </div>
                                                <div class="text-sm text-gray-600 dark:text-gray-200">
                                                    {{ $dato->nombre_equipo }}
                                                </div>
                                            </div>
                                            <div class="text-m text-gray-600 dark:text-gray-200">
                                                {{ number_format($dato->atajadas,0) }}
                                            </div>
                                        </div>
                                    </li>
                                @else
                                    <li class="flex flex-row mb-2 border-gray-400">
                                        <div class="shadow border select-none bg-white dark:bg-gray-800 rounded-md flex flex-1 items-center py-1 px-4">
                                            <div class="flex flex-col items-center justify-center w-10 h-10 mr-4">
                                            </div>
                                            <div class="flex-1 pl-1 md:mr-16">
                                            </div>
                                            <div class="text-m text-gray-600 dark:text-gray-200">
                                            </div>
                                        </div>
                                    </li>
                                @endif
                                <?php $pos = $pos + 1?>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-layouts.menu-home>
</div>
