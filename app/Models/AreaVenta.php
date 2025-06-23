<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaVenta extends Model
{
    use HasFactory;

    protected $table = 'area_ventas';

    protected $fillable = [
        'nombre_area'
    ];

    // 🔁 Relación

    public function vendedores()
    {
        return $this->hasMany(Vendedor::class, 'id_area_ventas');
    }
}

