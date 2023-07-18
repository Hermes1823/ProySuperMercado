<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    protected $primaryKey = 'id_pregunta';
    protected $fillable = ['pregunta'];

    public function encuestas()
    {
        return $this->belongsToMany(Encuesta::class, 'preguntaencuestas', 'id_pregunta', 'id_encuesta')
        ->withPivot('respuesta');
    }
}
