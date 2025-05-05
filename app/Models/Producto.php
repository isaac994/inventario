<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'identificador', 'categoria_id', 'precio', 'stock', 'estado'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
