<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $table = 'empresas';

    protected $fillable = [
        'nombre_empresa',
        'nit'
    ];

    // 🔁 Relación

    public function vendedores()
    {
        return $this->hasMany(Vendedor::class, 'id_empresa');
    }
}
