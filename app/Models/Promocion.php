<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    use HasFactory;

    protected $table = 'promociones';

    protected $primaryKey = 'id_promocion';

    protected $fillable = [
        'producto_id',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'precio_promocional',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
