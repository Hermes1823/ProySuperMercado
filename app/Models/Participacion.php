<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participacion extends Model
{
    use HasFactory;

    protected $table = 'participaciones';
    protected $primaryKey = 'id_participacion';
    protected $fillable = [
        'id_postulante',
        'id_convocatoria',
        'id_examen',
    ];

    public function postulante()
    {
        return $this->belongsTo(Postulante::class, 'id_postulante');
    }

    public function convocatoria()
    {
        return $this->belongsTo(Convocatoria::class, 'id_convocatoria');
    }

    public function examen()
    {
        return $this->belongsTo(examen::class, 'id_examen');
    }
}
