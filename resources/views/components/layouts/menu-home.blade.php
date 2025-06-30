<header>
    <nav class="border-gray-200 dark:bg-gray-900" style="background-color: #94a3b8">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="{{ route('home') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
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
                <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 dark:bg-gray-800 dark:border-gray-700">
                    <li>
                        <a href="{{ route('home') }}" class="text-white block py-2 px-3 text-gray-400 hover:text-red-600 md:p-0">{{ __('Inicio') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('resultados') }}" class="text-white block py-2 px-3 text-gray-400 hover:text-red-600 md:p-0">{{ __('Resultados') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('champions') }}" class="text-white block py-2 px-3 text-gray-400 hover:text-red-600 md:p-0">{{ __('Champions') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('lideres') }}" class="text-white block py-2 px-3 text-gray-400 hover:text-red-600 md:p-0">{{ __('Lideres') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('lideres-equipos') }}" class="text-white block py-2 px-3 text-gray-400 hover:text-red-600 md:p-0">{{ __('Lideres Equipos') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('posiciones', [ 0 ]) }}" class="text-white block py-2 px-3 text-gray-400 hover:text-red-600 md:p-0">{{ __('Posiciones') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('jugadores') }}" class="text-white block py-2 px-3 text-gray-400 hover:text-red-600 md:p-0">{{ __('Jugadores') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('roster') }}" class="text-white block py-2 px-3 text-gray-400 hover:text-red-600 md:p-0">{{ __('Roster') }}</a>
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
