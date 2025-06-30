<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="og:description" content="Estadisticas de beisbol">
        <meta name="robots" content="index, follow">
        <link rel="shortcut icon" href="{{ asset('storage/sistema/favicon.png') }}" type="image/x-icon">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!--ICONOS-->
        <link rel="stylesheet" href="{{ asset('librerias/iconos/iconos/icofont.css') }}">
        <!--TAILWIND-->
        <script src="https://cdn.tailwindcss.com"></script>
        <!--MIS ESTILOS-->
        <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    </head>
    <body class="relative w-full h-full items-center justify-center overflow-hidden text-white bg-no-repeat bg-cover relative" >
        <div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
            <div class="relative py-3 sm:max-w-xl sm:mx-auto">
                <div class="absolute inset-0 fondo-primero shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl">
                </div>
                <div class="relative px-4 py-4 bg-white shadow-lg sm:rounded-3xl sm:p-20">
                    <div class="max-w-md mx-auto">
                        <div style="text-align: center">
                            <img src="{{ asset('storage/sistema/logo.png') }}" class="responsive1" style="position:relative; margin:auto" width="150px">
                        </div>
                        <div class="divide-y divide-gray-200">
                            <x-validation-errors class="mb-4" />
                            <form method="POST" action="{{ route('acceso.acceso') }}">
                                @csrf
                                <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                                    <div class="relative">
                                        <input autocomplete="off" id="username" name="username" type="text" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Username" />
                                        <label for="username" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Username</label>
                                    </div>
                                    <div class="relative">
                                        <input autocomplete="off" id="password" name="password" type="password" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Password" />
                                        <label for="password" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Password</label>
                                    </div>
                                    <div class="relative w-full">
                                        <button type="submit" class="fondo-primero w-full text-white rounded-md px-2 py-1">Entrar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>