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
        'sex',
        'email',
        'telefono',
        'estatus',
        'observaciones',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fnac' => 'date',
        'sex' => 'boolean',
        'status' => 'boolean',
    ];

    /**
     * Get the bitacoras for the student.
     */
    public function bitacoras(): HasMany
    {
        return $this->hasMany(Bitacora::class);
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
