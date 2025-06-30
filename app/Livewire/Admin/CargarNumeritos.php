<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Jugadore;
use App\Models\Calendario;
use App\Models\JugadoresNumero;
use App\Models\JugadoresDefensiva;
use App\Models\Campeonato;
use App\Models\Equipo;
use DB;

class CargarNumeritos extends Component
{
    public $tipo="bateador";
    public $id_juego, $datos_juego;
    public $nombre_crear, $numero_crear, $batea_crear, $lanza_crear, $nacimiento_crear, $equipo_id_crear, $foto_crear;

    public $id_bateo, $nombre_bateo, $equipo_bateo, $vb, $anotadas, $hit, $dobles, $triples, $hr, $rbi, $boletos_recibidos, $ponches, $robadas, $out_robando, $alcanzadas, $sacrificios, $golpeados, $apariciones, $vo;

    public $id_pitcheo, $nombre_pitcheo, $equipo_pitcheo, $j, $ganados, $iniciados, $perdidos, $blanqueos, $salvados, $ip, $carreras_permitidas, $carreras_limpias, $ponches_propinados, $boletos_otorgados, $pitcheos, $inicios, $relevos, $completos, $veces_bate, $hp, $h2, $h3, $h4, $gp, $wp, $bk, $orden_bat=1, $posicion_defensa, $orden_pit;

    public $id_defensa, $id_equipo, $id_jugador, $nombre_defensa, $equipo_defensa, $juegos_def, $posicion, $innings, $outs, $asistencias, $errores;

    public $id_defensa_crear, $id_equipo_crear, $id_jugador_crear, $nombre_defensa_crear, $equipo_defensa_crear, $juegos_def_crear, $posicion_crear, $innings_crear=0, $outs_crear=0, $asistencias_crear=0, $errores_crear=0;

    public $juego_id_express, $fecha_express, $id_jugador_crear_express, $oponente_express, $liga_express, $campeonato_express, $categoria_express, $posicion_crear_express, $innings_crear_express=0, $outs_crear_express=0, $asistencias_crear_express=0, $errores_crear_express=0, $input_radio, $uno, $dos, $tres, $cuatro, $cinco, $seis, $siete, $ocho, $nueve, $diez, $once, $doce;

    public $accion11, $accion12, $accion13, $accion14, $accion15, $accion16;
    public $accion21, $accion22, $accion23, $accion24, $accion25, $accion26;
    public $accion31, $accion32, $accion33, $accion34, $accion35, $accion36;
    public $accion41, $accion42, $accion43, $accion44, $accion45, $accion46;
    public $accion51, $accion52, $accion53, $accion54, $accion55, $accion56;
    public $accion61, $accion62, $accion63, $accion64, $accion65, $accion66;

    public $lista_equipos=[], $equipo_crear;

    public $readyToLoad = false;
    public $open_crear_visita = false;
    public $open_crear_casa = false;
    public $open_cargar_bateo = false;
    public $open_cargar_colmena = false;
    public $open_cargar_pitcheo = false;
    public $open_crear_defensa = false;
    public $open_edit_defensa = false;

    protected $listeners = ['render', 'delete'];

    public function mount($id_juego)
    {
        $this->id_juego = $id_juego;

        if(auth()->user()->nivel_id <> 1)
        {
            session()->flush();
            return redirect()->route('login');
        }

        $this->datos_juego = DB::table('calendarios')
        ->select('calendarios.*','categorias.*','campeonatos.*')
        ->join('categorias', 'categorias.id', '=', 'calendarios.categoria_id')
        ->join('campeonatos', 'campeonatos.id', '=', 'calendarios.campeonato_id')
        ->where('calendarios.id', $this->id_juego)
        ->first();

        $this->lista_equipos = Calendario::where('id', $this->id_juego)->get();
    }

    public function render()
    {
        $numeros_temporadas = JugadoresNumero::where('juego_id', $this->id_juego)
        ->select('jugadores_numeros.*','jugadores.nombre as jugador','jugadores.equipo_id as equipo','equipos.nombre as nombre_equipo')
        ->join('jugadores', 'jugadores.id', '=', 'jugadores_numeros.jugador_id')
        ->join('equipos', 'equipos.id', '=', 'jugadores.equipo_id')
        ->orderBy('equipos.nombre', 'asc')
        ->orderBy('jugadores_numeros.orden_bat', 'asc')
        ->orderBy('jugadores.nombre', 'asc')
        ->get();

        $numeros_defensiva = JugadoresDefensiva::where('juego_id', $this->id_juego)
        ->select('jugadores_defensivas.*','jugadores.nombre as jugador','jugadores.equipo_id as equipo','equipos.nombre as nombre_equipo','jugadores_defensivas.posicion as posicion')
        ->join('jugadores', 'jugadores.id', '=', 'jugadores_defensivas.jugador_id')
        ->join('equipos', 'equipos.id', '=', 'jugadores.equipo_id')
        ->orderBy('equipos.nombre', 'asc')
        ->orderBy('jugadores.nombre', 'asc')
        ->get();

        return view('livewire.admin.cargar-numeritos')->with('numeros_temporadas', $numeros_temporadas)->with('numeros_defensiva', $numeros_defensiva);
    }

    public function actualizar_roster()
    {
        $contrincantes = Calendario::where('id', $this->id_juego)->first();

        $jugadores_visita = Jugadore::where('equipo_id', $contrincantes->visita_id)->get();
        foreach($jugadores_visita as $visita)
        {
            $buscar = JugadoresNumero::where('juego_id', $this->id_juego)->where('jugador_id', $visita->id)->count();
            if($buscar < 1)
            {
                $dia = substr($contrincantes->fecha_juego, 0, 2);
                $mes = substr($contrincantes->fecha_juego, 3, 2);
                $anio = substr($contrincantes->fecha_juego, 6, 4);

                $fecha_invertida = $anio.$mes.$dia;

                $numero = JugadoresNumero::create([
                    'juego_id' => $this->id_juego,
                    'fecha' => $contrincantes->fecha_juego,
                    'jugador_id' => $visita->id,
                    'oponente_id' => $contrincantes->casa_id,
                    'campeonato_id' => $contrincantes->campeonato_id,
                    'categoria_id' => $contrincantes->categoria_id,
                    'fecha_invertida' => $fecha_invertida,
                ]);
            }
        }

        $jugadores_casa = Jugadore::where('equipo_id', $contrincantes->casa_id)->get();
        foreach($jugadores_casa as $casa)
        {
            $buscar = JugadoresNumero::where('juego_id', $this->id_juego)->where('jugador_id', $casa->id)->count();
            if($buscar < 1)
            {
                $dia = substr($contrincantes->fecha_juego, 0, 2);
                $mes = substr($contrincantes->fecha_juego, 3, 2);
                $anio = substr($contrincantes->fecha_juego, 6, 4);

                $fecha_invertida = $anio.$mes.$dia;

                $numero = JugadoresNumero::create([
                    'juego_id' => $this->id_juego,
                    'fecha' => $contrincantes->fecha_juego,
                    'jugador_id' => $casa->id,
                    'oponente_id' => $contrincantes->visita_id,
                    'campeonato_id' => $contrincantes->campeonato_id,
                    'categoria_id' => $contrincantes->categoria_id,
                    'fecha_invertida' => $fecha_invertida,
                ]);
            }
        }

        $this->dispatch('alert');
    }

    public function mvp_bateador($bat)
    {
        $box = JugadoresNumero::where('juego_id', $this->id_juego)->where('jugador_id', $bat)->first();
        $resumen = $box->vb."-".$box->hit;

        if($box->hr > 0)
        {
            if($box->hr == 1)
            {
                $resumen = $resumen.", HR"; 
            }
            else
            {
                $resumen = $resumen.", ".$box->hr."HR"; 
            }
        }
        else
        {
            if($box->triples > 0)
            {
                if($box->triples == 1)
                {
                    $resumen = $resumen.", 3B"; 
                }
                else
                {
                    $resumen = $resumen.", ".$box->triples."-3B"; 
                }
            }
            else
            {
                if($box->dobles > 0)
                {
                    if($box->dobles == 1)
                    {
                        $resumen = $resumen.", 2B"; 
                    }
                    else
                    {
                        $resumen = $resumen.", ".$box->dobles."-2B"; 
                    }
                }
                else
                {
                    if($box->robadas > 0)
                    {
                        if($box->robadas == 1)
                        {
                            $resumen = $resumen.", BR"; 
                        }
                        else
                        {
                            $resumen = $resumen.", ".$box->robadas."BR"; 
                        }
                    }
                }
            }
        }
        if($box->anotadas > 0)
        {
            if($box->anotadas == 1)
            {
                $resumen = $resumen.", CA"; 
            }
            else
            {
                $resumen = $resumen.", ".$box->anotadas."CA"; 
            }
        }
        if($box->rbi > 0)
        {
            if($box->rbi == 1)
            {
                $resumen = $resumen.", CI"; 
            }
            else
            {
                $resumen = $resumen.", ".$box->rbi."CI"; 
            }
        }

        $mvp = Calendario::where('id', $this->id_juego)->update([
            'bat_destacado_id' => $bat,
            'texto_bateador' => $resumen,
        ]);

        $this->dispatch('alert');
    }

    public function mvp_pitcher($pit)
    {
        $box = JugadoresNumero::where('juego_id', $this->id_juego)->where('jugador_id', $pit)->first();
        $resumen = $box->ip."IP, ".$box->hp."HP, ".$box->carreras_limpias."CL, ".$box->ponches_propinados."P";

        $mvp = Calendario::where('id', $this->id_juego)->update([
            'pit_destacado_id' => $pit,
            'texto_pitcher' => $resumen,
        ]);

        $this->dispatch('alert');
    }


    public function anotacion($valor)
    {
        if($valor == 'limpiar')
        {
            $this->vb = 0;
            $this->ponches = 0;
            $this->boletos_recibidos = 0;
            $this->golpeados = 0;
            $this->sacrificios = 0;
            $this->hit = 0;
            $this->dobles = 0;
            $this->triples = 0;
            $this->hr = 0;
            $this->anotadas = 0;
            $this->rbi = 0;
            $this->robadas = 0;

            $this->input_radio = null;
            $this->uno = null;
            $this->dos = null;
            $this->tres = null;
            $this->cuatro = null;
            $this->cinco = null;
            $this->seis = null;
            $this->siete = null;
            $this->ocho = null;
            $this->nueve = null;
            $this->diez = null;
            $this->once = null;
            $this->doce = null;
        }
        if($valor == '0impulsada')
        {
            $this->rbi = 0;
        }

        if($valor == '0robo')
        {
            $this->robadas = 0;
        }

        if($valor == '1out')
        {
            $this->vb = 1;
            $this->ponches = 0;
            $this->boletos_recibidos = 0;
            $this->golpeados = 0;
            $this->sacrificios = 0;
            $this->hit = 0;
            $this->dobles = 0;
            $this->triples = 0;
            $this->hr = 0;
            $this->anotadas = 0;
            $this->rbi = 0;
            $this->robadas = 0;            
        }
        if($valor == '1ponche')
        {
            $this->ponches = 1;
            $this->vb = $this->vb + 1;
        }
        if($valor == '1boleto')
        {
            $this->boletos_recibidos = 1;
        }
        if($valor == '1golpeado')
        {
            $this->golpeados = 1;
        }
        if($valor == '1sacrificio')
        {
            $this->sacrificios = 1;
        }
        if($valor == '1hit')
        {
            $this->vb = $this->vb + 1;
            $this->hit = $this->hit + 1;
        }
        if($valor == '1doble')
        {
            $this->vb = $this->vb + 1;
            $this->hit = $this->hit + 1;
            $this->dobles = 1;
        }
        if($valor == '1triple')
        {
            $this->vb = $this->vb + 1;
            $this->hit = $this->hit + 1;
            $this->triples = 1;
        }
        if($valor == '1jonron')
        {
            $this->vb = $this->vb + 1;
            $this->hit = $this->hit + 1;
            $this->hr = 1;
        }
        if($valor == '1anotada')
        {
            $this->anotadas = 1;
        }

        if($valor == '2out')
        {
            $this->vb = 2;
            $this->ponches = 0;
            $this->boletos_recibidos = 0;
            $this->golpeados = 0;
            $this->sacrificios = 0;
            $this->hit = 0;
            $this->dobles = 0;
            $this->triples = 0;
            $this->hr = 0;
            $this->anotadas = 0;
            $this->rbi = 0;
            $this->robadas = 0;            
        }
        if($valor == '2ponche')
        {
            $this->ponches = 2;
            $this->vb = $this->vb + 2;
        }
        if($valor == '2boleto')
        {
            $this->boletos_recibidos = 2;
        }
        if($valor == '2golpeado')
        {
            $this->golpeados = 2;
        }
        if($valor == '2sacrificio')
        {
            $this->sacrificios = 2;
        }
        if($valor == '2hit')
        {
            $this->vb = $this->vb + 2;
            $this->hit = $this->hit + 2;
        }
        if($valor == '2doble')
        {
            $this->vb = $this->vb + 2;
            $this->hit = $this->hit + 2;
            $this->dobles = 2;
        }
        if($valor == '2triple')
        {
            $this->vb = $this->vb + 2;
            $this->hit = $this->hit + 2;
            $this->triples = 2;
        }
        if($valor == '2jonron')
        {
            $this->vb = $this->vb + 2;
            $this->hit = $this->hit + 2;
            $this->hr = 2;
        }
        if($valor == '2anotada')
        {
            $this->anotadas = 2;
        }

        if($valor == '3out')
        {
            $this->vb = 3;
            $this->ponches = 0;
            $this->boletos_recibidos = 0;
            $this->golpeados = 0;
            $this->sacrificios = 0;
            $this->hit = 0;
            $this->dobles = 0;
            $this->triples = 0;
            $this->hr = 0;
            $this->anotadas = 0;
            $this->rbi = 0;
            $this->robadas = 0;            
        }
        if($valor == '3ponche')
        {
            $this->ponches = 3;
            $this->vb = $this->vb + 3;
        }
        if($valor == '3boleto')
        {
            $this->boletos_recibidos = 3;
        }
        if($valor == '3golpeado')
        {
            $this->golpeados = 3;
        }
        if($valor == '3sacrificio')
        {
            $this->sacrificios = 3;
        }
        if($valor == '3hit')
        {
            $this->vb = $this->vb + 3;
            $this->hit = $this->hit + 3;
        }
        if($valor == '3doble')
        {
            $this->vb = $this->vb + 3;
            $this->hit = $this->hit + 3;
            $this->dobles = 3;
        }
        if($valor == '3triple')
        {
            $this->vb = $this->vb + 3;
            $this->hit = $this->hit + 3;
            $this->triples = 3;
        }
        if($valor == '3jonron')
        {
            $this->vb = $this->vb + 3;
            $this->hit = $this->hit + 3;
            $this->hr = 3;
        }
        if($valor == '3anotada')
        {
            $this->anotadas = 3;
        }

        if($valor == '4out')
        {
            $this->vb = 4;
            $this->ponches = 0;
            $this->boletos_recibidos = 0;
            $this->golpeados = 0;
            $this->sacrificios = 0;
            $this->hit = 0;
            $this->dobles = 0;
            $this->triples = 0;
            $this->hr = 0;
            $this->anotadas = 0;
            $this->rbi = 0;
            $this->robadas = 0;            
        }
        if($valor == '4ponche')
        {
            $this->ponches = 4;
            $this->vb = $this->vb + 4;
        }
        if($valor == '4boleto')
        {
            $this->boletos_recibidos = 4;
        }
        if($valor == '4golpeado')
        {
            $this->golpeados = 4;
        }
        if($valor == '4sacrificio')
        {
            $this->sacrificios = 4;
        }
        if($valor == '4hit')
        {
            $this->vb = $this->vb + 4;
            $this->hit = $this->hit + 4;
        }
        if($valor == '4doble')
        {
            $this->vb = $this->vb + 4;
            $this->hit = $this->hit + 4;
            $this->dobles = 4;
        }
        if($valor == '4triple')
        {
            $this->vb = $this->vb + 4;
            $this->hit = $this->hit + 4;
            $this->triples = 4;
        }
        if($valor == '4jonron')
        {
            $this->vb = $this->vb + 4;
            $this->hit = $this->hit + 4;
            $this->hr = 4;
        }
        if($valor == '4anotada')
        {
            $this->anotadas = 4;
        }

        if($valor == '5out')
        {
            $this->vb = 5;
            $this->ponches = 0;
            $this->boletos_recibidos = 0;
            $this->golpeados = 0;
            $this->sacrificios = 0;
            $this->hit = 0;
            $this->dobles = 0;
            $this->triples = 0;
            $this->hr = 0;
            $this->anotadas = 0;
            $this->rbi = 0;
            $this->robadas = 0;            
        }
        if($valor == '5ponche')
        {
            $this->ponches = 5;
            $this->vb = $this->vb + 5;
        }
        if($valor == '5boleto')
        {
            $this->boletos_recibidos = 5;
        }
        if($valor == '5golpeado')
        {
            $this->golpeados = 5;
        }
        if($valor == '5sacrificio')
        {
            $this->sacrificios = 5;
        }
        if($valor == '5hit')
        {
            $this->vb = $this->vb + 5;
            $this->hit = $this->hit + 5;
        }
        if($valor == '5doble')
        {
            $this->vb = $this->vb + 5;
            $this->hit = $this->hit + 5;
            $this->dobles = 5;
        }
        if($valor == '5triple')
        {
            $this->vb = $this->vb + 5;
            $this->hit = $this->hit + 5;
            $this->triples = 5;
        }
        if($valor == '5jonron')
        {
            $this->vb = $this->vb + 5;
            $this->hit = $this->hit + 5;
            $this->hr = 5;
        }
        if($valor == '5anotada')
        {
            $this->anotadas = 5;
        }

        if($valor == '6out')
        {
            $this->vb = 6;
            $this->ponches = 0;
            $this->boletos_recibidos = 0;
            $this->golpeados = 0;
            $this->sacrificios = 0;
            $this->hit = 0;
            $this->dobles = 0;
            $this->triples = 0;
            $this->hr = 0;
            $this->anotadas = 0;
            $this->rbi = 0;
            $this->robadas = 0;            
        }
        if($valor == '6ponche')
        {
            $this->ponches = 6;
            $this->vb = $this->vb + 6;
        }
        if($valor == '6boleto')
        {
            $this->boletos_recibidos = 6;
        }
        if($valor == '6golpeado')
        {
            $this->golpeados = 6;
        }
        if($valor == '6sacrificio')
        {
            $this->sacrificios = 6;
        }
        if($valor == '6hit')
        {
            $this->vb = $this->vb + 6;
            $this->hit = $this->hit + 6;
        }
        if($valor == '6doble')
        {
            $this->vb = $this->vb + 6;
            $this->hit = $this->hit + 6;
            $this->dobles = 6;
        }
        if($valor == '6triple')
        {
            $this->vb = $this->vb + 6;
            $this->hit = $this->hit + 6;
            $this->triples = 6;
        }
        if($valor == '6jonron')
        {
            $this->vb = $this->vb + 6;
            $this->hit = $this->hit + 6;
            $this->hr = 6;
        }
        if($valor == '6anotada')
        {
            $this->anotadas = 6;
        }
        if($valor == '1impulsada')
        {
            $this->rbi = 1;
        }
        if($valor == '2impulsada')
        {
            $this->rbi = 2;
        }
        if($valor == '3impulsada')
        {
            $this->rbi = 3;
        }
        if($valor == '4impulsada')
        {
            $this->rbi = 4;
        }
        if($valor == '5impulsada')
        {
            $this->rbi = 5;
        }
        if($valor == '6impulsada')
        {
            $this->rbi = 6;
        }
        if($valor == '7impulsada')
        {
            $this->rbi = 7;
        }
        if($valor == '8impulsada')
        {
            $this->rbi = 8;
        }
        if($valor == '9impulsada')
        {
            $this->rbi = 9;
        }
        if($valor == '10impulsada')
        {
            $this->rbi = 10;
        }
        if($valor == '1robo')
        {
            $this->robadas = 1;
        }
        if($valor == '2robo')
        {
            $this->robadas = 2;
        }
        if($valor == '3robo')
        {
            $this->robadas = 3;
        }
        if($valor == '4robo')
        {
            $this->robadas = 4;
        }
        if($valor == '5robo')
        {
            $this->robadas = 5;
        }
        if($valor == '6robo')
        {
            $this->robadas = 6;
        }
        if($valor == '7robo')
        {
            $this->robadas = 7;
        }
        if($valor == '8robo')
        {
            $this->robadas = 8;
        }
        if($valor == '9robo')
        {
            $this->robadas = 9;
        }
        if($valor == '10robo')
        {
            $this->robadas = 10;
        }
    }
    public function save_visita()
    {
        $this->validate([            
            'equipo_crear' => 'required|max:99',
            'nombre_crear' => 'required|max:75',
            'numero_crear' => 'numeric|max:999',
            'nacimiento_crear' => 'max:50',
            'batea_crear' => 'required|max:12',
            'lanza_crear' => 'required|max:12',
        ]);
        
        if($existe = Jugadore::where('nombre', $this->nombre_crear)->count())
        {
            $this->dispatch('duplicado');
        }
        else
        {
            $jug = Jugadore::create([
                'nombre' => ucwords($this->nombre_crear),
                'numero' => $this->numero_crear,
                'nacimiento' => $this->nacimiento_crear,
                'batea' => $this->batea_crear,
                'lanza' => $this->lanza_crear,
                'categoria_id' => $this->datos_juego->categoria_id,
                'campeonato_id' => $this->datos_juego->campeonato_id,
                'equipo_id' => $this->equipo_crear,
            ]);

            /*GRABANDO EN NUMERITOS*/

            $dia = substr($this->datos_juego->fecha_juego, 0, 2);
            $mes = substr($this->datos_juego->fecha_juego, 3, 2);
            $anio = substr($this->datos_juego->fecha_juego, 6, 4);

            $fecha_invertida = $anio.$mes.$dia;

            $numero = JugadoresNumero::create([
                'juego_id' => $this->id_juego,
                'fecha' => $this->datos_juego->fecha_juego,
                'jugador_id' => $jug->id,
                'oponente_id' => $this->datos_juego->casa_id,
                'campeonato_id' => $this->datos_juego->id,
                'categoria_id' => $this->datos_juego->categoria_id,
                'fecha_invertida' => $fecha_invertida,
            ]) ;

            $numero_defensiva = JugadoresDefensiva::create([
                'juego_id' => $this->id_juego,
                'fecha' => $this->datos_juego->fecha_juego,
                'jugador_id' => $jug->id,
                'oponente_id' => $this->datos_juego->casa_id,
                'campeonato_id' => $this->datos_juego->id,
                'categoria_id' => $this->datos_juego->categoria_id,
                'fecha_invertida' => $fecha_invertida,
            ]) ;

            /*FIN DE GRABAR EN NUMERITOS*/

            $this->reset(['open_crear_visita', 'equipo_crear', 'nombre_crear', 'numero_crear', 'nacimiento_crear', 'batea_crear', 'lanza_crear']);

            $this->dispatch('render');
        }
    }

    public function cargar_bateo(JugadoresNumero $jugador_bateo)
    {
        $nomb = Jugadore::where('id', $jugador_bateo->jugador_id)->first();
        $equi = Equipo::where('id', $nomb->equipo_id)->first();

        $this->nombre_bateo = $nomb->nombre;
        $this->equipo_bateo = $equi->nombre;
        
        /*BATEO*/

        $this->id_bateo = $jugador_bateo['id'];
        $this->vb = $jugador_bateo['vb'];
        $this->anotadas = $jugador_bateo['anotadas'];
        $this->hit = $jugador_bateo['hit'];
        $this->dobles = $jugador_bateo['dobles'];
        $this->triples = $jugador_bateo['triples'];
        $this->hr = $jugador_bateo['hr'];
        $this->rbi = $jugador_bateo['rbi'];
        $this->boletos_recibidos = $jugador_bateo['boletos_recibidos'];
        $this->ponches = $jugador_bateo['ponches'];
        $this->robadas = $jugador_bateo['robadas'];
        $this->alcanzadas = $jugador_bateo['alcanzadas'];
        $this->sacrificios = $jugador_bateo['sacrificios'];
        $this->golpeados = $jugador_bateo['golpeados'];
        $this->apariciones = $jugador_bateo['apariciones'];
        $this->vo = $jugador_bateo['vo'];
        $this->orden_bat = $jugador_bateo['orden_bat'];
        $this->posicion_defensa = $jugador_bateo['posicion'];

        /*DEFENSA RXPRESS*/

        $this->juego_id_express = $jugador_bateo['juego_id'];
        $this->fecha_express = $jugador_bateo['fecha'];
        $this->id_jugador_crear_express = $jugador_bateo['jugador_id']; 
        $this->oponente_express = $jugador_bateo['oponente_id']; 
        $this->liga_express = $jugador_bateo['liga_id']; 
        $this->campeonato_express = $jugador_bateo['campeonato_id']; 
        $this->categoria_express = $jugador_bateo['categoria_id']; 

        $this->open_cargar_bateo = true;
    }

    public function cargar_colmena(JugadoresNumero $jugador_bateo)
    {
        $nomb = Jugadore::where('id', $jugador_bateo->jugador_id)->first();
        $equi = Equipo::where('id', $nomb->equipo_id)->first();

        $this->nombre_bateo = $nomb->nombre;
        $this->equipo_bateo = $equi->nombre;
        
        $this->reset(['open_cargar_colmena','accion11','accion12','accion13','accion14','accion15','accion16','accion21','accion22','accion23','accion24','accion25','accion26','accion31','accion32','accion33','accion34','accion35','accion36','accion41','accion42','accion43','accion44','accion45','accion46','accion51','accion52','accion53','accion54','accion55','accion56','accion61','accion62','accion63','accion64','accion65','accion66']);

        /*BATEO*/

        $this->id_bateo = $jugador_bateo['id'];
        $this->vb = $jugador_bateo['vb'];
        $this->anotadas = $jugador_bateo['anotadas'];
        $this->hit = $jugador_bateo['hit'];
        $this->dobles = $jugador_bateo['dobles'];
        $this->triples = $jugador_bateo['triples'];
        $this->hr = $jugador_bateo['hr'];
        $this->rbi = $jugador_bateo['rbi'];
        $this->boletos_recibidos = $jugador_bateo['boletos_recibidos'];
        $this->ponches = $jugador_bateo['ponches'];
        $this->robadas = $jugador_bateo['robadas'];
        $this->alcanzadas = $jugador_bateo['alcanzadas'];
        $this->sacrificios = $jugador_bateo['sacrificios'];
        $this->golpeados = $jugador_bateo['golpeados'];
        $this->apariciones = $jugador_bateo['apariciones'];
        $this->vo = $jugador_bateo['vo'];
        $this->orden_bat = $jugador_bateo['orden_bat'];
        $this->posicion_defensa = $jugador_bateo['posicion'];

        /*DEFENSA RXPRESS*/

        $this->juego_id_express = $jugador_bateo['juego_id'];
        $this->fecha_express = $jugador_bateo['fecha'];
        $this->id_jugador_crear_express = $jugador_bateo['jugador_id']; 
        $this->oponente_express = $jugador_bateo['oponente_id']; 
        $this->liga_express = $jugador_bateo['liga_id']; 
        $this->campeonato_express = $jugador_bateo['campeonato_id']; 
        $this->categoria_express = $jugador_bateo['categoria_id']; 

        $this->open_cargar_colmena = true;
    }

    public function update_bateo()
    {
        $this->validate([
            'vb' => 'numeric|max:20',
            'anotadas' => 'numeric|max:20',
            'hit' => 'numeric|max:20',
            'dobles' => 'numeric|max:20',
            'triples' => 'numeric|max:20',
            'hr' => 'numeric|max:20',
            'rbi' => 'numeric|max:20',
            'boletos_recibidos' => 'numeric|max:20',
            'ponches' => 'numeric|max:20',
            'robadas' => 'numeric|max:20',
            'sacrificios' =>  'numeric|max:20',
            'golpeados' =>  'numeric|max:20',
            'orden_bat' =>  'required|numeric|max:18',
            'posicion_defensa' =>  'required|max:15',
        ]);

        if($this->vb > 0)
        {
            $average = ($this->hit * 1000) / $this->vb;
            $slg = ((($this->hit - $this->dobles - $this->triples - $this->hr) + (($this->dobles * 2) + ($this->triples * 3) + ($this->hr * 4))) / $this->vb) * 1000;
        }
        else
        {
            $average = 0;
            $slg = 0;
        }

        $actualizar = JugadoresNumero::where('id', $this->id_bateo)
        ->update([
            'juegos' => 1,
            'vb' => $this->vb,
            'anotadas' => $this->anotadas,
            'hit' => $this->hit,
            'dobles' => $this->dobles,
            'triples' => $this->triples,
            'hr' => $this->hr,
            'rbi' => $this->rbi,
            'boletos_recibidos' => $this->boletos_recibidos,
            'ponches' => $this->ponches,
            'robadas' => $this->robadas,
            'average' => $average,
            'slugging' => $slg,
            'sacrificios' => $this->sacrificios,
            'golpeados' => $this->golpeados,
            'alcanzadas' => ($this->hit - $this->dobles - $this->triples - $this->hr) + (($this->dobles * 2) + ($this->triples * 3) + ($this->hr * 4)), //$this->alcanzadas,
            'apariciones' => $this->vb + $this->boletos_recibidos + $this->sacrificios + $this->golpeados, //$this->apariciones,
            'orden_bat' => $this->orden_bat,
            'posicion' => $this->posicion_defensa,
        ]);
        $this->input_radio = null;
        $this->uno = null;
        $this->dos = null;
        $this->tres = null;
        $this->cuatro = null;
        $this->cinco = null;
        $this->seis = null;
        $this->siete = null;
        $this->ocho = null;
        $this->nueve = null;
        $this->diez = null;
        $this->once = null;
        $this->doce = null;
        $this->dispatch('alert');
    }

    public function update_colmena()
    {
        $this->validate([
            'vb' => 'numeric|max:20',
            'anotadas' => 'numeric|max:20',
            'hit' => 'numeric|max:20',
            'dobles' => 'numeric|max:20',
            'triples' => 'numeric|max:20',
            'hr' => 'numeric|max:20',
            'rbi' => 'numeric|max:20',
            'boletos_recibidos' => 'numeric|max:20',
            'ponches' => 'numeric|max:20',
            'robadas' => 'numeric|max:20',
            'sacrificios' =>  'numeric|max:20',
            'golpeados' =>  'numeric|max:20',
            'orden_bat' =>  'required|numeric|max:18',
            'posicion_defensa' =>  'required|max:15',
        ]);

        $this->hit = 0;
        $this->dobles = 0;
        $this->triples = 0;
        $this->hr = 0;
        $this->vb = 0;
        $average = 0;
        $slg = 0;
        $this->boletos_recibidos = 0;
        $this->golpeados = 0;
        $this->sacrificios = 0;
        $this->robadas = 0;
        $this->anotadas = 0;
        $this->rbi = 0;
        $this->ponches = 0;

        //1er TURNO
        if($this->accion11 == 99 or $this->accion11 == 1 or $this->accion11 == 2 or $this->accion11 == 3 or $this->accion11 == 4 or $this->accion11 == 5)
        {
            $this->vb = $this->vb  + 1;

            if($this->accion11 == 1)
            {
                $this->hit = $this->hit + 1;
            }

            if($this->accion11 == 2)
            {
                $this->hit = $this->hit + 1;
                $this->dobles = $this->dobles + 1;
            }

            if($this->accion11 == 3)
            {
                $this->hit = $this->hit + 1;
                $this->triples = $this->triples + 1;
            }

            if($this->accion11 == 4)
            {
                $this->hit = $this->hit + 1;
                $this->hr = $this->hr + 1;
            }

            if($this->accion11 == 5)
            {
                $this->ponches = $this->ponches + 1;
            }
        }
        else
        {
            if($this->accion11 == 6)
            {
                $this->boletos_recibidos = $this->boletos_recibidos + 1;
            }

            if($this->accion11 == 7)
            {
                $this->golpeados = $this->golpeados + 1;
            }

            if($this->accion11 == 8)
            {
                $this->sacrificios = $this->sacrificios + 1;
            }
        }

        if($this->accion12 == "robo")
        {
            $this->robadas = $this->robadas + 1;
        }

        if($this->accion13 == "robo")
        {
            $this->robadas = $this->robadas + 1;
        }

        if($this->accion14 == "robo")
        {
            $this->robadas = $this->robadas + 1;
        }

        if($this->accion15 == "anotada")
        {
            $this->anotadas = $this->anotadas + 1;
        }

        if($this->accion16 == "empujo1")
        {
            $this->rbi = $this->rbi + 1;
        }

        if($this->accion16 == "empujo2")
        {
            $this->rbi = $this->rbi + 2;
        }

        if($this->accion16 == "empujo3")
        {
            $this->rbi = $this->rbi + 3;
        }

        if($this->accion16 == "empujo4")
        {
            $this->rbi = $this->rbi + 4;
        }

        //2do TURNO
        if($this->accion21 == 99 or $this->accion21 == 1 or $this->accion21 == 2 or $this->accion21 == 3 or $this->accion21 == 4 or $this->accion21 == 5)
        {
            $this->vb = $this->vb  + 1;

            if($this->accion21 == 1)
            {
                $this->hit = $this->hit + 1;
            }

            if($this->accion21 == 2)
            {
                $this->hit = $this->hit + 1;
                $this->dobles = $this->dobles + 1;
            }

            if($this->accion21 == 3)
            {
                $this->hit = $this->hit + 1;
                $this->triples = $this->triples + 1;
            }

            if($this->accion21 == 4)
            {
                $this->hit = $this->hit + 1;
                $this->hr = $this->hr + 1;
            }

            if($this->accion21 == 5)
            {
                $this->ponches = $this->ponches + 1;
            }
        }
        else
        {
            if($this->accion21 == 6)
            {
                $this->boletos_recibidos = $this->boletos_recibidos + 1;
            }

            if($this->accion21 == 7)
            {
                $this->golpeados = $this->golpeados + 1;
            }

            if($this->accion21 == 8)
            {
                $this->sacrificios = $this->sacrificios + 1;
            }
        }

        if($this->accion22 == "robo")
        {
            $this->robadas = $this->robadas + 1;
        }

        if($this->accion23 == "robo")
        {
            $this->robadas = $this->robadas + 1;
        }

        if($this->accion24 == "robo")
        {
            $this->robadas = $this->robadas + 1;
        }

        if($this->accion25 == "anotada")
        {
            $this->anotadas = $this->anotadas + 1;
        }

        if($this->accion26 == "empujo1")
        {
            $this->rbi = $this->rbi + 1;
        }

        if($this->accion26 == "empujo2")
        {
            $this->rbi = $this->rbi + 2;
        }

        if($this->accion26 == "empujo3")
        {
            $this->rbi = $this->rbi + 3;
        }

        if($this->accion26 == "empujo4")
        {
            $this->rbi = $this->rbi + 4;
        }
        
        //3er TURNO
        if($this->accion31 == 99 or $this->accion31 == 1 or $this->accion31 == 2 or $this->accion31 == 3 or $this->accion31 == 4 or $this->accion31 == 5)
        {
            $this->vb = $this->vb  + 1;

            if($this->accion31 == 1)
            {
                $this->hit = $this->hit + 1;
            }

            if($this->accion31 == 2)
            {
                $this->hit = $this->hit + 1;
                $this->dobles = $this->dobles + 1;
            }

            if($this->accion31 == 3)
            {
                $this->hit = $this->hit + 1;
                $this->triples = $this->triples + 1;
            }

            if($this->accion31 == 4)
            {
                $this->hit = $this->hit + 1;
                $this->hr = $this->hr + 1;
            }

            if($this->accion31 == 5)
            {
                $this->ponches = $this->ponches + 1;
            }
        }
        else
        {
            if($this->accion31 == 6)
            {
                $this->boletos_recibidos = $this->boletos_recibidos + 1;
            }

            if($this->accion31 == 7)
            {
                $this->golpeados = $this->golpeados + 1;
            }

            if($this->accion31 == 8)
            {
                $this->sacrificios = $this->sacrificios + 1;
            }
        }

        if($this->accion32 == "robo")
        {
            $this->robadas = $this->robadas + 1;
        }

        if($this->accion33 == "robo")
        {
            $this->robadas = $this->robadas + 1;
        }

        if($this->accion34 == "robo")
        {
            $this->robadas = $this->robadas + 1;
        }

        if($this->accion35 == "anotada")
        {
            $this->anotadas = $this->anotadas + 1;
        }

        if($this->accion36 == "empujo1")
        {
            $this->rbi = $this->rbi + 1;
        }

        if($this->accion36 == "empujo2")
        {
            $this->rbi = $this->rbi + 2;
        }

        if($this->accion36 == "empujo3")
        {
            $this->rbi = $this->rbi + 3;
        }

        if($this->accion36 == "empujo4")
        {
            $this->rbi = $this->rbi + 4;
        }

        //4to TURNO
        if($this->accion41 == 99 or $this->accion41 == 1 or $this->accion41 == 2 or $this->accion41 == 3 or $this->accion41 == 4 or $this->accion41 == 5)
        {
            $this->vb = $this->vb  + 1;

            if($this->accion41 == 1)
            {
                $this->hit = $this->hit + 1;
            }

            if($this->accion41 == 2)
            {
                $this->hit = $this->hit + 1;
                $this->dobles = $this->dobles + 1;
            }

            if($this->accion41 == 3)
            {
                $this->hit = $this->hit + 1;
                $this->triples = $this->triples + 1;
            }

            if($this->accion41 == 4)
            {
                $this->hit = $this->hit + 1;
                $this->hr = $this->hr + 1;
            }

            if($this->accion41 == 5)
            {
                $this->ponches = $this->ponches + 1;
            }
        }
        else
        {
            if($this->accion41 == 6)
            {
                $this->boletos_recibidos = $this->boletos_recibidos + 1;
            }

            if($this->accion41 == 7)
            {
                $this->golpeados = $this->golpeados + 1;
            }

            if($this->accion41 == 8)
            {
                $this->sacrificios = $this->sacrificios + 1;
            }
        }

        if($this->accion42 == "robo")
        {
            $this->robadas = $this->robadas + 1;
        }

        if($this->accion43 == "robo")
        {
            $this->robadas = $this->robadas + 1;
        }

        if($this->accion44 == "robo")
        {
            $this->robadas = $this->robadas + 1;
        }

        if($this->accion45 == "anotada")
        {
            $this->anotadas = $this->anotadas + 1;
        }

        if($this->accion46 == "empujo1")
        {
            $this->rbi = $this->rbi + 1;
        }

        if($this->accion46 == "empujo2")
        {
            $this->rbi = $this->rbi + 2;
        }

        if($this->accion46 == "empujo3")
        {
            $this->rbi = $this->rbi + 3;
        }

        if($this->accion46 == "empujo4")
        {
            $this->rbi = $this->rbi + 4;
        }
        
        //5to TURNO
        if($this->accion51 == 99 or $this->accion51 == 1 or $this->accion51 == 2 or $this->accion51 == 3 or $this->accion51 == 4 or $this->accion51 == 5)
        {
            $this->vb = $this->vb  + 1;

            if($this->accion51 == 1)
            {
                $this->hit = $this->hit + 1;
            }

            if($this->accion51 == 2)
            {
                $this->hit = $this->hit + 1;
                $this->dobles = $this->dobles + 1;
            }

            if($this->accion51 == 3)
            {
                $this->hit = $this->hit + 1;
                $this->triples = $this->triples + 1;
            }

            if($this->accion51 == 4)
            {
                $this->hit = $this->hit + 1;
                $this->hr = $this->hr + 1;
            }

            if($this->accion51 == 5)
            {
                $this->ponches = $this->ponches + 1;
            }
        }
        else
        {
            if($this->accion51 == 6)
            {
                $this->boletos_recibidos = $this->boletos_recibidos + 1;
            }

            if($this->accion51 == 7)
            {
                $this->golpeados = $this->golpeados + 1;
            }

            if($this->accion51 == 8)
            {
                $this->sacrificios = $this->sacrificios + 1;
            }
        }

        if($this->accion52 == "robo")
        {
            $this->robadas = $this->robadas + 1;
        }

        if($this->accion53 == "robo")
        {
            $this->robadas = $this->robadas + 1;
        }

        if($this->accion54 == "robo")
        {
            $this->robadas = $this->robadas + 1;
        }

        if($this->accion55 == "anotada")
        {
            $this->anotadas = $this->anotadas + 1;
        }

        if($this->accion56 == "empujo1")
        {
            $this->rbi = $this->rbi + 1;
        }

        if($this->accion56 == "empujo2")
        {
            $this->rbi = $this->rbi + 2;
        }

        if($this->accion56 == "empujo3")
        {
            $this->rbi = $this->rbi + 3;
        }

        if($this->accion56 == "empujo4")
        {
            $this->rbi = $this->rbi + 4;
        }
        
        //6to TURNO
        if($this->accion61 == 99 or $this->accion61 == 1 or $this->accion61 == 2 or $this->accion61 == 3 or $this->accion61 == 4 or $this->accion61 == 5)
        {
            $this->vb = $this->vb  + 1;

            if($this->accion61 == 1)
            {
                $this->hit = $this->hit + 1;
            }

            if($this->accion61 == 2)
            {
                $this->hit = $this->hit + 1;
                $this->dobles = $this->dobles + 1;
            }

            if($this->accion61 == 3)
            {
                $this->hit = $this->hit + 1;
                $this->triples = $this->triples + 1;
            }

            if($this->accion61 == 4)
            {
                $this->hit = $this->hit + 1;
                $this->hr = $this->hr + 1;
            }

            if($this->accion61 == 5)
            {
                $this->ponches = $this->ponches + 1;
            }
        }
        else
        {
            if($this->accion61 == 6)
            {
                $this->boletos_recibidos = $this->boletos_recibidos + 1;
            }

            if($this->accion61 == 7)
            {
                $this->golpeados = $this->golpeados + 1;
            }

            if($this->accion61 == 8)
            {
                $this->sacrificios = $this->sacrificios + 1;
            }
        }

        if($this->accion62 == "robo")
        {
            $this->robadas = $this->robadas + 1;
        }

        if($this->accion63 == "robo")
        {
            $this->robadas = $this->robadas + 1;
        }

        if($this->accion64 == "robo")
        {
            $this->robadas = $this->robadas + 1;
        }

        if($this->accion65 == "anotada")
        {
            $this->anotadas = $this->anotadas + 1;
        }

        if($this->accion66 == "empujo1")
        {
            $this->rbi = $this->rbi + 1;
        }

        if($this->accion66 == "empujo2")
        {
            $this->rbi = $this->rbi + 2;
        }

        if($this->accion66 == "empujo3")
        {
            $this->rbi = $this->rbi + 3;
        }

        if($this->accion66 == "empujo4")
        {
            $this->rbi = $this->rbi + 4;
        }
        
        if($this->vb > 0)
        {
            $average = ($this->hit * 1000) / $this->vb;
            $slg = ((($this->hit - $this->dobles - $this->triples - $this->hr) + (($this->dobles * 2) + ($this->triples * 3) + ($this->hr * 4))) / $this->vb) * 1000;
        }
        else
        {
            $average = 0;
            $slg = 0;
        }

        $actualizar = JugadoresNumero::where('id', $this->id_bateo)
        ->update([
            'juegos' => 1,
            'vb' => $this->vb,
            'anotadas' => $this->anotadas,
            'hit' => $this->hit,
            'dobles' => $this->dobles,
            'triples' => $this->triples,
            'hr' => $this->hr,
            'rbi' => $this->rbi,
            'boletos_recibidos' => $this->boletos_recibidos,
            'ponches' => $this->ponches,
            'robadas' => $this->robadas,
            'average' => $average,
            'slugging' => $slg,
            'sacrificios' => $this->sacrificios,
            'golpeados' => $this->golpeados,
            'alcanzadas' => ($this->hit - $this->dobles - $this->triples - $this->hr) + (($this->dobles * 2) + ($this->triples * 3) + ($this->hr * 4)), //$this->alcanzadas,
            'apariciones' => $this->vb + $this->boletos_recibidos + $this->sacrificios + $this->golpeados, //$this->apariciones,
            'orden_bat' => $this->orden_bat,
            'posicion' => $this->posicion_defensa,
        ]);

        $this->dispatch('alert');
    }

    public function cargar_pitcheo(JugadoresNumero $jugador_pitcheo)
    {
        $nomb = Jugadore::where('id', $jugador_pitcheo->jugador_id)->first();
        $equi = Equipo::where('id', $nomb->equipo_id)->first();

        $this->nombre_pitcheo = $nomb->nombre;
        $this->equipo_pitcheo = $equi->nombre;

        $this->id_pitcheo = $jugador_pitcheo['id'];
        $this->j = $jugador_pitcheo['j'];
        $this->pitcheos = $jugador_pitcheo['pitcheos'];
        $this->ganados = $jugador_pitcheo['ganados'];
        $this->perdidos = $jugador_pitcheo['perdidos'];
        $this->blanqueos = $jugador_pitcheo['blanqueos'];
        $this->salvados = $jugador_pitcheo['salvados'];
        $this->ip = $jugador_pitcheo['ip'];
        $this->carreras_permitidas = $jugador_pitcheo['carreras_permitidas'];
        $this->carreras_limpias = $jugador_pitcheo['carreras_limpias'];
        $this->ponches_propinados = $jugador_pitcheo['ponches_propinados'];
        $this->boletos_otorgados = $jugador_pitcheo['boletos_otorgados'];
        $this->hp = $jugador_pitcheo['hp'];
        $this->iniciados = $jugador_pitcheo['iniciados'];
        $this->relevos = $jugador_pitcheo['relevos'];
        $this->completos = $jugador_pitcheo['completos'];
        $this->h2 = $jugador_pitcheo['h2'];
        $this->h3 = $jugador_pitcheo['h3'];
        $this->h4 = $jugador_pitcheo['h4'];
        $this->gp = $jugador_pitcheo['gp'];
        $this->wp = $jugador_pitcheo['wp'];
        $this->bk = $jugador_pitcheo['bk'];
        $this->veces_bate = $jugador_pitcheo['veces_bate'];

        $this->open_cargar_pitcheo = true;
    }

    public function update_pitcheo()
    {
        $this->validate([
            'ganados' => 'numeric|max:1',
            'pitcheos' => 'numeric|max:120',
            'perdidos' => 'numeric|max:1',
            'blanqueos' => 'numeric|max:1',
            'salvados' => 'numeric|max:1',
            'ip' => 'numeric|max:10',
            'carreras_permitidas' => 'numeric|max:20',
            'carreras_limpias' => 'numeric|max:20',
            'ponches_propinados' => 'numeric|max:20',
            'boletos_otorgados' => 'numeric|max:20',
            'hp' => 'numeric|max:20',
            'iniciados' => 'numeric|max:20',
            'relevos' => 'numeric|max:1',
            'veces_bate' => 'numeric|max:40',
            'completos' => 'numeric|max:1',
            'h2' => 'numeric|max:20',
            'h3' => 'numeric|max:20',
            'h4' => 'numeric|max:20',
            'gp' => 'numeric|max:20',
            'wp' => 'numeric|max:20',
            'bk' => 'numeric|max:20',
        ]);

        if($this->ip > 0)
        {
            $efectividad = ($this->carreras_limpias * 9) / $this->ip;
        }
        else
        {
            if($this->carreras_limpias > 0)
            {
                $efectividad = 9999;
            }
            else
            {
                $efectividad = 0;
            }
        }

        $actualizar = JugadoresNumero::where('id', $this->id_pitcheo)
        ->update([
            'j' => 1,
            'pitcheos' => $this->pitcheos,
            'ganados' => $this->ganados,
            'perdidos' => $this->perdidos,
            'blanqueos' => $this->blanqueos,
            'salvados' => $this->salvados,
            'ip' => $this->ip,
            'carreras_permitidas' => $this->carreras_permitidas,
            'carreras_limpias' => $this->carreras_limpias,
            'ponches_propinados' => $this->ponches_propinados,
            'boletos_otorgados' => $this->boletos_otorgados,
            'hp' => $this->hp,
            'efectividad' => $efectividad,
            'iniciados' => $this->iniciados,
            'relevos' => $this->relevos,
            'completos' => $this->completos,
            'veces_bate' => $this->veces_bate,
            'h2' => $this->h2,
            'h3' => $this->h3,
            'h4' => $this->h4,
            'gp' => $this->gp,
            'wp' => $this->wp,
            'bk' => $this->bk,
        ]);

        $this->reset(['open_cargar_pitcheo','pitcheos','ganados','perdidos','blanqueos','salvados','ip','carreras_permitidas','carreras_limpias','ponches_propinados','boletos_otorgados','hp', 'iniciados', 'relevos', 'completos', 'h2', 'h3', 'h4', 'gp', 'wp', 'bk', 'veces_bate']);
    }

    public function crear_defensa(JugadoresDefensiva $jugador_defensa)
    {
        $nomb = Jugadore::where('id', $jugador_defensa->jugador_id)->first();
        $equi = Equipo::where('id', $nomb->equipo_id)->first();

        $this->nombre_defensa_crear = $nomb->nombre;
        $this->equipo_defensa_crear = $equi->nombre;
        $this->id_jugador_crear = $nomb->id;

        $this->open_crear_defensa = true;
    }

    public function update_crear_defensa()
    {
        $this->validate([
            'posicion_crear' => 'numeric|max:9|min:1|integer',
            'innings_crear' => 'numeric|max:20',
            'outs_crear' => 'numeric|max:27',
            'asistencias_crear' => 'numeric|max:20',
            'errores_crear' => 'numeric|max:20',
        ]);

        if(($this->outs_crear + $this->asistencias_crear + $this->errores_crear) > 0)
        {
            $porcentaje = ($this->outs_crear + $this->asistencias_crear) / ($this->outs_crear + $this->asistencias_crear + $this->errores_crear) * 1000;
        }
        else
        {
            $porcentaje = 0;
        }

        if($this->datos_juego->visita_id == $this->id_equipo)
        {
            $equipo_grabar = $this->datos_juego->visita_id;
        }
        else
        {
            $equipo_grabar = $this->datos_juego->casa_id;
        }

        $dia = substr($this->datos_juego->fecha_juego, 0, 2);
        $mes = substr($this->datos_juego->fecha_juego, 3, 2);
        $anio = substr($this->datos_juego->fecha_juego, 6, 4);

        $fecha_invertida = $anio.$mes.$dia;

        $grabar = JugadoresDefensiva::create([
            'fecha' => $this->datos_juego->fecha_juego,
            'juego_id' => $this->id_juego,
            'jugador_id' => $this->id_jugador_crear,
            'oponente_id' => $equipo_grabar,
            'campeonato_id' => $this->datos_juego->campeonato_id,
            'categoria_id' => $this->datos_juego->categoria_id,
            'juegos' => 1,
            'posicion' => $this->posicion_crear,
            'innings' => $this->innings_crear,
            'outs' => $this->outs_crear,
            'asistencias' => $this->asistencias_crear,
            'errores' => $this->errores_crear,
            'porcentaje_fildeo' => $porcentaje,
            'fecha_invertida' => $fecha_invertida,
        ]);

        $this->reset(['open_crear_defensa','posicion_crear','innings_crear','outs_crear','asistencias_crear','errores_crear']);
    }

    public function update_crear_defensa_express()
    {
        $this->validate([
            'posicion_crear_express' => 'numeric|max:9|min:1|integer',
            'innings_crear_express' => 'numeric|max:20',
            'outs_crear_express' => 'numeric|max:27',
            'asistencias_crear_express' => 'numeric|max:20',
            'errores_crear_express' => 'numeric|max:20',
        ]);

        if(($this->outs_crear_express + $this->asistencias_crear_express + $this->errores_crear_express) > 0)
        {
            $porcentaje = ($this->outs_crear_express + $this->asistencias_crear_express) / ($this->outs_crear_express + $this->asistencias_crear_express + $this->errores_crear_express) * 1000;
        }
        else
        {
            $porcentaje = 0;
        }

        $dia = substr($this->fecha_express, 0, 2);
        $mes = substr($this->fecha_express, 3, 2);
        $anio = substr($this->fecha_express, 6, 4);

        $fecha_invertida = $anio.$mes.$dia;

        $grabar = JugadoresDefensiva::create([
            'fecha' => $this->fecha_express,
            'juego_id' => $this->juego_id_express,
            'jugador_id' => $this->id_jugador_crear_express,
            'oponente_id' => $this->oponente_express,
            'liga_id' => $this->liga_express,
            'campeonato_id' => $this->campeonato_express,
            'categoria_id' => $this->categoria_express,
            'juegos' => 1,
            'posicion' => $this->posicion_crear_express,
            'innings' => $this->innings_crear_express,
            'outs' => $this->outs_crear_express,
            'asistencias' => $this->asistencias_crear_express,
            'errores' => $this->errores_crear_express,
            'porcentaje_fildeo' => $porcentaje,
            'fecha_invertida' => $fecha_invertida,
        ]);

        $this->reset(['posicion_crear_express','innings_crear_express','outs_crear_express','asistencias_crear_express','errores_crear_express']);

        $this->dispatch('alert');
    }

    public function edit_defensa(JugadoresDefensiva $jugador_defensa)
    {
        $nomb = Jugadore::where('id', $jugador_defensa->jugador_id)->first();
        $equi = Equipo::where('id', $nomb->equipo_id)->first();

        $this->nombre_defensa = $nomb->nombre;
        $this->equipo_defensa = $equi->nombre;
        $this->id_jugador = $nomb->id;

        $this->id_defensa = $jugador_defensa['id'];
        $this->id_equipo = $jugador_defensa['id_equipo'];
        $this->posicion = $jugador_defensa['posicion'];
        $this->innings = $jugador_defensa['innings'];
        $this->outs = $jugador_defensa['outs'];
        $this->asistencias = $jugador_defensa['asistencias'];
        $this->errores = $jugador_defensa['errores'];
        
        $this->open_edit_defensa = true;
    }

    public function update_edit_defensa(){
        $this->validate([
            'posicion' => 'numeric|max:9|min:1|integer',
            'innings' => 'numeric|max:20',
            'outs' => 'numeric|max:27',
            'asistencias' => 'numeric|max:20',
            'errores' => 'numeric|max:20',
        ]);

        if(($this->outs + $this->asistencias + $this->errores) > 0)
        {
            $porcentaje = ($this->outs + $this->asistencias) / ($this->outs + $this->asistencias + $this->errores) * 1000;
        }
        else
        {
            $porcentaje = 0;
        }

        $actualizar = JugadoresDefensiva::where('id', $this->id_defensa)
        ->update([
            'juegos' => 1,
            'posicion' => $this->posicion,
            'innings' => $this->innings,
            'outs' => $this->outs,
            'asistencias' => $this->asistencias,
            'errores' => $this->errores,
            'porcentaje_fildeo' => $porcentaje,
        ]);

        $this->reset(['open_edit_defensa','posicion','innings','outs','asistencias','errores']);
    }

}
