<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    use HasFactory;

    protected $fillable=[
        'nombre',
        'subtarea_id',
        'archivo',
        'texto',
        'user_id',
    ];

    
}
