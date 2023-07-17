<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    use HasFactory;

    protected $table = 'respuestas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_encuesta',
        'id_pregunta',
        'id_cliente',
        'respuesta',
    ];

    public function encuesta()
    {
        return $this->belongsTo(Encuesta::class, 'id_encuesta');
    }

    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class, 'id_pregunta');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }
}
