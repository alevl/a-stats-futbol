<div>
    <x-layouts.menu-home>
        <div class="bg-gray-100 max-w-7xl mx-auto py-0 px-4 sm:px-6 lg:px-8">
            <div class="w-full">
                <img src="{{ asset('storage/sistema/fondo-jugador.png') }}" width="100%" style="height: 400px !important" >
            </div>
            <div style="position:absolute; margin-top:-190px; margin-left:10px">
                <img src="{{ asset('storage/sistema/jugador.png') }}" width="180px" class="rounded"  >
            </div>
            <div class="mt-4">
                <p class="mb-2 text-gray-800 dark:text-gray-50" style="font-size: 2em">
                    {{ $jugador->nombre." #".$jugador->numero }}  
                </p>
                <p class="mb-1 text-xl font-medium text-gray-800 dark:text-gray-50">
                    <spand class="font-bold">Nacimiento:</spand> {{ $jugador->nacimiento }}
                </p>
                <p class="mb-1 text-xl font-medium text-gray-800 dark:text-gray-50">
                    <spand class="font-bold">Batea:</spand> {{ $jugador->batea }}
                </p>
                <p class="mb-1 text-xl font-medium text-gray-800 dark:text-gray-50">
                    <spand class="font-bold">Lanza:</spand> {{ $jugador->lanza }}
                </p>
            </div>

            <div class="mt-6">
                <span class="text-2xl font-semi-bold leading-normal">Numeritos (Bateador)</span>
            </div>
            <div style="overflow-x:auto">
                <table class="w-full mt-4 table bg-white rounded-lg shadow mb-12" style="font-size: 0.8em">
                    <thead>
                        <tr class="fondo-primero text-white">
                            <th class=" p-2">Torneo</th>
                            <th class=" p-2">Categoría</th>
                            <th class=" p-2">J</th>
                            <th class=" p-2">VB</th>
                            <th class=" p-2">CA</th>
                            <th class=" p-2">H</th>
                            <th class=" p-2">BB</th>
                            <th class=" p-2">SF</th>
                            <th class=" p-2">GP</th>
                            <th class=" p-2">AL</th>
                            <th class=" p-2">2B</th>
                            <th class=" p-2">3B</th>
                            <th class=" p-2">HR</th>
                            <th class=" p-2">BA</th>
                            <th class=" p-2">CI</th>
                            <th class=" p-2">BR</th>
                            <th class=" p-2">K</th>
                            <th class=" p-2">AVG</th>
                            <th class=" p-2">SLG</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($numeros_temporadas as $temporada)
                            <tr class="text-gray-700 odd:bg-blue-50 even:bg-red-50">
                                <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                    {{ $temporada->campeonato }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                    {{ $temporada->categoria }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $temporada->juegos }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $temporada->vb }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $temporada->anotadas }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $temporada->hit }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $temporada->boletos_recibidos }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $temporada->sacrificios }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $temporada->golpeados }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $temporada->apariciones }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $temporada->dobles }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $temporada->triples }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $temporada->hr }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $temporada->alcanzadas }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $temporada->rbi }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $temporada->robadas }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    {{ $temporada->ponches }}
                                </td>
                                @if($temporada->vb > 0)
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ number_format($temporada->porcentaje_bateo,0) }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ number_format($temporada->porcentaje_slugging,0) }}
                                    </td>
                                @else
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">

                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                <span class="text-2xl font-semi-bold leading-normal">Numeritos (Pitcher)</span>
            </div>
            <div style="overflow-x:auto">
                <table class="w-full mt-4 table bg-white rounded-lg shadow mb-12" style="font-size: 0.8em">
                    <thead>
                        <tr class="fondo-primero text-white">
                            <th class=" p-2">Torneo</th>
                            <th class=" p-2">Categoría</th>
                            <th class=" p-2">J</th>
                            <th class=" p-2">I</th>
                            <th class=" p-2">R</th>
                            <th class=" p-2">C</th>
                            <th class=" p-2">G</th>
                            <th class=" p-2">P</th>
                            <th class=" p-2">SV</th>
                            <th class=" p-2">VB</th>
                            <th class=" p-2">HP</th>
                            <th class=" p-2">H2</th>
                            <th class=" p-2">H3</th>
                            <th class=" p-2">H4</th>
                            <th class=" p-2">IP</th>
                            <th class=" p-2">CP</th>
                            <th class=" p-2">CL</th>
                            <th class=" p-2">K</th>
                            <th class=" p-2">BB</th>
                            <th class=" p-2">GP</th>
                            <th class=" p-2">WP</th>
                            <th class=" p-2">BK</th>
                            <th class=" p-2">NP</th>
                            <th class=" p-2">ERA</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($numeros_temporadas as $temporada)
                            @if($temporada->j > 0)
                                <tr class="text-gray-700 odd:bg-blue-50 even:bg-red-50">
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                        {{ $temporada->campeonato }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                        {{ $temporada->categoria }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->j }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->iniciados }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->relevos }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->completos }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->ganados }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->perdidos }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->salvados }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->veces_bate }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->hp }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->h2 }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->h3 }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->h4 }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->ip }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->carreras_permitidas }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->carreras_limpias }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->ponches_propinados }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->boletos_otorgados }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->gp }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->wp }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->bk }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->pitcheos }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ number_format($temporada->porcentaje_efectividad,2) }}
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                <span class="text-2xl font-semi-bold leading-normal">Mis Juegos (Bateador)</span>
            </div>

            <div style="overflow-x:auto">
                <table class="w-full mt-4 table bg-white rounded-lg shadow mb-12" style="font-size: 0.8em">
                    <thead>
                        <tr class="fondo-primero text-white">
                            <th class=" p-2">Fecha</th>
                            <th class=" p-2">Categoría</th>
                            <th class=" p-2">Oponente</th>
                            <th class=" p-2">VB</th>
                            <th class=" p-2">CA</th>
                            <th class=" p-2">H</th>
                            <th class=" p-2">BB</th>
                            <th class=" p-2">SF</th>
                            <th class=" p-2">GP</th>
                            <th class=" p-2">AL</th>
                            <th class=" p-2">2B</th>
                            <th class=" p-2">3B</th>
                            <th class=" p-2">HR</th>
                            <th class=" p-2">BA</th>
                            <th class=" p-2">CI</th>
                            <th class=" p-2">BR</th>
                            <th class=" p-2">K</th>
                            <th class=" p-2">AVG</th>
                            <th class=" p-2">SLG</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($juegos_totales as $temporada)
                            @if($temporada->juegos > 0)
                                <tr class="text-gray-700 odd:bg-blue-50 even:bg-red-50">
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                        {{ $temporada->fecha }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                        {{ $temporada->categoria }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                        {{ $temporada->oponente }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->vb }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->anotadas }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->hit }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->boletos_recibidos }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->sacrificios }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->golpeados }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->apariciones }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->dobles }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->triples }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->hr }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->alcanzadas }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->rbi }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->robadas }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->ponches }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->average }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->slugging }}
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                <span class="text-2xl font-semi-bold leading-normal">Mis Juegos (Pitcher)</span>
            </div>

            <div style="overflow-x:auto">
                <table class="w-full mt-4 table bg-white rounded-lg shadow mb-6" style="font-size: 0.8em">
                    <thead>
                        <tr class="fondo-primero text-white">
                            <th class=" p-2">Fecha</th>
                            <th class=" p-2">Categoría</th>
                            <th class=" p-2">Oponente</th>
                            <th class=" p-2">I</th>
                            <th class=" p-2">R</th>
                            <th class=" p-2">C</th>
                            <th class=" p-2">G</th>
                            <th class=" p-2">P</th>
                            <th class=" p-2">SV</th>
                            <th class=" p-2">VB</th>
                            <th class=" p-2">HP</th>
                            <th class=" p-2">H2</th>
                            <th class=" p-2">H3</th>
                            <th class=" p-2">H4</th>
                            <th class=" p-2">IP</th>
                            <th class=" p-2">CP</th>
                            <th class=" p-2">CL</th>
                            <th class=" p-2">K</th>
                            <th class=" p-2">BB</th>
                            <th class=" p-2">GP</th>
                            <th class=" p-2">WP</th>
                            <th class=" p-2">BK</th>
                            <th class=" p-2">NP</th>
                            <th class=" p-2">ERA</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($juegos_totales as $temporada)
                            @if($temporada->j > 0)
                                <tr class="text-gray-700 odd:bg-blue-50 even:bg-red-50">
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                        {{ $temporada->fecha }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                        {{ $temporada->categoria }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                        {{ $temporada->oponente }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->iniciados }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->relevos }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->completos }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->ganados }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->perdidos }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->salvados }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->veces_bate }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->hp }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->h2 }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->h3 }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->h4 }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->ip }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->carreras_permitidas }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->carreras_limpias }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->ponches_propinados }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->boletos_otorgados }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->gp }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->wp }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->bk }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ $temporada->pitcheos }}
                                    </td>
                                    <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                        {{ number_format($temporada->efectividad,2) }}
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <a class="inline-flex items-center uppercase justify-center px-4 py-2 border border border-primary rounded font-semibold text-xs tracking-widest hover:text-blue-300 focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150 fondo-segundo text-white mb-6" href="{{ route('jugadores') }}">
                Regresar
            </a>
        </div>
    </x-layouts.menu-home>
</div>
