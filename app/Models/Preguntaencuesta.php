<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preguntataencuesta extends Model
{
    protected $table = 'preguntaencuestas';
    protected $primaryKey = ['id_pregunta', 'id_encuesta'];
    public $incrementing = false;

    protected $fillable = ['id_pregunta', 'id_encuesta'];

    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class, 'id_pregunta');
    }

    public function encuesta()
    {
        return $this->belongsTo(Encuesta::class, 'id_encuesta');
    }
}
