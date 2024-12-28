<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
    use HasFactory;

    protected $fillable = ['idFactura', 
    'cantidad', 
    'precioUnitario', 
    'ivaUnitario', 
    'codInventario',
    ];
    
    public function factura()
    {
        return $this->belongsTo(Factura::class, 'idFactura', 'idFactura');
    }
    
    public function inventario()
    {
        return $this->belongsTo(Inventario::class, 'codInventario', 'codInventario');
    }
}
