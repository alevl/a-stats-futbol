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
                                {{ __('Defensa') }}
                            </x-nav-link>
                        </div>
                    </div>
                </div>
            </nav>
            <div style="overflow-x:auto">
                @if ($tipo == "bateador")
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 my-4 p-2 rounded">
                        <div class="container flex flex-col items-center justify-center w-full mx-auto">
                            <div class="w-full px-1 py-2 mb-2 fondo-primero border rounded-md shadow sm:px-6 dark:bg-gray-800">
                                <h3 class="text-lg font-medium leading-6 text-white dark:text-white">
                                    AVG
                                </h3>
                            </div>
                            <ul class="w-full flex flex-col">
                                <?php $pos = 1?>
                                @foreach($averages as $dato)
                                    @if($dato->porcentaje_bateo > 0)
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
                                                    {{ number_format($dato->porcentaje_bateo,0) }}
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
                                    HITS
                                </h3>
                            </div>
                            <ul class="w-full flex flex-col">
                                <?php $pos = 1?>
                                @foreach($hits as $dato)
                                    @if($dato->hit > 0)
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
                                                    {{ number_format($dato->hit,0) }}
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
                                    DOBLES
                                </h3>
                            </div>
                            <ul class="w-full flex flex-col">
                                <?php $pos = 1?>
                                @foreach($dobles as $dato)
                                    @if($dato->dobles > 0)
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
                                                    {{ number_format($dato->dobles,0) }}
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
                                    TRIPLES
                                </h3>
                            </div>
                            <ul class="w-full flex flex-col">
                                <?php $pos = 1?>
                                @foreach($triples as $dato)
                                    @if($dato->triples > 0)
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
                                                    {{ number_format($dato->triples,0) }}
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
                                    JONRONES
                                </h3>
                            </div>
                            <ul class="w-full flex flex-col">
                                <?php $pos = 1?>
                                @foreach($jonrones as $dato)
                                    @if($dato->hr > 0)
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
                                                    {{ number_format($dato->hr,0) }}
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
                                    CARRERAS ANOTADAS
                                </h3>
                            </div>
                            <ul class="w-full flex flex-col">
                                <?php $pos = 1?>
                                @foreach($anotadas as $dato)
                                    @if($dato->anotadas > 0)
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
                                                    {{ number_format($dato->anotadas,0) }}
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
                                    CARRERAS IMPULSADAS
                                </h3>
                            </div>
                            <ul class="w-full flex flex-col">
                                <?php $pos = 1?>
                                @foreach($impulsadas as $dato)
                                    @if($dato->rbi > 0)
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
                                                    {{ number_format($dato->rbi,0) }}
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
                                    BASES ROBADAS
                                </h3>
                            </div>
                            <ul class="w-full flex flex-col">
                                <?php $pos = 1?>
                                @foreach($robos as $dato)
                                    @if($dato->robadas > 0)
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
                                                    {{ number_format($dato->robadas,0) }}
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
                                    BASE POR BOLAS
                                </h3>
                            </div>
                            <ul class="w-full flex flex-col">
                                <?php $pos = 1?>
                                @foreach($boletos as $dato)
                                    @if($dato->boletos_recibidos > 0)
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
                                                    {{ number_format($dato->boletos_recibidos,0) }}
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
                @else
                    @if($tipo == "pitcher")
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 my-4 p-2 rounded">
                            <div class="container flex flex-col items-center justify-center w-full mx-auto">
                                <div class="w-full px-1 py-2 mb-2 fondo-primero border rounded-md shadow sm:px-6 dark:bg-gray-800">
                                    <h3 class="text-lg font-medium leading-6 text-white dark:text-white">
                                        EFECTIVIDAD
                                    </h3>
                                </div>
                                <ul class="w-full flex flex-col">
                                    <?php $pos = 1?>
                                    @foreach($efectividad as $dato)
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
                                                    {{ number_format($dato->porcentaje_efectividad,2) }}
                                                </div>
                                            </div>
                                        </li>
                                        <?php $pos = $pos + 1?>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="container flex flex-col items-center justify-center w-full mx-auto">
                                <div class="w-full px-1 py-2 mb-2 fondo-primero border rounded-md shadow sm:px-6 dark:bg-gray-800">
                                    <h3 class="text-lg font-medium leading-6 text-white dark:text-white">
                                        JUEGOS GANADOS
                                    </h3>
                                </div>
                                <ul class="w-full flex flex-col">
                                    <?php $pos = 1?>
                                    @foreach($ganados as $dato)
                                        @if($dato->ganados > 0)
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
                                                        {{ number_format($dato->ganados,0) }}
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
                                        PONCHES PROPINADOS
                                    </h3>
                                </div>
                                <ul class="w-full flex flex-col">
                                    <?php $pos = 1?>
                                    @foreach($ponches as $dato)
                                        @if($dato->ponches_propinados > 0)
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
                                                        {{ number_format($dato->ponches_propinados,0) }}
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
                                        INNINGS PITCHADOS
                                    </h3>
                                </div>
                                <ul class="w-full flex flex-col">
                                    <?php $pos = 1?>
                                    @foreach($innings as $dato)
                                        @if($dato->ip > 0)
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
                                                        {{ number_format($dato->ip,2) }}
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
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 my-4 p-2 rounded">
                            <div class="container flex flex-col items-center justify-center w-full mx-auto">
                                <div class="w-full px-1 py-2 mb-2 fondo-primero border rounded-md shadow sm:px-6 dark:bg-gray-800">
                                    <h3 class="text-lg font-medium leading-6 text-white dark:text-white">
                                        CATCHERS
                                    </h3>
                                </div>
                                <ul class="w-full flex flex-col">
                                    <?php $pos = 1?>
                                    @foreach($receptores as $dato)
                                        @if($dato->porcentaje_defensa > 0)
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
                                                        {{ number_format($dato->porcentaje_defensa,0) }}
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
                                        PRIMERA BASE
                                    </h3>
                                </div>
                                <ul class="w-full flex flex-col">
                                    <?php $pos = 1?>
                                    @foreach($primeras as $dato)
                                        @if($dato->porcentaje_defensa > 0)
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
                                                        {{ number_format($dato->porcentaje_defensa,0) }}
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
                                        SEGUNDA BASE
                                    </h3>
                                </div>
                                <ul class="w-full flex flex-col">
                                    <?php $pos = 1?>
                                    @foreach($segundas as $dato)
                                        @if($dato->porcentaje_defensa > 0)
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
                                                        {{ number_format($dato->porcentaje_defensa,0) }}
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
                                        TERCERA BASE
                                    </h3>
                                </div>
                                <ul class="w-full flex flex-col">
                                    <?php $pos = 1?>
                                    @foreach($terceras as $dato)
                                        @if($dato->porcentaje_defensa > 0)
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
                                                        {{ number_format($dato->porcentaje_defensa,0) }}
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
                                        SHORT STOP
                                    </h3>
                                </div>
                                <ul class="w-full flex flex-col">
                                    <?php $pos = 1?>
                                    @foreach($shorts as $dato)
                                        @if($dato->porcentaje_defensa > 0)
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
                                                        {{ number_format($dato->porcentaje_defensa,0) }}
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
                                        LEFT FIELD
                                    </h3>
                                </div>
                                <ul class="w-full flex flex-col">
                                    <?php $pos = 1?>
                                    @foreach($lefts as $dato)
                                        @if($dato->porcentaje_defensa > 0)
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
                                                        {{ number_format($dato->porcentaje_defensa,0) }}
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
                                        CENTER FIELD
                                    </h3>
                                </div>
                                <ul class="w-full flex flex-col">
                                    <?php $pos = 1?>
                                    @foreach($centers as $dato)
                                        @if($dato->porcentaje_defensa > 0)
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
                                                        {{ number_format($dato->porcentaje_defensa,0) }}
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
                                        RIGHT FIELD
                                    </h3>
                                </div>
                                <ul class="w-full flex flex-col">
                                    <?php $pos = 1?>
                                    @foreach($rights as $dato)
                                        @if($dato->porcentaje_defensa > 0)
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
                                                        {{ number_format($dato->porcentaje_defensa,0) }}
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
