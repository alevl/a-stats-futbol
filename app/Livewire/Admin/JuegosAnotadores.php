<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Calendario;
use App\Models\Estadio;
use App\Models\Grupo;
use App\Models\Equipo;
use App\Models\Anotadore;
use App\Models\Arbitro;
use App\Models\Jugadore;
use App\Models\JugadoresNumero;
use App\Models\JugadoresDefensiva;
use App\Models\Posicione;
use App\Models\Condicione;
use DB;

class JuegosAnotadores extends Component
{
    public $datos_torneo, $id_torneo;
    public $lista_estadios=[], $lista_grupos=[], $lista_equipos=[], $lista_anotadores=[], $lista_arbitros=[], $lista_condiciones=[], $lista_jugadores=[];
    public $estadio_id_crear, $fecha_crear, $hora_crear, $grupo_id_crear, $visita_id_crear, $casa_id_crear, $visita_carreras_crear, $casa_carreras_crear, $visita_hits_crear, $casa_hits_crear, $visita_errores_crear, $casa_errores_crear, $anotador_id_crear, $arbitro1_id_crear, $arbitro2_id_crear, $arbitro3_id_crear, 
    $arbitro4_id_crear, $numero_juego;
    public $sort = 'numero_juego';
    public $direccion = 'desc';

    public $id_juego, $fecha_juego, $hora_juego, $estadio_id, $grupo_id, $visita_id, $anotacion_visita, $hits_visita, $errores_visita, $casa_id, $anotacion_casa, $hits_casa, $errores_casa, $anotador_id, $arbitro1_id, $arbitro2_id, $arbitro3_id, $arbitro4_id, $facturado_id, $bat_destacado, $bat_destacado_texto, $pit_destacado, $pit_destacado_texto, $numero_juego_editar, $estatus_id;

    public $open_crear = false;
    public $open_edit = false;

    public function mount()
    {
        if(auth()->user()->nivel_id <> 1)
        {
            session()->flush();
            return redirect()->route('login');
        }
    }

    public function render()
    {
        $this->lista_estadios = Estadio::orderBy('nombre','asc')->get();
        $this->lista_grupos = Grupo::orderBy('grupo','asc')->get();
        $this->lista_equipos = Equipo::orderBy('nombre','asc')->get();
        $this->lista_anotadores = Anotadore::orderBy('nombre','asc')->get();
        $this->lista_arbitros = Arbitro::orderBy('nombre','asc')->get();
        $this->lista_condiciones = Condicione::orderBy('id','asc')->get();

        if($this->anotador_id == 0 and $this->estatus_id == 0)
        {
            $juegos = Calendario::orderBy('anotador_id','desc')->orderBy($this->sort, $this->direccion)->get();
        }
        else
        {
            if($this->anotador_id <> 0 and $this->estatus_id == 0)
            {
                $juegos = Calendario::orderBy('anotador_id','desc')->where('anotador_id', $this->anotador_id)->orderBy($this->sort, $this->direccion)
                ->get();
            }
            else
            {
                if($this->anotador_id == 0 and $this->estatus_id <> 0)
                {
                    $juegos = Calendario::orderBy('anotador_id','desc')->where('facturado_id', $this->estatus_id)->orderBy($this->sort, $this->direccion)->get();
                }
                else
                {
                    if($this->anotador_id <> 0 and $this->estatus_id <> 0)
                    {
                        $juegos = Calendario::orderBy('anotador_id','desc')->where('anotador_id', $this->anotador_id)->where('facturado_id', $this->estatus_id)->orderBy($this->sort, $this->direccion)->get();
                    }
                }
            }
        }

        return view('livewire.admin.juegos-anotadores', compact('juegos'));
    }

    public function edit(Calendario $juego_editar)
    {
        $this->resetValidation();

        $this->id_juego = $juego_editar['id'];
        $this->facturado_id = $juego_editar['facturado_id'];

        $this->open_edit = true;
    }

    public function update()
    {
        $this->validate([
            'facturado_id' => 'required|max:2',
        ]);

        $actualizar = Calendario::where('id', $this->id_juego)->update([
            'facturado_id' => $this->facturado_id,
        ]);

        $this->reset(['open_edit','facturado_id']);
    }

    public function order($sort)
    {
        if($this->sort == $sort)
        {
            if($this->direccion == 'desc') 
            {
                $this->direccion = 'asc';
            }
            else 
            {
                $this->direccion = 'desc';
            }
        }
        else
        {
            $this->sort = $sort;
            $this->direccion = 'asc';
        }
    }
}
