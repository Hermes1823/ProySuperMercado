<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequisitionOrderDetail extends Model
{
    use HasFactory;
    protected $table = 'ordenes_requisicion_detalle';
    protected $primaryKey = 'idOrdenRequisicion';
    protected $fillable = [
        'idOrdenRequisicion',
        'idProducto',
        'cantidad',
    ];
}
