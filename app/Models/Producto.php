<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'idMarca',
        'idCategoria',
        'descripcion',
        'stock',
        'photo',
    ];

    public function promociones()
    {
        return $this->hasMany(Promocion::class, 'producto_id');
    }
}
