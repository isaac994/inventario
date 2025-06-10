<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
        use HasFactory;

    public $timestamps = false;

    protected $table = 'ventas';

    protected $fillable = [
        'cliente_nombre',
        'usuario_id',
        'total',
        'fecha_registro'
    ];
}
