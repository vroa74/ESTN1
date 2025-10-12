<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bitacora extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bitacoras';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'student_id',
        'accion',
        'modulo',
        'descripcion',
        'ip',
        'user_agent',
        'hora',
        'fecha',
        'datos_anteriores',
        'datos_nuevos',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fecha' => 'date',
        'hora' => 'datetime:H:i:s',
        'datos_anteriores' => 'array',
        'datos_nuevos' => 'array',
    ];

    /**
     * Get the user that owns the bitacora.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the student that owns the bitacora.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
