<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $primaryKey = 'idCliente'; // Custom primary key

    protected $fillable = [
        'codigoCliente',
        'depaCliente',
        'nombreCliente',
        'contactoCliente',
        'telCliente',
        'rucCliente',
        'dirCliente',
    ];

    public function facturas()
    {
        return $this->hasMany(Factura::class, 'idCliente');
    }
}
