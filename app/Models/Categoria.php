<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    /** @use HasFactory<\Database\Factories\CategoriaFactory> */
    use HasFactory;

    protected $fillable = [
        'categoria',
        'liga_id',
        'deporte_id',
    ];

    public function categoria_liga()
    {
        return $this->belongsTo(Liga::class, 'liga_id');
    }
    public function categoria_deporte()
    {
        return $this->belongsTo(Deporte::class, 'deporte_id');
    }

}
