<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $fillable = [
        'grado',
        'materia',
    ];

    // Scopes para búsquedas
    public function scopePorGrado($query, $grado)
    {
        if ($grado) {
            return $query->where('grado', $grado);
        }
        return $query;
    }

    public function scopeBuscar($query, $termino)
    {
        if ($termino) {
            return $query->where('materia', 'like', '%' . $termino . '%');
        }
        return $query;
    }
}
