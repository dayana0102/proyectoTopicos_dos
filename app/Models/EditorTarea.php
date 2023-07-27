<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EditorTarea extends Model
{
    use HasFactory;
    protected $fillable = [
        'grupotarea_id',
        'user_id',
        'estado', //curso //personal
    ];

    public function grupotarea(){
        // MUCHOS A UNO
        return $this->belongsTo(GrupoTarea::class, 'grupotarea_id', 'id'); // foreing- primary 
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id'); // foreing- primary 
    }
}
