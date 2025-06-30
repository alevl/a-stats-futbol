<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arbitro extends Model
{
    /** @use HasFactory<\Database\Factories\ArbitroFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre',
    ];

}
