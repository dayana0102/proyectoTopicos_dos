<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha_entrega',
        'nota',
        'comentarios',
        'archivo',
        'respuesta_foro',
        'subtarea_id',
        'user_id'
    ];

    public function subtarea(){
        return $this->belongsTo(SubTarea::class, 'subtarea_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
