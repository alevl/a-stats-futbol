<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Condicione::create(['condicion'=>'Si']);
        \App\Models\Condicione::create(['condicion'=>'No']);

        \App\Models\Deporte::create(['deporte'=>'Beisbol']);
        \App\Models\Deporte::create(['deporte'=>'Softball']);

        \App\Models\Nivele::create(['nivel'=>'Administrador']);
        \App\Models\Nivele::create(['nivel'=>'Recopilador']);

        \App\Models\EstatusTorneo::create(['estatus'=>'Activo']);
        \App\Models\EstatusTorneo::create(['estatus'=>'Inactivo']);

        \App\Models\Liga::create(['liga'=>'Zamora', 'ubicacion'=>'Guatire', 'deporte_id'=>1 ]);

        \App\Models\Categoria::create(['categoria'=>'Juvenil A', 'liga_id'=>1, 'deporte_id'=>1 ]);

        \App\Models\Campeonato::create(['nombre'=>'Juv-A', 'liga_id'=>1, 'categoria_id'=>1, 'fecha_inicio'=>'15/11/2024','estatus_id'=>1 ]);

        \App\Models\Grupo::create(['grupo'=>'Final']);
        \App\Models\Grupo::create(['grupo'=>'Semifinal']);
        \App\Models\Grupo::create(['grupo'=>'Semifinal A']);
        \App\Models\Grupo::create(['grupo'=>'Semifinal B']);
        \App\Models\Grupo::create(['grupo'=>'Play Off']);
        \App\Models\Grupo::create(['grupo'=>'Play Off A']);
        \App\Models\Grupo::create(['grupo'=>'Play Off B']);
        \App\Models\Grupo::create(['grupo'=>'Play Off C']);
        \App\Models\Grupo::create(['grupo'=>'Play Off D']);
        \App\Models\Grupo::create(['grupo'=>'Unico']);
        \App\Models\Grupo::create(['grupo'=>'A']);
        \App\Models\Grupo::create(['grupo'=>'B']);
        \App\Models\Grupo::create(['grupo'=>'C']);
        \App\Models\Grupo::create(['grupo'=>'D']);
        \App\Models\Grupo::create(['grupo'=>'E']);
        \App\Models\Grupo::create(['grupo'=>'F']);
        \App\Models\Grupo::create(['grupo'=>'G']);
        \App\Models\Grupo::create(['grupo'=>'H']);

        \App\Models\User::create(['name'=>'Alejandro Velasquez',
        'username'=>'alejandro',
        'password'=>'$2y$10$P7g2rGQ9aXM6qgJAgOmecuV5LwBNUC4d2bqtRU5RRbPIpi61mdTEW',
        'nivel_id'=>'1',
        'estatus_id'=>'1'
        ]);

        \App\Models\Anotadore::create(['nombre'=>'Alexis Gómez',
        'telefono'=>'',
        ]);
        \App\Models\Anotadore::create(['nombre'=>'Diana Perez',
        'telefono'=>'',
        ]);
        \App\Models\Anotadore::create(['nombre'=>'Yennifer Cruz',
        'telefono'=>'',
        ]);
        \App\Models\Anotadore::create(['nombre'=>'No Indicado',
        'telefono'=>'',
        ]);

        \App\Models\Arbitro::create(['nombre'=>'Antonio Toro',
        'telefono'=>'',
        ]);
        \App\Models\Arbitro::create(['nombre'=>'Jacinto Reverón',
        'telefono'=>'',
        ]);
        \App\Models\Arbitro::create(['nombre'=>'Luismer Pantoja',
        'telefono'=>'',
        ]);
        \App\Models\Arbitro::create(['nombre'=>'Jardiel Delgado',
        'telefono'=>'',
        ]);
        \App\Models\Arbitro::create(['nombre'=>'Carlos Castro',
        'telefono'=>'',
        ]);
        \App\Models\Arbitro::create(['nombre'=>'Jacinto Alfonzo',
        'telefono'=>'',
        ]);
        \App\Models\Arbitro::create(['nombre'=>'Jesus Malpica',
        'telefono'=>'',
        ]);
        \App\Models\Arbitro::create(['nombre'=>'No Indicado',
        'telefono'=>'',
        ]);

        \App\Models\Estadio::create(['nombre'=>'Miguel Lorenzo Garcia']);
        \App\Models\Estadio::create(['nombre'=>'Araira']);
        \App\Models\Estadio::create(['nombre'=>'Valle Verde']);
        \App\Models\Estadio::create(['nombre'=>'Elegua']);
        \App\Models\Estadio::create(['nombre'=>'No Indicado']);

        \App\Models\Equipo::factory(10)->create();
        \App\Models\Jugadore::factory(100)->create();
        \App\Models\Calendario::factory(200)->create();
        \App\Models\JugadoresNumero::factory(3000)->create();
        \App\Models\JugadoresDefensiva::factory(3000)->create();
        \App\Models\Posicione::factory(200)->create();
    }
}
