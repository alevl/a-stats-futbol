<div>
    <x-layouts.menu-admin>
        <div class="bg-gray-100 max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <span class="text-2xl font-semi-bold leading-normal">{{ __('Noticias') }}</span>
            <div class="w-full flex mb-4 mt-2">
                <x-boton-primario wire:click="$set('open_crear', true)">
                    {{ __('Crear Noticia') }}
                </x-boton-primario>
            </div>
            <div class="col-12" style="overflow-x: auto">
                <div class="w-full">
                    <x-input type="text" wire:model.live="search" class="w-full border border-primary border py-2 rounded focus:outline-none" placeholder="{{ __('Buscar') }}" />
                </div>
                <div class="py-2 flex items-center">
                    <div class="flex items-center">
                        <span class="text-s" style="font-size: 0.9em">{{ __('Mostrar') }}</span>
                        <select wire:model.live="cant" style="font-size: 0.9em" class="ml-2 rounded-md border border-primary b-transparent bg-none pl-2 pr-2 py-2 focus:outline-none sm:text-sm text-center">
                            <option value="50">50</option>
                            <option value="80">80</option>
                            <option value="100">100</option>
                          </select>
                        <span class="ml-2 text-s" style="font-size: 0.9em">{{ __('Registros') }}</span>
                    </div>
                </div>
                <table class="w-full mt-4 table bg-white rounded-lg shadow mb-12" style="font-size: 0.8em">
                    <thead>
                        <tr>
                            <th class="border-b-2 p-2 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900 text-center">
                                {{ __('Imagen') }}
                            </th>
                            <th class="border-b-2 p-2 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900 text-center" style="cursor:pointer" wire:click="order('titulo')">
                                {{ __('Título') }}
                                @if($sort == 'titulo')
                                    @if($direccion == 'asc')
                                        <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                    @else
                                        <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                    @endif
                                @else
                                    <i class="icofont icofont-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th class="border-b-2 p-2 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900 text-center" style="cursor:pointer" wire:click="order('desarrollo')">
                                {{ __('Desarrollo') }}
                                @if($sort == 'desarrollo')
                                    @if($direccion == 'asc')
                                        <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                    @else
                                        <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                    @endif
                                @else
                                    <i class="icofont icofont-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th class="border-b-2 p-2 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900 text-center" style="cursor:pointer" wire:click="order('estatus_id')">
                                {{ __('Estatus') }}
                                @if($sort == 'estatus_id')
                                    @if($direccion == 'asc')
                                        <i class="icofont icofont-caret-up float-right" style="font-size: 1.3em"></i>
                                    @else
                                        <i class="icofont icofont-caret-down float-right" style="font-size: 1.3em"></i>
                                    @endif
                                @else
                                    <i class="icofont icofont-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th class="border-b-2 p-2 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900 text-center">
                                {{ __('Acción') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($noticias as $noti)
                            <tr class="text-gray-700">
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    @if($noti->imagen == "")
                                        <img alt="imagen" src="{{ asset('storage/sistema/fondo-jugador.png')}}" class="object-cover h-20 w-20"/>
                                    @else
                                        <img alt="imagen" src="{{ asset('storage/'.$noti->imagen) }}" class="object-cover h-20 w-20"/>
                                    @endif
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                    {{ $noti->titulo }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-left">
                                    {{ $noti->desarrollo }}
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    @if($noti->estatus_id == 1)
                                        <span class="py-1 px-2 rounded" style="background-color: #a3e4d7; color:#0e6251">
                                            {{ $noti->noticia_estatus->estatus }}
                                        </span>
                                    @else
                                        @if($noti->estatus_id == 2)
                                            <span class="py-1 px-2 rounded" style="background-color: #fadbd8; color: #78281f">
                                                {{ $noti->noticia_estatus->estatus }}
                                            </span>
                                        @endif
                                    @endif
                                </td>
                                <td class="border-b-2 p-2 dark:border-dark-5 text-center">
                                    <a wire:click="edit({{ $noti }})" class="cursor-pointer mr-2" title="{{ __('Editar') }}"><i class="icofont icofont-edit-alt texto-azul" style="font-size: 1.3em"></i></a>

                                    <a wire:click="$dispatch('eliminar', {{ $noti->id }})" class="cursor-pointer" title="{{ __('Eliminar') }}"><i class="icofont icofont-bin texto-rojo" style="font-size: 1.3em"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($noticias->hasPages())
                <div class="px-6 py-3">
                    {{ $noticias->links() }}
                </div>                    
            @endif
        </div>
        <x-dialog-modal wire:model="open_edit">
            <x-slot name="title">
                {{ __('Noticia') }}
            </x-slot>
            <x-slot name="content">
                <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-2 my-0 p-2 rounded">
                    <div class="mb-4">
                        <x-label value="{{ __('Imagen de la Noticia') }}" />
                    </div>
                    <div class="mb-4">
                        <input type="file" wire:model='logo' id={{ $identificador }}>
                        <x-input-error for="logo" />
                    </div>
                </div>
                <div class="mb-4">
                    <x-label value="{{ __('Título') }}" />
                    <x-input wire:model.defer="titulo" type="text" class="w-full" />
                    <x-input-error for="titulo"/>
                </div>
                <div class="mb-4">
                    <x-label value="{{ __('Desarrollo') }}" />
                    <x-input wire:model.defer="desarrollo" type="text" class="w-full" />
                    <x-input-error for="desarrollo"/>
                </div>    
                <div class="mb-4">
                    <x-label value="{{ __('Estatus') }}" />
                    <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-300 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="estatus_id" >
                        @foreach ($lista_estatus as $estatus)
                            <option value="{{ $estatus->id }}">{{ $estatus->estatus }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="estatus_id" />
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button wire:click="cerrar_ventana_update">
                    {{ __('Cancelar') }}
                </x-secondary-button>
                <x-boton-primario wire:click="update" wire:loading.attr="disabled" class="disabled:opacity-25 ml-2">
                    {{ __('Actualizar') }}
                </x-boton-primario>
            </x-slot>
        </x-dialog-modal>
        <x-dialog-modal wire:model="open_crear">
            <x-slot name="title">
                {{ __('Noticia') }}
            </x-slot>
            <x-slot name="content">
                <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-2 my-0 p-2 rounded">
                    <div class="mb-4">
                        <x-label value="{{ __('Imagen de la Noticia') }}" />
                    </div>
                    <div class="mb-4">
                        <input type="file" wire:model='logo_crear' id={{ $identificador }}>
                        <x-input-error for="logo_crear"/>
                    </div>
                </div>
                <div class="mb-4">
                    <x-label value="{{ __('Título') }}" />
                    <x-input type="text" class="w-full" wire:model.defer="titulo_crear"/>
                    <x-input-error for="titulo_crear"/>
                </div>
                <div class="mb-4">
                    <x-label value="{{ __('Desarrollo') }}" />
                    <x-input type="text" class="w-full" wire:model.defer="desarrollo_crear"/>
                    <x-input-error for="desarrollo_crear"/>
                </div>
                <div class="mb-4">
                    <x-label value="{{ __('Estatus') }}" />
                    <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-500 rounded-md border border-primary pl-2 pr-2 py-2.5 focus:outline-none sm:text-sm" wire:model="estatus_id_crear" >
                        <option value="">Select...</option>
                        @foreach ($lista_estatus as $estatus)
                            <option value="{{ $estatus->id }}">{{ $estatus->estatus }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="estatus_id_crear" />
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button wire:click="cerrar_ventana_crear">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-boton-primario wire:click="save" wire:loading.attr="disabled" wire:target="save" class="disabled:opacity-25 ml-2">
                    {{ __('Registrar') }}
                </x-boton-primario>
            </x-slot>
        </x-dialog-modal>

        @push('js')
            <script src="sweetalert2.all.min.js"></script>

            <script>
                Livewire.on('eliminar', noticiaId => { 
                        Swal.fire({
                        title: "¿{{ __('Está seguro de eliminar esta noticia') }}?",
                        text: "¡{{ __('Esta operación no podrá ser reversada') }}!",
                        icon: 'warning',
                        cancelButtonText: "{{ __('Cancelar') }}",
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "¡{{ __('Si, estoy seguro') }}!"
                    })
                    .then((result) => {
                        if (result.isConfirmed) {
                            @this.call('delete', noticiaId)

                            Swal.fire(
                                '',
                                "{{ __('Noticia eliminada') }}",
                                'success'
                            )
                        }
                    })
                });
            </script>
        @endpush
    </x-layouts.menu-admin>
</div>
