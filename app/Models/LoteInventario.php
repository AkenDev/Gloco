<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoteInventario extends Model
{
    use HasFactory;
    public function inventarios()
    {
        return $this->hasMany(Inventario::class, 'idLote');
    }
}
