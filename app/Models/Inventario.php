<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;

    protected $primaryKey = 'idInventario'; // Define the custom primary key

    protected $fillable = [
        'codInventario',
        'codProveedor',
        'descrInventario',
        'unidadInventario',
        'precioDolarInventario',
        'precioCordInventario',
    ];

    public function lotes()
    {
        return $this->belongsToMany(LoteInventario::class, 'inventario_lotes', 'idInventario', 'idLote')
                    ->withPivot('stockPorLote') // Include stock in the pivot table
                    ->withTimestamps(); // Track when the relationship was created/updated
    }

    public function detalles()
    {
        return $this->hasMany(DetalleFactura::class, 'codInventario');
    }
}
