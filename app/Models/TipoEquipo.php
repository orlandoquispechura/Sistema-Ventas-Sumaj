<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEquipo extends Model
{
    use HasFactory;
    protected $fillable = ['nombre_equipo', 'descripcion',];

    // relación uno a muchos 
    public function articulos()
    {
        return $this->hasMany(Articulo::class);
    }
}
