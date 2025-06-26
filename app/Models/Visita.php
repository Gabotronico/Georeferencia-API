<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    use HasFactory;

    protected $table = 'visitas';

    protected $fillable = [
        'id_vendedor',
        'id_clientes',
        'fecha_visita',
        'comentarios',
        'estado' 
    ];

    // 🔁 Relaciones

    public function vendedor()
    {
        return $this->belongsTo(Vendedor::class, 'id_vendedor');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_clientes');
    }
}

