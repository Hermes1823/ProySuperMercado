<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informe extends Model
{
    use HasFactory;
    protected $table = 'informe';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['idalmacen', 'fecha', 'detalle', 'estado'];
}
