<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    /** @use HasFactory<\Database\Factories\NoticiaFactory> */
    use HasFactory;

        protected $fillable = [
        'titulo',
        'desarrollo',
        'estatus_id',
        'imagen',
    ];

    public function noticia_estatus()
    {
        return $this->belongsTo(EstatusTorneo::class, 'estatus_id');
    }

}
