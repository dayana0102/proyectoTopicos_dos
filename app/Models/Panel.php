<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panel extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'codigo',
        'tipo', //curso //personal
        'user_id', //dueño
        'estado',
        'periodo',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function integrante(){
        return $this->hasMany(Integrante::class, 'panel_id', 'id');
    }

    public function grupotarea(){
        return $this->hasMany(GrupoTarea::class, 'panel_id', 'id');
    }
}
