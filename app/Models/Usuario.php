<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Usuario
 * 
 * Este modelo representa un usuario del sistema.
 * Un usuario puede tener varias ventas asociadas.
 */
class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';
    
    protected $fillable = [
        'nombre',
        'usuario',
        'email',
        'contraseña',
    ];

    protected $hidden = [
        'contraseña',
    ];

    /**
     * Obtiene las ventas asociadas a este usuario.
     */
    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }
} 