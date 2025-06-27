<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    use HasFactory;

    protected $table = 'vendedors'; // Nota: Laravel pluraliza mal "vendedor"

    protected $fillable = [
        'nombre_vendedor',
        'apellido_paterno',
        'apellido_materno',
        'fecha_nacimiento',
        'ci',
        'id_area_ventas',
        'id_empresa',
        'correo'
    ];

    // 🔁 Relaciones

    public function areaVentas()
    {
        return $this->belongsTo(AreaVenta::class, 'id_area_ventas');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'id_empresa');
    }

    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'id_vendedor');
    }

    public function visitas()
    {
        return $this->hasMany(Visita::class, 'id_vendedor');
    }
}
