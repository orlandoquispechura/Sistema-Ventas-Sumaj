<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;
    protected $fillable = ['codigo', 'nombre', 'precio_venta', 'modelo', 'stock', 'estado', 'marca_id', 'tipo_id', 'proveedor_id',];

    //  relación  uno a  mucho inversa
    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }
    public function tipo()
    {
        return $this->belongsTo(TipoEquipo::class);
    }
    //  relación  uno a  mucho inversa
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }
}
