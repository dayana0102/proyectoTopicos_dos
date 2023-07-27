<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Integrante extends Model
{
    use HasFactory;
    protected $fillable = [
        'panel_id',
        'user_id',
        'rol',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
