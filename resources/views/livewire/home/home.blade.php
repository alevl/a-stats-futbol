<div>
    <x-layouts.menu-home>
        <div class="bg-gray-100 max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row">
                <div class="w-full md:w-1/4 p-2 mt-6 mb-6">
                    <div class="sticky top-4 space-y-4">
                        <div class="bg-white shadow-md rounded-lg p-0">
                            <img src="{{ asset('storage/sistema/disponible.png') }}" alt="Disponible" class="w-full h-auto object-contain rounded">
                        </div>

                        <div class="bg-white shadow-md rounded-lg p-0">
                            <a href="https://a-stats.com" target="new"><img src="{{ asset('storage/sistema/a-stats.png') }}" alt="A-Stats" class="w-full h-auto object-contain rounded"></a>
                        </div>

                        <div class="bg-white shadow-md rounded-lg p-0">
                            <img src="{{ asset('storage/sistema/disponible.png') }}" alt="Disponible" class="w-full h-auto object-contain rounded">
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-3/4 p-2">
                    @foreach($noticias as $noti)
                        <div class="rounded-lg shadow-lg cursor-pointer w-full mt-6 mb-6">
                            @if($noti->imagen == "")
                                <img alt="noticias" src="{{ asset('storage/sistema/fondo-jugador.png') }}" class="object-cover w-full" style="height: 500px"/>
                            @else
                                <img alt="noticias" src="{{ asset('storage/'.$noti->imagen) }}" class="object-cover w-full" style="height: 500px"/>
                            @endif
                            <div class="w-full p-4 bg-white dark:bg-gray-800">
                                <p class="font-medium texto-primero text-md">
                                </p>
                                <p class="mb-2 text-xl font-medium text-gray-800 dark:text-white">
                                    {{ $noti->titulo }}
                                </p>
                                <p class="font-light text-gray-700 dark:text-gray-300 text-md">
                                    {{ $noti->desarrollo }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </x-layouts.menu-home>
</div>