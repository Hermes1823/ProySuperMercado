<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalleencuesta extends Model
{
    protected $primaryKey = ['id_cliente', 'id_pregunta'];

    protected $fillable = ['id_cliente', 'id_pregunta', 'respuesta'];
    public $timestamps = false;
    public $incrementing = false; // Indicamos que no use autoincremento

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class, 'id_pregunta', 'id_pregunta');
    }
}
