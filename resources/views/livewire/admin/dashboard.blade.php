<div>
    <x-layouts.menu-admin>
        <div class="bg-gray-100 max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <span class="text-2xl font-semi-bold leading-normal">{{ __('Dashboard') }}</span>
            <div class="col-12" style="overflow-x: auto">
                @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2 my-2 p-2 rounded">
                    <div class="text-center relative w-full px-4 py-2" style="background-color:#9a7d0a; color:#f9e79f">
                        <p class="text-2xl font-bold dark:text-white">
                            {{ $total_juegos }}
                        </p>
                        <p class="text-sm">
                            {{ __('Juegos Publicados') }}
                        </p>
                        <span class="absolute p-4 rounded-full top-2 right-4">
                            <i class="icofont icofont-calendar" style="font-size:2.2em;"></i>
                        </span>
                    </div>
                    <div class="text-center relative w-full px-4 py-2" style="background-color:#0e6251; color:#a3e4d7">
                        <p class="text-2xl font-bold dark:text-white">
                            {{ $total_cobrados }}
                        </p>
                        <p class="text-sm">
                            {{ __('Juegos Cobrados') }}
                        </p>
                        <span class="absolute p-4 rounded-full top-2 right-4">
                            <i class="icofont icofont-check-circled" style="font-size:2.2em;"></i>
                        </span>
                    </div>
                    <div class="text-center relative w-full px-4 py-2" style="background-color:#78281f; color:#fadbd8">
                        <p class="text-2xl font-bold dark:text-white">
                            {{ $total_deuda }}
                        </p>
                        <p class="text-sm">
                            {{ __('Juegos Pendientes') }}
                        </p>
                        <span class="absolute p-4 rounded-full top-2 right-4">
                            <i class="icofont icofont-close-circled" style="font-size:2.2em;"></i>
                        </span>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-4 gap-2 my-2 p-2 rounded">
                    <div class="text-center relative w-full px-4 py-2 bg-white shadow-lg dark:bg-gray-700">
                        <p class="text-2xl font-bold dark:text-white texto-azul">
                            {{ $total_jugadores }}
                        </p>
                        <p class="text-sm" style="color:#212f3d">
                            {{ __('Peloteros') }}
                        </p>
                        <span class="absolute p-4 rounded-full top-2 right-4">
                            <i class="icofont icofont-baseballer texto-primero" style="font-size:2.2em;"></i>
                        </span>
                    </div>
                    <div class="text-center relative w-full px-4 py-2 bg-white shadow-lg dark:bg-gray-700">
                        <p class="text-2xl font-bold dark:text-white texto-azul">
                            {{ $total_equipos }}
                        </p>
                        <p class="text-sm" style="color:#212f3d">
                            {{ __('Equipos') }}
                        </p>
                        <span class="absolute p-4 rounded-full top-2 right-4">
                            <i class="icofont icofont-people texto-primero" style="font-size:2.2em;"></i>
                        </span>
                    </div>
                    <div class="text-center relative w-full px-4 py-2 bg-white shadow-lg dark:bg-gray-700">
                        <p class="text-2xl font-bold dark:text-white texto-azul">
                            {{ $total_categorias }}
                        </p>
                        <p class="text-sm" style="color:#212f3d">
                            {{ __('Categorias') }}
                        </p>
                        <span class="absolute p-4 rounded-full top-2 right-4">
                            <i class="icofont icofont-molecule texto-primero" style="font-size:2.2em;"></i>
                        </span>
                    </div>
                    <div class="text-center relative w-full px-4 py-2 bg-white shadow-lg dark:bg-gray-700">
                        <p class="text-2xl font-bold dark:text-white texto-azul">
                            {{ $total_torneos }}
                        </p>
                        <p class="text-sm" style="color:#212f3d">
                            {{ __('Torneos') }}
                        </p>
                        <span class="absolute p-4 rounded-full top-2 right-4">
                            <i class="icofont icofont-result-sport texto-primero" style="font-size:2.2em;"></i>
                        </span>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-2 my-2 p-2 rounded">
                    <div class="w-full">
                        <div class="relative w-full px-4 py-6 bg-white shadow-lg dark:bg-gray-700">
                            <p class="text-sm font-semibold text-gray-700 border-b border-gray-200 w-max dark:text-white">
                                {{ __('Anotadores') }}
                            </p>
                            <div class="flex items-end my-6 space-x-2">
                                <p class="text-5xl font-bold dark:text-white texto-primero">
                                    {{ $total_anotadores }}
                                </p>
                                <span class="flex items-center text-xl font-bold text-green-500">
                                </span>
                            </div>
                            <div class="dark:text-white">
                                @foreach($lista_anotadores as $ano)
                                    <div class="flex items-center justify-between pb-2 mb-2 text-sm border-b border-gray-200 sm:space-x-12">
                                        <p>
                                            {{ $ano->nombre }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="w-full">
                        <div class="relative w-full px-4 py-6 bg-white shadow-lg dark:bg-gray-700">
                            <p class="text-sm font-semibold text-gray-700 border-b border-gray-200 w-max dark:text-white">
                                {{ __('Juegos') }}
                            </p>
                            <div class="flex items-end my-6 space-x-2">
                                <p class="text-5xl font-bold dark:text-white texto-primero">
                                    {{ $total_juegos }}
                                </p>
                                <span class="flex items-center text-xl font-bold text-green-500">
                                </span>
                            </div>
                            <div class="dark:text-white">
                                @foreach($juegos_anotadores as $ano)
                                    <div class="flex items-center justify-between pb-2 mb-2 text-sm border-b border-gray-200 sm:space-x-12">
                                        <p>
                                            {{ $ano->anotador }}
                                        </p>
                                        <div class="flex items-end text-xs">
                                            {{ $ano->juegos }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="w-full">
                        <div class="relative w-full px-4 py-6 bg-white shadow-lg dark:bg-gray-700">
                            <p class="text-sm font-semibold text-gray-700 border-b border-gray-200 w-max dark:text-white">
                                {{ __('Deuda') }}
                            </p>
                            <div class="flex items-end my-6 space-x-2">
                                <p class="text-5xl font-bold dark:text-white texto-primero">
                                    {{ $total_deuda }}
                                </p>
                                <span class="flex items-center text-xl font-bold text-green-500">
                                </span>
                            </div>
                            <div class="dark:text-white">
                                @foreach($juegos_deudas as $ano)
                                    <div class="flex items-center justify-between pb-2 mb-2 text-sm border-b border-gray-200 sm:space-x-12">
                                        <p>
                                            {{ $ano->anotador }}
                                        </p>
                                        <div class="flex items-end text-xs">
                                            {{ $ano->deuda }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2 my-2 p-2 rounded">
                    <div class="w-full">
                        <div class="relative w-full px-4 py-6 bg-white shadow-lg dark:bg-gray-700">
                            <p class="text-sm font-semibold text-gray-700 border-b border-gray-200 w-max dark:text-white">
                                {{ __('Desglose') }}
                            </p>
                            <div class="flex items-end my-6 space-x-2">
                                <p class="text-5xl font-bold dark:text-white texto-primero">
                                    {{ $total_deuda }}
                                </p>
                                <span class="flex items-center text-xl font-bold text-green-500">
                                </span>
                            </div>
                            <div class="dark:text-white">
                                @foreach($desglose as $dato)
                                    <div class="flex items-center justify-between pb-2 mb-2 text-sm border-b border-gray-200 sm:space-x-12">
                                        <p>
                                            {{ $dato->anotador }}
                                        </p>
                                        <div class="flex items-end text-xs">
                                            {{ $dato->fecha_juego }}
                                        </div>
                                        @if($dato->numero_juego == '' or $dato->numero_juego == null)
                                            <div class="flex items-end text-xs">
                                                {{ "N/I" }}
                                            </div>
                                        @else
                                            <div class="flex items-end text-xs">
                                                {{ "#".$dato->numero_juego }}
                                            </div>
                                        @endif
                                        <div class="flex items-end text-xs">
                                            {{ $dato->categoria }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-layouts.menu-admin>
</div>
