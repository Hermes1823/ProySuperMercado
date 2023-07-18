<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulante extends Model
{
    use HasFactory;

    protected $table = 'postulantes';
    protected $primaryKey = 'id_postulante';
    protected $fillable = [
        'apellidos',
        'nombre',
        'telefono',
        'email',
    ];

    //public function encuesta()
    //{
    //    return $this->belongsTo(Encuesta::class, 'id_encuesta');
    //}
}
