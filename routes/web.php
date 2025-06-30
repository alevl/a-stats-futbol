<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SalirController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BackupController;

use App\Livewire\Home\Home;
use App\Livewire\Home\JugadoresNumeritos;
use App\Livewire\Home\Jugadores;
use App\Livewire\Home\LideresEquipos;
use App\Livewire\Home\Lideres;
use App\Livewire\Home\Posiciones;
use App\Livewire\Home\Resultados;
use App\Livewire\Home\ResultadosNumeritos;
use App\Livewire\Home\Roster;
use App\Livewire\Home\LideresRoster;
use App\Livewire\Home\BoxScore;
use App\Livewire\Home\Champions;

use App\Livewire\Admin\CategoriasAdmin;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\EquiposAdmin;
use App\Livewire\Admin\JugadoresAdmin;
use App\Livewire\Admin\LigasAdmin;
use App\Livewire\Admin\TorneosAdmin;
use App\Livewire\Admin\RosterActivo;
use App\Livewire\Admin\ResultadosAdmin;
use App\Livewire\Admin\CargarNumeritos;
use App\Livewire\Admin\PosicionesAdmin;
use App\Livewire\Admin\NoticiasAdmin;
use App\Livewire\Admin\Perfil;
use App\Livewire\Admin\Estadios;
use App\Livewire\Admin\Anotadores;
use App\Livewire\Admin\Arbitros;
use App\Livewire\Admin\JuegosAnotadores;
use App\Livewire\Admin\JugadorNumeritosAdmin;

/*APARTADO LOGIN*/
Route::get('/turuta', function(){
    Artisan::call('storage:link');
});
Route::get('acceso', function () {
    return view('auth.login');
});
Route::post('acceso', [LoginController::class, 'acceso'])->name('acceso.acceso');
Route::post('salir',[SalirController::class, 'cierre'])->name('salir.cierre');
Route::get('salir',[SalirController::class, 'cierre'])->name('salir.cierre');


/*APARTADO ADMIN*/
Route::middleware(['auth:sanctum', 'verified'])->get('dashboard', Dashboard::class)->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->get('categorias-admin', CategoriasAdmin::class)->name('categorias-admin');
Route::middleware(['auth:sanctum', 'verified'])->get('equipos-admin', EquiposAdmin::class)->name('equipos-admin');
Route::middleware(['auth:sanctum', 'verified'])->get('jugadores-admin', JugadoresAdmin::class)->name('jugadores-admin');
Route::middleware(['auth:sanctum', 'verified'])->get('ligas-admin', LigasAdmin::class)->name('ligas-admin');
Route::middleware(['auth:sanctum', 'verified'])->get('torneos-admin', TorneosAdmin::class)->name('torneos-admin');
Route::middleware(['auth:sanctum', 'verified'])->get('roster-activo/{id_equipo}', RosterActivo::class)->name('roster-activo');
Route::middleware(['auth:sanctum', 'verified'])->get('resultados-admin/{id_torneo}', ResultadosAdmin::class)->name('resultados-admin');
Route::middleware(['auth:sanctum', 'verified'])->get('cargar-numeritos/{id_juego}', CargarNumeritos::class)->name('cargar-numeritos');
Route::middleware(['auth:sanctum', 'verified'])->get('posiciones-admin/{id_torneo}', PosicionesAdmin::class)->name('posiciones-admin');
Route::middleware(['auth:sanctum', 'verified'])->get('noticias', NoticiasAdmin::class)->name('noticias-admin');
Route::middleware(['auth:sanctum', 'verified'])->get('perfil', Perfil::class)->name('perfil');
Route::middleware(['auth:sanctum', 'verified'])->get('estadios', Estadios::class)->name('estadios');
Route::middleware(['auth:sanctum', 'verified'])->get('anotadores', Anotadores::class)->name('anotadores');
Route::middleware(['auth:sanctum', 'verified'])->get('arbitros', Arbitros::class)->name('arbitros');
Route::middleware(['auth:sanctum', 'verified'])->get('juegos-anotador', JuegosAnotadores::class)->name('juegos-anotador');
Route::get('/respaldar', [BackupController::class, 'descargar'])->name('respaldar');
Route::get('jugador-numeritos-admin/{id_jugador}', JugadorNumeritosAdmin::class)->name('jugador-numeritos-admin');

/*APARTADO HOME*/
Route::get('/', Home::class)->name('home');
Route::get('jugador-numeritos/{id_jugador}', JugadoresNumeritos::class)->name('jugador-numeritos');
Route::get('jugadores', Jugadores::class)->name('jugadores');
Route::get('lideres-equipos', LideresEquipos::class)->name('lideres-equipos');
Route::get('lideres', Lideres::class)->name('lideres');
Route::get('posiciones/{id_torneo}', Posiciones::class)->name('posiciones');
Route::get('resultados', Resultados::class)->name('resultados');
Route::get('resultados-numeritos/{id_resultado}', ResultadosNumeritos::class)->name('resultados-numeritos');
Route::get('roster', Roster::class)->name('roster');
Route::get('lideres-roster/{id_equipo}/{id_categoria}/{id_torneo}', LideresRoster::class)->name('lideres-roster');
Route::get('resumen/{id_juego}', BoxScore::class)->name('box-score');
Route::get('champions', Champions::class)->name('champions');
