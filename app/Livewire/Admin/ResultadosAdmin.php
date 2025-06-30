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

class ResultadosAdmin extends Component
{
    public $datos_torneo, $id_torneo;
    public $lista_estadios=[], $lista_grupos=[], $lista_equipos=[], $lista_anotadores=[], $lista_arbitros=[], $lista_condiciones=[], $lista_jugadores=[];
    public $estadio_id_crear, $fecha_crear, $hora_crear, $grupo_id_crear, $visita_id_crear, $casa_id_crear, $visita_carreras_crear, $casa_carreras_crear, $visita_hits_crear, $casa_hits_crear, $visita_errores_crear, $casa_errores_crear, $anotador_id_crear, $arbitro1_id_crear, $arbitro2_id_crear, $arbitro3_id_crear, $arbitro4_id_crear, $numero_juego, $condicion_crear='Normal', $condicion_editar;

    public $id_juego, $fecha_juego, $hora_juego, $estadio_id, $grupo_id, $visita_id, $anotacion_visita, $hits_visita, $errores_visita, $casa_id, $anotacion_casa, $hits_casa, $errores_casa, $anotador_id, $arbitro1_id, $arbitro2_id, $arbitro3_id, $arbitro4_id, $facturado_id, $bat_destacado, $bat_destacado_texto, $pit_destacado, $pit_destacado_texto, $numero_juego_editar;

    public $open_crear = false;
    public $open_edit = false;

    public function mount($id_torneo)
    {
        $this->id_torneo = $id_torneo;

        if(auth()->user()->nivel_id <> 1)
        {
            session()->flush();
            return redirect()->route('login');
        }

        $this->datos_torneo = DB::table('campeonatos')
        ->select('campeonatos.id as id', 'campeonatos.categoria_id as categoria_id','campeonatos.*','categorias.categoria as categoria')
        ->join('categorias', 'categorias.id', '=', 'campeonatos.categoria_id')
        ->where('campeonatos.id', $this->id_torneo)
        ->first();
    }

    public function render()
    {
        $this->lista_estadios = Estadio::orderBy('nombre','asc')->get();
        $this->lista_grupos = Grupo::orderBy('grupo','asc')->get();
        $this->lista_equipos = Equipo::where('campeonato_id', $this->datos_torneo->id)->where('categoria_id', $this->datos_torneo->categoria_id)->orderBy('nombre','asc')->get();
        $this->lista_anotadores = Anotadore::orderBy('nombre','asc')->get();
        $this->lista_arbitros = Arbitro::orderBy('nombre','asc')->get();
        $this->lista_condiciones = Condicione::orderBy('id','asc')->get();

        $juegos = Calendario::where('categoria_id', $this->datos_torneo->categoria_id)->where('campeonato_id', $this->datos_torneo->id)->orderBy('fecha_invertida','desc')->get();

        return view('livewire.admin.resultados-admin', compact('juegos'));
    }

    public function edit(Calendario $juego_editar)
    {
        $this->resetValidation();

        $this->id_juego = $juego_editar['id'];
        $this->fecha_juego = $juego_editar['fecha_juego'];
        $this->hora_juego = $juego_editar['hora_juego'];
        $this->estadio_id = $juego_editar['estadio_id'];
        $this->grupo_id = $juego_editar['grupo_id'];
        $this->visita_id = $juego_editar['visita_id'];
        $this->anotacion_visita = $juego_editar['anotacion_visita'];
        $this->hits_visita = $juego_editar['hits_visita'];
        $this->errores_visita = $juego_editar['errores_visita'];
        $this->casa_id = $juego_editar['casa_id'];
        $this->anotacion_casa = $juego_editar['anotacion_casa'];
        $this->hits_casa = $juego_editar['hits_casa'];
        $this->errores_casa = $juego_editar['errores_casa'];
        $this->anotador_id = $juego_editar['anotador_id'];
        $this->arbitro1_id = $juego_editar['arbitro1_id'];
        $this->arbitro2_id = $juego_editar['arbitro2_id'];
        $this->arbitro3_id = $juego_editar['arbitro3_id'];
        $this->arbitro4_id = $juego_editar['arbitro4_id'];
        $this->facturado_id = $juego_editar['facturado_id'];
        $this->bat_destacado = $juego_editar['bat_destacado_id'];
        $this->bat_destacado_texto = $juego_editar['texto_bateador'];
        $this->pit_destacado = $juego_editar['pit_destacado_id'];
        $this->pit_destacado_texto = $juego_editar['texto_pitcher'];
        $this->numero_juego_editar = $juego_editar['numero_juego'];
        $this->condicion_editar = $juego_editar['condicion'];

        $this->lista_jugadores = Jugadore::where('equipo_id', $this->visita_id)->orwhere('equipo_id', $this->casa_id)->orderBy('nombre','asc')->get();

        $this->open_edit = true;
    }

    public function update()
    {
        $this->validate([
            'fecha_juego' => 'required|max:10|date_format:d/m/Y',
            'hora_juego' => 'required|max:5',
            'estadio_id' => 'required|max:5',
            'grupo_id' => 'required|max:5',
            'visita_id' => 'required|max:5',
            'casa_id' => 'required|max:5',
            'anotacion_visita' => 'required|numeric|max:99',
            'hits_visita' => 'required|numeric|max:99',
            'errores_visita' => 'required|numeric|max:99',
            'anotacion_casa' => 'required|numeric|max:99',
            'hits_casa' => 'required|numeric|max:99',
            'errores_casa' => 'required|numeric|max:99',
            'anotador_id' => 'required|max:5',
            'arbitro1_id' => 'required|max:5',
            'arbitro2_id' => 'max:5',
            'arbitro3_id' => 'max:5',
            'arbitro4_id' => 'max:5',
            'facturado_id' => 'required|max:2',
            'bat_destacado' => 'max:5',
            'bat_destacado_texto' => 'max:21',
            'pit_destacado' => 'max:21',
            'pit_destacado_texto' => 'max:21',
            'numero_juego_editar' => 'numeric|max:999',
            'condicion_editar' => 'required',
        ]);

        $dia = substr($this->fecha_juego, 0, 2);
        $mes = substr($this->fecha_juego, 3, 2);
        $anio = substr($this->fecha_juego, 6, 4);

        $fecha_invertida = $anio.$mes.$dia;

        if($this->arbitro2_id <> '' and $this->arbitro3_id <> '' and $this->arbitro4_id <> '' )
        {
            $actualizar = Calendario::where('id', $this->id_juego)->update([
                'fecha_juego' => $this->fecha_juego,
                'hora_juego' => $this->hora_juego,
                'estadio_id' => $this->estadio_id,
                'grupo_id' => $this->grupo_id,
                'visita_id' => $this->visita_id,
                'casa_id' => $this->casa_id,
                'anotacion_visita' => $this->anotacion_visita,
                'anotacion_casa' => $this->anotacion_casa,
                'hits_visita' => $this->hits_visita,
                'hits_casa' => $this->hits_casa,
                'errores_visita' => $this->errores_visita,
                'errores_casa' => $this->errores_casa,
                'anotador_id' => $this->anotador_id,
                'arbitro1_id' => $this->arbitro1_id,
                'arbitro2_id' => $this->arbitro2_id,
                'arbitro3_id' => $this->arbitro3_id,
                'arbitro4_id' => $this->arbitro4_id,
                'facturado_id' => $this->facturado_id,
                'bat_destacado_id' => $this->bat_destacado,
                'texto_bateador' => $this->bat_destacado_texto,
                'pit_destacado_id' => $this->pit_destacado,
                'texto_pitcher' => $this->pit_destacado_texto,
                'numero_juego' => $this->numero_juego_editar,
                'condicion' => $this->condicion_editar,
                'fecha_invertida' => $fecha_invertida,
            ]);
        }
        else
        {
            if($this->arbitro2_id <> '' and $this->arbitro3_id == '' and $this->arbitro4_id == '' )
            {
                $actualizar = Calendario::where('id', $this->id_juego)->update([
                    'fecha_juego' => $this->fecha_juego,
                    'hora_juego' => $this->hora_juego,
                    'estadio_id' => $this->estadio_id,
                    'grupo_id' => $this->grupo_id,
                    'visita_id' => $this->visita_id,
                    'casa_id' => $this->casa_id,
                    'anotacion_visita' => $this->anotacion_visita,
                    'anotacion_casa' => $this->anotacion_casa,
                    'hits_visita' => $this->hits_visita,
                    'hits_casa' => $this->hits_casa,
                    'errores_visita' => $this->errores_visita,
                    'errores_casa' => $this->errores_casa,
                    'anotador_id' => $this->anotador_id,
                    'arbitro1_id' => $this->arbitro1_id,
                    'arbitro2_id' => $this->arbitro2_id,
                    'arbitro3_id' => null,
                    'arbitro4_id' => null,
                    'facturado_id' => $this->facturado_id,
                    'bat_destacado_id' => $this->bat_destacado,
                    'texto_bateador' => $this->bat_destacado_texto,
                    'pit_destacado_id' => $this->pit_destacado,
                    'texto_pitcher' => $this->pit_destacado_texto,
                    'numero_juego' => $this->numero_juego_editar,
                    'condicion' => $this->condicion_editar,
                    'fecha_invertida' => $fecha_invertida,
                ]);
            }
            else
            {
                if($this->arbitro2_id <> '' and $this->arbitro3_id <> '' and $this->arbitro4_id == '' )
                {
                    $actualizar = Calendario::where('id', $this->id_juego)->update([
                        'fecha_juego' => $this->fecha_juego,
                        'hora_juego' => $this->hora_juego,
                        'estadio_id' => $this->estadio_id,
                        'grupo_id' => $this->grupo_id,
                        'visita_id' => $this->visita_id,
                        'casa_id' => $this->casa_id,
                        'anotacion_visita' => $this->anotacion_visita,
                        'anotacion_casa' => $this->anotacion_casa,
                        'hits_visita' => $this->hits_visita,
                        'hits_casa' => $this->hits_casa,
                        'errores_visita' => $this->errores_visita,
                        'errores_casa' => $this->errores_casa,
                        'anotador_id' => $this->anotador_id,
                        'arbitro1_id' => $this->arbitro1_id,
                        'arbitro2_id' => $this->arbitro2_id,
                        'arbitro3_id' => $this->arbitro3_id,
                        'arbitro4_id' => null,
                        'facturado_id' => $this->facturado_id,
                        'bat_destacado_id' => $this->bat_destacado,
                        'texto_bateador' => $this->bat_destacado_texto,
                        'pit_destacado_id' => $this->pit_destacado,
                        'texto_pitcher' => $this->pit_destacado_texto,
                        'numero_juego' => $this->numero_juego_editar,
                        'condicion' => $this->condicion_editar,
                        'fecha_invertida' => $fecha_invertida,
                    ]);
                }
                else
                {
                    if($this->arbitro2_id == '' and $this->arbitro3_id == '' and $this->arbitro4_id == '' )
                    {
                        $actualizar = Calendario::where('id', $this->id_juego)->update([
                            'fecha_juego' => $this->fecha_juego,
                            'hora_juego' => $this->hora_juego,
                            'estadio_id' => $this->estadio_id,
                            'grupo_id' => $this->grupo_id,
                            'visita_id' => $this->visita_id,
                            'casa_id' => $this->casa_id,
                            'anotacion_visita' => $this->anotacion_visita,
                            'anotacion_casa' => $this->anotacion_casa,
                            'hits_visita' => $this->hits_visita,
                            'hits_casa' => $this->hits_casa,
                            'errores_visita' => $this->errores_visita,
                            'errores_casa' => $this->errores_casa,
                            'anotador_id' => $this->anotador_id,
                            'arbitro1_id' => $this->arbitro1_id,
                            'arbitro2_id' => null,
                            'arbitro3_id' => null,
                            'arbitro4_id' => null,
                            'facturado_id' => $this->facturado_id,
                            'bat_destacado_id' => $this->bat_destacado,
                            'texto_bateador' => $this->bat_destacado_texto,
                            'pit_destacado_id' => $this->pit_destacado,
                            'texto_pitcher' => $this->pit_destacado_texto,
                            'numero_juego' => $this->numero_juego_editar,
                            'condicion' => $this->condicion_editar,
                            'fecha_invertida' => $fecha_invertida,
                        ]);
                    }
                    else
                    {
                        dd("NO EDITO EL JUEGO, ERROR EN LOS ARBITROS");   
                    }                                
                }
            }
        }

        $this->reset(['open_edit','fecha_juego','hora_juego','estadio_id','grupo_id','visita_id','casa_id','anotacion_visita','hits_visita','errores_visita','anotacion_casa','hits_casa','errores_casa','anotador_id','arbitro1_id','arbitro2_id','arbitro3_id','arbitro4_id','facturado_id','bat_destacado','bat_destacado_texto','pit_destacado','pit_destacado_texto','facturado_id','numero_juego_editar','condicion_editar']);
    }

    public function save()
    {
        $this->validate([
            'numero_juego' => 'max:999|numeric',
            'fecha_crear' => 'required|max:10|date_format:d/m/Y',
            'hora_crear' => 'required|max:5',
            'estadio_id_crear' => 'required|max:5',
            'grupo_id_crear' => 'required|max:5',
            'visita_id_crear' => 'required|max:5',
            'casa_id_crear' => 'required|max:5',
            'visita_carreras_crear' => 'required|numeric|max:99',
            'visita_hits_crear' => 'required|numeric|max:99',
            'visita_errores_crear' => 'required|numeric|max:99',
            'casa_carreras_crear' => 'required|numeric|max:99',
            'casa_hits_crear' => 'required|numeric|max:99',
            'casa_errores_crear' => 'required|numeric|max:99',
            'anotador_id_crear' => 'required|max:5',
            'arbitro1_id_crear' => 'required|max:5',
            'arbitro2_id_crear' => 'max:5',
            'arbitro3_id_crear' => 'max:5',
            'arbitro4_id_crear' => 'max:5',
            'condicion_crear' => 'required',
        ]);

        $dia = substr($this->fecha_crear, 0, 2);
        $mes = substr($this->fecha_crear, 3, 2);
        $anio = substr($this->fecha_crear, 6, 4);

        $fecha_invertida = $anio.$mes.$dia;

        if($this->arbitro2_id_crear <> '' and $this->arbitro3_id_crear <> '' and $this->arbitro4_id_crear <> '' )
        {
            $juego = Calendario::create([
                'fecha_juego' => $this->fecha_crear,
                'hora_juego' => $this->hora_crear,
                'estadio_id' => $this->estadio_id_crear,
                'categoria_id' => $this->datos_torneo->categoria_id,
                'campeonato_id' => $this->datos_torneo->id,
                'grupo_id' => $this->grupo_id_crear,
                'visita_id' => $this->visita_id_crear,
                'casa_id' => $this->casa_id_crear,
                'anotacion_visita' => $this->visita_carreras_crear,
                'anotacion_casa' => $this->casa_carreras_crear,
                'hits_visita' => $this->visita_hits_crear,
                'hits_casa' => $this->casa_hits_crear,
                'errores_visita' => $this->visita_errores_crear,
                'errores_casa' => $this->casa_errores_crear,
                'anotador_id' => $this->anotador_id_crear,
                'arbitro1_id' => $this->arbitro1_id_crear,
                'arbitro2_id' => $this->arbitro2_id_crear,
                'arbitro3_id' => $this->arbitro3_id_crear,
                'arbitro4_id' => $this->arbitro4_id_crear,
                'facturado_id' => 2,
                'numero_juego' => $this->numero_juego,
                'condicion' => $this->condicion_crear,
                'fecha_invertida' => $fecha_invertida,
            ]);
        }
        else
        {
            if($this->arbitro2_id_crear <> '' and $this->arbitro3_id_crear == '' and $this->arbitro4_id_crear == '' )
            {
                $juego = Calendario::create([
                    'fecha_juego' => $this->fecha_crear,
                    'hora_juego' => $this->hora_crear,
                    'estadio_id' => $this->estadio_id_crear,
                    'categoria_id' => $this->datos_torneo->categoria_id,
                    'campeonato_id' => $this->datos_torneo->id,
                    'grupo_id' => $this->grupo_id_crear,
                    'visita_id' => $this->visita_id_crear,
                    'casa_id' => $this->casa_id_crear,
                    'anotacion_visita' => $this->visita_carreras_crear,
                    'anotacion_casa' => $this->casa_carreras_crear,
                    'hits_visita' => $this->visita_hits_crear,
                    'hits_casa' => $this->casa_hits_crear,
                    'errores_visita' => $this->visita_errores_crear,
                    'errores_casa' => $this->casa_errores_crear,
                    'anotador_id' => $this->anotador_id_crear,
                    'arbitro1_id' => $this->arbitro1_id_crear,
                    'arbitro2_id' => $this->arbitro2_id_crear,
                    'arbitro3_id' => null,
                    'arbitro4_id' => null,
                    'facturado_id' => 2,
                    'numero_juego' => $this->numero_juego,
                    'condicion' => $this->condicion_crear,
                    'fecha_invertida' => $fecha_invertida,
                ]);
            }
            else
            {
                if($this->arbitro2_id_crear <> '' and $this->arbitro3_id_crear <> '' and $this->arbitro4_id_crear == '' )
                {
                    $juego = Calendario::create([
                        'fecha_juego' => $this->fecha_crear,
                        'hora_juego' => $this->hora_crear,
                        'estadio_id' => $this->estadio_id_crear,
                        'categoria_id' => $this->datos_torneo->categoria_id,
                        'campeonato_id' => $this->datos_torneo->id,
                        'grupo_id' => $this->grupo_id_crear,
                        'visita_id' => $this->visita_id_crear,
                        'casa_id' => $this->casa_id_crear,
                        'anotacion_visita' => $this->visita_carreras_crear,
                        'anotacion_casa' => $this->casa_carreras_crear,
                        'hits_visita' => $this->visita_hits_crear,
                        'hits_casa' => $this->casa_hits_crear,
                        'errores_visita' => $this->visita_errores_crear,
                        'errores_casa' => $this->casa_errores_crear,
                        'anotador_id' => $this->anotador_id_crear,
                        'arbitro1_id' => $this->arbitro1_id_crear,
                        'arbitro2_id' => $this->arbitro2_id_crear,
                        'arbitro3_id' => $this->arbitro3_id_crear,
                        'arbitro4_id' => null,
                        'facturado_id' => 2,
                        'numero_juego' => $this->numero_juego,
                        'condicion' => $this->condicion_crear,
                        'fecha_invertida' => $fecha_invertida,
                    ]);
                }
                else
                {
                    if($this->arbitro2_id_crear == '' and $this->arbitro3_id_crear == '' and $this->arbitro4_id_crear == '' )
                    {
                        $juego = Calendario::create([
                            'fecha_juego' => $this->fecha_crear,
                            'hora_juego' => $this->hora_crear,
                            'estadio_id' => $this->estadio_id_crear,
                            'categoria_id' => $this->datos_torneo->categoria_id,
                            'campeonato_id' => $this->datos_torneo->id,
                            'grupo_id' => $this->grupo_id_crear,
                            'visita_id' => $this->visita_id_crear,
                            'casa_id' => $this->casa_id_crear,
                            'anotacion_visita' => $this->visita_carreras_crear,
                            'anotacion_casa' => $this->casa_carreras_crear,
                            'hits_visita' => $this->visita_hits_crear,
                            'hits_casa' => $this->casa_hits_crear,
                            'errores_visita' => $this->visita_errores_crear,
                            'errores_casa' => $this->casa_errores_crear,
                            'anotador_id' => $this->anotador_id_crear,
                            'arbitro1_id' => $this->arbitro1_id_crear,
                            'arbitro2_id' => null,
                            'arbitro3_id' => null,
                            'arbitro4_id' => null,
                            'facturado_id' => 2,
                            'numero_juego' => $this->numero_juego,
                            'condicion' => $this->condicion_crear,
                            'fecha_invertida' => $fecha_invertida,
                        ]);
                    }
                    else
                    {
                        dd("NO GRABO EL JUEGO, ERROR EN LOS ARBITROS");   
                    }
                }
            }
        }

        /*GRABANDO LOS ROSTER AL DETALLE DEL JUEGO*/

        $dia = substr($this->fecha_crear, 0, 2);
        $mes = substr($this->fecha_crear, 3, 2);
        $anio = substr($this->fecha_crear, 6, 4);

        $fecha_invertida = $anio.$mes.$dia;

        $jugadores_visita = Jugadore::where('equipo_id', $this->visita_id_crear)->get();
        foreach($jugadores_visita as $visita)
        {
            $numero = JugadoresNumero::create([
                'juego_id' => $juego->id,
                'fecha' => $this->fecha_crear,
                'jugador_id' => $visita->id,
                'oponente_id' => $this->casa_id_crear,
                'liga_id' => $this->datos_torneo->liga_id,
                'campeonato_id' => $this->datos_torneo->id,
                'categoria_id' => $this->datos_torneo->categoria_id,
                'fecha_invertida' => $fecha_invertida,
            ]) ;
        }

        $jugadores_casa = Jugadore::where('equipo_id', $this->casa_id_crear)->get();
        foreach($jugadores_casa as $casa)
        {
            $numero = JugadoresNumero::create([
                'juego_id' => $juego->id,
                'fecha' => $this->fecha_crear,
                'jugador_id' => $casa->id,
                'oponente_id' => $this->visita_id_crear,
                'liga_id' => $this->datos_torneo->liga_id,
                'campeonato_id' => $this->datos_torneo->id,
                'categoria_id' => $this->datos_torneo->categoria_id,
                'fecha_invertida' => $fecha_invertida,
            ]) ;
        }

        /*FIN DE GRABAR EL ROSTER*/

        /*ACTUALIZANDO LA TABLA DE POSICIONES*/

        if($this->visita_carreras_crear > $this->casa_carreras_crear)
        {
            $ganador = $this->visita_id_crear;
        }
        else
        {
            if($this->casa_carreras_crear > $this->visita_carreras_crear)
            {
                $ganador = $this->casa_id_crear;
            }
            else
            {
                $ganador = "empate";
            }
        }

        if($ganador == $this->visita_id_crear)
        {
            $buscar1 = Posicione::where('campeonato_id', $this->datos_torneo->id)->where('equipo_id', $this->casa_id_crear)->count();
            if($buscar1 < 1)
            {
                $posi = Posicione::create([
                    'categoria_id' => $this->datos_torneo->categoria_id,
                    'campeonato_id' => $this->datos_torneo->id,
                    'equipo_id' => $this->casa_id_crear,
                    'grupo_id' => $this->grupo_id_crear,
                    'jugados' => 1,
                    'ganados' => 0,
                    'perdidos' => 1,
                    'empatados' => 0,
                ]);
            }
            else
            {
                $actualizacion = Posicione::where('campeonato_id', $this->datos_torneo->id)->where('equipo_id', $this->casa_id_crear)
                ->update([
                    'jugados' => Posicione::raw('jugados + '. 1),
                    'perdidos' => Posicione::raw('perdidos + '. 1),
                ]);
            }

            $buscar2 = Posicione::where('campeonato_id', $this->datos_torneo->id)->where('equipo_id', $this->visita_id_crear)->count();
            if($buscar2 < 1)
            {
                $posi = Posicione::create([
                    'categoria_id' => $this->datos_torneo->categoria_id,
                    'campeonato_id' => $this->datos_torneo->id,
                    'equipo_id' => $this->visita_id_crear,
                    'grupo_id' => $this->grupo_id_crear,
                    'jugados' => 1,
                    'ganados' => 1,
                    'perdidos' => 0,
                    'empatados' => 0,
                ]);
            }
            else
            {
                $actualizacion = Posicione::where('campeonato_id', $this->datos_torneo->id)->where('equipo_id', $this->visita_id_crear)
                ->update([
                    'jugados' => Posicione::raw('jugados + '. 1),
                    'ganados' => Posicione::raw('ganados + '. 1),
                ]);
            }
        }    
        else
        {
            if($ganador == $this->casa_id_crear)
            {
                $buscar1 = Posicione::where('campeonato_id', $this->datos_torneo->id)->where('equipo_id', $this->visita_id_crear)->count();
                if($buscar1 < 1)
                {
                    $posi = Posicione::create([
                        'categoria_id' => $this->datos_torneo->categoria_id,
                        'campeonato_id' => $this->datos_torneo->id,
                        'equipo_id' => $this->visita_id_crear,
                        'grupo_id' => $this->grupo_id_crear,
                        'jugados' => 1,
                        'ganados' => 0,
                        'perdidos' => 1,
                        'empatados' => 0,
                    ]);
                }
                else
                {
                    $actualizacion = Posicione::where('campeonato_id', $this->datos_torneo->id)->where('equipo_id', $this->visita_id_crear)
                    ->update([
                        'jugados' => Posicione::raw('jugados + '. 1),
                        'perdidos' => Posicione::raw('perdidos + '. 1),
                    ]);
                }
    
                $buscar2 = Posicione::where('campeonato_id', $this->datos_torneo->id)->where('equipo_id', $this->casa_id_crear)->count();
                if($buscar2 < 1)
                {
                    $posi = Posicione::create([
                        'categoria_id' => $this->datos_torneo->categoria_id,
                        'campeonato_id' => $this->datos_torneo->id,
                        'equipo_id' => $this->casa_id_crear,
                        'grupo_id' => $this->grupo_id_crear,
                        'jugados' => 1,
                        'ganados' => 1,
                        'perdidos' => 0,
                        'empatados' => 0,
                    ]);
                }
                else
                {
                    $actualizacion = Posicione::where('campeonato_id', $this->datos_torneo->id)->where('equipo_id', $this->casa_id_crear)
                    ->update([
                        'jugados' => Posicione::raw('jugados + '. 1),
                        'ganados' => Posicione::raw('ganados + '. 1),
                    ]);
                }
            }
            else
            {
                if($ganador == "empate")
                {
                    $buscar1 = Posicione::where('campeonato_id', $this->datos_torneo->id)->where('equipo_id', $this->visita_id_crear)->count();
                    if($buscar1 < 1)
                    {
                        $posi = Posicione::create([
                            'categoria_id' => $this->datos_torneo->categoria_id,
                            'campeonato_id' => $this->datos_torneo->id,
                            'equipo_id' => $this->visita_id_crear,
                            'grupo_id' => $this->grupo_id_crear,
                            'jugados' => 1,
                            'ganados' => 0,
                            'perdidos' => 0,
                            'empatados' => 1,
                        ]);
                    }
                    else
                    {
                        $actualizacion = Posicione::where('campeonato_id', $this->datos_torneo->id)->where('equipo_id', $this->visita_id_crear)
                        ->update([
                            'jugados' => Posicione::raw('jugados + '. 1),
                            'empatados' => Posicione::raw('empatados + '. 1),
                        ]);
                    }
        
                    $buscar2 = Posicione::where('campeonato_id', $this->datos_torneo->id)->where('equipo_id', $this->casa_id_crear)->count();
                    if($buscar2 < 1)
                    {
                        $posi = Posicione::create([
                            'categoria_id' => $this->datos_torneo->categoria_id,
                            'campeonato_id' => $this->datos_torneo->id,
                            'equipo_id' => $this->casa_id_crear,
                            'grupo_id' => $this->grupo_id_crear,
                            'jugados' => 1,
                            'ganados' => 0,
                            'perdidos' => 0,
                            'empatados' => 1,
                        ]);
                    }
                    else
                    {
                        $actualizacion = Posicione::where('campeonato_id', $this->datos_torneo->id)->where('equipo_id', $this->casa_id_crear)
                        ->update([
                            'jugados' => Posicione::raw('jugados + '. 1),
                            'empatados' => Posicione::raw('empatados + '. 1),
                        ]);
                    }
                }
            }
        }

        /*ACTUALIZANDO LOS PORCENTAJES DE GANADOS EN CASO QUE LA TABLA SE RIJA POR PORCENTAJE DE VICTORIAS*/
/*
        $porcentajes = Posicione::where('campeonato_id', $this->id_torneo)->get();
        foreach($porcentajes as $porc)
        {
            $id_porcenta = $porc->id;

            if($porc->jugados > 0)
            {
                $resultado = (($porc->ganados + ($porc->empatados / 2)) / $porc->jugados) * 1000;

                $actualiza = Posicione::where('id', $id_porcenta)
                ->update([
                    'porcentaje' => $resultado,
                ]);
            }
        }
*/
        /*FIN DE ACTUALIZAR LOS PORCENTAJES*/

        /*ACTUALIZANDO LOS PUNTOS EN CASO QUE LA TABLA SE RIJA POR PUNTOS OBTENIDOS*/

        $porcentajes = Posicione::where('campeonato_id', $this->id_torneo)->get();
        foreach($porcentajes as $porc)
        {
            $id_porcenta = $porc->id;

            if($porc->jugados > 0)
            {
                $resultado = (($porc->ganados * 3) + ($porc->empatados * 1));

                $actualiza = Posicione::where('id', $id_porcenta)
                ->update([
                    'porcentaje' => $resultado,
                ]);
            }
        }

        /*FIN DE ACTUALIZAR LOS PORCENTAJES*/

        /*FIN DE ACTUALIZAR LA TABLA DE POSICIONES*/

        $this->reset(['open_crear','fecha_crear','hora_crear','estadio_id_crear','grupo_id_crear','visita_id_crear','casa_id_crear','visita_carreras_crear','visita_hits_crear','visita_errores_crear','casa_carreras_crear','casa_hits_crear','casa_errores_crear','anotador_id_crear','arbitro1_id_crear','arbitro2_id_crear','arbitro3_id_crear','arbitro4_id_crear','numero_juego','condicion_crear']);

        $this->dispatch('render');
    }

    public function delete($juegoId)
    {
        $eliminar = Calendario::where('id', $juegoId)
        ->delete();
    }
}
