<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Montacarga extends Model
{
    use HasFactory;
    protected $table = 'montacarga';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['idAlmacen','marca','altura','capacidad','tipomontacarga','fotomontacarga','estado']; // Cambio en esta línea

    // Definición de la relación con Almacen
    public function almacen()
    {
        return $this->belongsTo(Almacen::class, 'idAlmacen', 'id'); // Cambio en esta línea
    }
}
