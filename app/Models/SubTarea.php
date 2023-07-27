<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTarea extends Model
{
    use HasFactory;
    protected $fillable = [
        'grupotarea_id',
        'nombre',
        'tipo',
        'fecha_limite',
        'estado',
        'descripcion',
    ];

    public function entrega(){
        return $this->hasMany(Entrega::class, 'subtarea_id', 'id');
    }

    public function recurso(){
        return $this->hasMany(Recurso::class,'subtarea_id','id');
    }
}
