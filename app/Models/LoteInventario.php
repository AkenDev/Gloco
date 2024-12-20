<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoteInventario extends Model
{
    use HasFactory;

    protected $primaryKey = 'idLote'; // Custom primary key

    protected $fillable = [
        'codLote',
        'fechaVencimiento',
    ];
    
    public function inventarios()
    {
        return $this->belongsToMany(Inventario::class, 'inventario_lotes', 'idLote', 'idInventario')
                    ->withPivot('stockPorLote') // Include stock in the pivot table
                    ->withTimestamps(); // Track when the relationship was created/updated
    }
}
