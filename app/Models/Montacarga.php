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
    protected $fillable = ['marca','altura','capacidad','tipomontacarga','fotomontacarga','estado'];
}
