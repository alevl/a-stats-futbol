<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\Noticia;

class Home extends Component
{
    public function render()
    {
        $noticias = Noticia::where('estatus_id', 1)->orderBy('created_at', 'desc')->get();

        return view('livewire.home.home', compact('noticias'));
    }
}
