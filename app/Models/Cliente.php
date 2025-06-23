<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $fillable = [
        'nombre_cliente',       
        'id_vendedor',
        'id_zona',
        'id_departamento',
        'id_tipo_cliente',
        'barrio',
        'latitud',
        'longitud'
    ];

    // 🔁 Relaciones

    public function vendedor()
    {
        return $this->belongsTo(Vendedor::class, 'id_vendedor');
    }

    public function zona()
    {
        return $this->belongsTo(Zona::class, 'id_zona');
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'id_departamento');
    }

    public function tipoCliente()
    {
        return $this->belongsTo(TipoCliente::class, 'id_tipo_cliente');
    }

    public function visitas()
    {
        return $this->hasMany(Visita::class, 'id_clientes');
    }
}
