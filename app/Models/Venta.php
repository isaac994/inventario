<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
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

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class);
    }
}
