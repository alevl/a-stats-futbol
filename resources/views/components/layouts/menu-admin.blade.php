<header>
    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('storage/sistema/logo-horizontal.png') }}" class="h-12" alt="A-Stats logo">
            </a>
            <div class="flex items-center md:order-2 space-x-1 md:space-x-0 rtl:space-x-reverse">                
                <button data-collapse-toggle="navbar-language" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-language" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                    </svg>
                </button>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-language">
                <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <a href="{{ route('dashboard') }}" class="block py-2 px-3 text-gray-400 hover:text-red-600 md:p-0">{{ __('Dashboard') }}</a>
                    </li>
                    <li>
                        <button id="mega-menu-dropdown-button" data-dropdown-toggle="mega-menu-dropdown1" class="flex items-center justify-between w-full py-2 px-3 font-medium text-gray-400 border-b border-gray-100 md:w-auto hover:text-red-600 md:hover:text-red-600 md:border-0 md:hover:text-red-600 md:p-0">
                            Torneos
                            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>
                        <div id="mega-menu-dropdown1" class="absolute z-10 grid hidden w-auto grid-cols-1 text-sm bg-white border border-gray-100 rounded-lg shadow-md dark:border-gray-700 md:grid-cols-1 dark:bg-gray-700">
                            <div class="p-4">
                                <ul class="space-y-4">
                                    <li>
                                        <a href="{{ route('ligas-admin') }}" class="block py-2 px-3 text-gray-400 hover:text-red-600 md:p-0">{{ __('Ligas') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('categorias-admin') }}" class="block py-2 px-3 text-gray-400 hover:text-red-600 md:p-0">{{ __('Categorias') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('torneos-admin') }}" class="block py-2 px-3 text-gray-400 hover:text-red-600 md:p-0">{{ __('Torneos') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li>
                        <button id="mega-menu-dropdown-button" data-dropdown-toggle="mega-menu-dropdown2" class="flex items-center justify-between w-full py-2 px-3 font-medium text-gray-400 border-b border-gray-100 md:w-auto hover:text-red-600 md:hover:text-red-600 md:border-0 md:hover:text-red-600 md:p-0">
                            Equipos
                            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>
                        <div id="mega-menu-dropdown2" class="absolute z-10 grid hidden w-auto grid-cols-1 text-sm bg-white border border-gray-100 rounded-lg shadow-md dark:border-gray-700 md:grid-cols-1 dark:bg-gray-700">
                            <div class="p-4">
                                <ul class="space-y-4">
                                    <li>
                                        <a href="{{ route('equipos-admin') }}" class="block py-2 px-3 text-gray-400 hover:text-red-600 md:p-0">{{ __('Equipos') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('jugadores-admin') }}" class="block py-2 px-3 text-gray-400 hover:text-red-600 md:p-0">{{ __('Jugadores') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li>
                        <button id="mega-menu-dropdown-button" data-dropdown-toggle="mega-menu-dropdown4" class="flex items-center justify-between w-full py-2 px-3 font-medium text-gray-400 border-b border-gray-100 md:w-auto hover:text-red-600 md:hover:text-red-600 md:border-0 md:hover:text-red-600 md:p-0">
                            Mantenimiento
                            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>
                        <div id="mega-menu-dropdown4" class="absolute z-10 grid hidden w-auto grid-cols-1 text-sm bg-white border border-gray-100 rounded-lg shadow-md dark:border-gray-700 md:grid-cols-1 dark:bg-gray-700">
                            <div class="p-4">
                                <ul class="space-y-4">
                                    <li>
                                        <a href="{{ route('estadios') }}" class="block py-2 px-3 text-gray-400 hover:text-red-600 md:p-0">{{ __('Estadios') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('anotadores') }}" class="block py-2 px-3 text-gray-400 hover:text-red-600 md:p-0">{{ __('Anotadores') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('arbitros') }}" class="block py-2 px-3 text-gray-400 hover:text-red-600 md:p-0">{{ __('Arbitros') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('juegos-anotador') }}" class="block py-2 px-3 text-gray-400 hover:text-red-600 md:p-0">{{ __('Juegos por Anotador') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('respaldar') }}" class="block py-2 px-3 text-gray-400 hover:text-red-600 md:p-0">{{ __('Respaldar Base de datos') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="{{ route('noticias-admin') }}" class="block py-2 px-3 text-gray-400 hover:text-red-600 md:p-0">{{ __('Noticias') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('perfil') }}" class="block py-2 px-3 text-gray-400 hover:text-red-600 md:p-0">{{ __('Perfil') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('salir.cierre') }}" class="block py-2 px-3 text-gray-400 hover:text-red-600 md:p-0">{{ __('Salir') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<body class="bg-gray-100">
    {{ $slot }}
<body>

<script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
