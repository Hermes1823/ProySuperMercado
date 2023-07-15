<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cliente;

class Cupon extends Model
{
    use HasFactory;
    protected $table='cupones';
    protected $primaryKey = 'id_cupon';
    public $timestamps = false;
    protected $fillable=[
        'descuento',
        'fecha_expiracion',
        'codigo_cupon',
        'id_cliente'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }
}
