<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encuesta extends Model
{
    protected $table = 'encuestas';
    protected $primaryKey = 'id_encuesta';
    public $timestamps = false;

    protected $fillable = [
        'nombre_encuesta',
        'id_pregunta',
        'id_cliente',
        // otros campos que desees permitir asignación masiva
    ];

    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class, 'id_pregunta');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }
}
