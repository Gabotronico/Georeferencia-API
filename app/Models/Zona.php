<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    use HasFactory;

    protected $table = 'zonas';

    protected $fillable = [
        'nombre_zona'
    ];

    // 🔁 Relación

    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'id_zona');
    }
}
