<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCliente extends Model
{
    use HasFactory;

    protected $table = 'tipo_clientes';

    protected $fillable = [
        'nombre_tipo_cliente'
    ];

    // 🔁 Relación

    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'id_tipo_cliente');
    }
}

