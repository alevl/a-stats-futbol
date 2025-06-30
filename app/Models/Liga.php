<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liga extends Model
{
    /** @use HasFactory<\Database\Factories\LigaFactory> */
    use HasFactory;

    protected $fillable = [
        'liga',
        'ubicacion',
        'deporte_id',
    ];

    public function liga_deporte()
    {
        return $this->belongsTo(Deporte::class, 'deporte_id');
    }

}
