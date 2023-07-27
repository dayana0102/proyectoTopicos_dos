<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoTarea extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'panel_id',
        'user_id'
    ];

    public function editortarea(){
        return $this->hasMany(EditorTarea::class, 'grupotarea_id', 'id');
    }

    public function subtarea(){
        return $this->hasMany(SubTarea::class, 'grupotarea_id', 'id');
    }
}
