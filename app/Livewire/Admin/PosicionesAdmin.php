<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Posicione;
use App\Models\Equipo;
use App\Models\Campeonato;
use DB;

class PosicionesAdmin extends Component
{
    public $id_torneo, $datos_torneo;

    public function mount($id_torneo)
    {
        $this->id_torneo = $id_torneo;

        if(auth()->user()->nivel_id <> 1)
        {
            session()->flush();
            return redirect()->route('login');
        }

        $this->datos_torneo = DB::table('campeonatos')
        ->join('categorias', 'categorias.id', '=', 'campeonatos.categoria_id')
        ->where('campeonatos.id', $this->id_torneo)
        ->first();
    }

    public function render()
    {
        $posiciones = Posicione::
        select('posiciones.*', 'equipos.*')
        ->join('equipos', 'equipos.id', '=', 'posiciones.equipo_id')
        ->where('posiciones.campeonato_id', $this->id_torneo)
        ->orderBy('posiciones.porcentaje','desc')
        ->orderBy('posiciones.ganados','desc')
        ->orderBy('posiciones.perdidos','asc')
        ->get();

        return view('livewire.admin.posiciones-admin')->with('posiciones', $posiciones);
    }
}
