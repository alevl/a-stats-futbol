<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="og:description" content="Ingenieria">
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
    <body class="relative w-full h-full items-center justify-center p-2 overflow-hidden text-white bg-no-repeat bg-cover relative" style="background-color: #117a65">
        <div class="relative z-10 flex flex-col items-center w-full font-mono">
            <h1 class="mt-4 text-5xl font-extrabold leading-tight text-center text-white">
                Error Interno
            </h1>
            <p class="font-extrabold text-white text-8xl my-16 animate-bounce">
                500
            </p>
            <a href="{{ route('salir.cierre')}}" class="py-2 px-6 bg-red-400 hover:bg-green-700 focus:ring-green-500 focus:ring-offset-indigo-200 text-white transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                Ingresar
            </a>
        </div>
    </body>
</html>