<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    use HasFactory;
    protected $table = 'colaboradores';
    protected $primaryKey = 'idColaborador';
    protected $fillable = [
        'idColaborador',
        'prenombres',
        'apellidos',
        'direccion',
        'ciudad',
        'pais',
        'codigoPostal',
        'fechaNacimiento',
        'descripcion',
    ];
}
