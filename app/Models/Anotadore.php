<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anotadore extends Model
{
    /** @use HasFactory<\Database\Factories\AnotadoreFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre',
    ];
}
