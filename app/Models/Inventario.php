<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;

    public function lote()
    {
        return $this->belongsTo(LoteInventario::class, 'idLote');
    }

    public function detalles()
    {
        return $this->hasMany(DetalleFactura::class, 'codInventario');
    }
}
