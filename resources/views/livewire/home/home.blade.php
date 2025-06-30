<div>
    <x-layouts.menu-home>
        <div class="bg-gray-100 max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <span class="text-2xl font-semi-bold leading-normal mb-4">{{ __('Noti Liga') }}</span>

            @foreach($noticias as $noti)
                <div class="rounded-lg shadow-lg cursor-pointer w-full mt-6 mb-6">
                    @if($noti->imagen == "")
                        <img alt="noticias" src="{{ asset('storage/sistema/fondo-jugador.png') }}" class="object-cover w-full" style="height: 500px"/>
                    @else
                        <img alt="noticias" src="{{ asset('storage/'.$noti->imagen) }}" class="object-cover w-full" style="height: 500px"/>
                    @endif
                    <div class="w-full p-4 bg-white dark:bg-gray-800">
                        <p class="font-medium texto-primero text-md">
                            Liga de Beisbol Menor Zamora
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
    </x-layouts.menu-home>
</div>