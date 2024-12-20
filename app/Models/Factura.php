<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $primaryKey = 'idFactura'; //Custom primary 

    protected $fillable = [
        'idCliente',
        'fecha',
        'esDolar',
        'totalSubtotal',
        'ivaAplicado',
        'fechaVence',
        'tipoFactura',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'idCliente');
    }

    public function detalles()
    {
        return $this->hasMany(DetalleFactura::class, 'idFactura');
    }
}
