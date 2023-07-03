<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacenero extends Model
{
    use HasFactory;
    protected $table = 'almacenero';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['idusuario', 'idalmacen', 'idmontacarga', 'celular', 'sueldo', 'fecha', 'detalle', 'estado'];


}
