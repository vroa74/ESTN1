<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'students';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'matricula',
        'grado',
        'grupo',
        'Fnom',
        'nombres',
        'apa',
        'ama',
        'fnac',
        'curp',
        'sexo',
        'email',
        'telefono',
        'estatus',
        'observaciones',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fnac' => 'date',
    ];

    /**
     * Get the bitacoras for the student.
     */
    public function bitacoras(): HasMany
    {
        return $this->hasMany(Bitacora::class);
    }

    /**
     * Get the reportes for the student.
     */
    public function reportes(): HasMany
    {
        return $this->hasMany(ReporteAlumno::class);
    }

    /**
     * Get the student's full name.
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return trim("{$this->nombres} {$this->apa} {$this->ama}");
    }
}
