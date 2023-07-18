<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encuesta extends Model
{
    protected $primaryKey = 'id_encuesta';
    protected $fillable = ['nombre_encuesta', 'id_pregunta', 'id_cliente'];

    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class, 'id_pregunta');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function preguntas()
    {
        return $this->belongsToMany(Pregunta::class, 'preguntaencuestas', 'id_encuesta', 'id_pregunta');
    }
}
