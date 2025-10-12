<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReporteAlumno extends Model
{
    protected $table = 'reportes_alumnos';

    protected $fillable = [
        'student_id',
        'fecha_reporte',
        'materia',
        'profesor_id',
        'prefecto_id',
        'trabajo_social_id',
        'descripcion_reporte',
        'estado',
        'firma_prefecto_at',
        'firma_trabajo_social_at',
        'observaciones',
        'version'
    ];

    protected $casts = [
        'fecha_reporte' => 'date',
        'firma_prefecto_at' => 'datetime',
        'firma_trabajo_social_at' => 'datetime',
    ];

    // Relaciones
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function profesor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'profesor_id');
    }

    public function prefecto(): BelongsTo
    {
        return $this->belongsTo(User::class, 'prefecto_id');
    }

    public function trabajadorSocial(): BelongsTo
    {
        return $this->belongsTo(User::class, 'trabajo_social_id');
    }

    // Scopes
    public function scopePendientes($query)
    {
        return $query->where('estado', 'pendiente');
    }

    public function scopeFirmadosPorPrefecto($query)
    {
        return $query->where('estado', 'firmado_prefecto');
    }

    public function scopeCompletados($query)
    {
        return $query->where('estado', 'completado');
    }

    // Métodos auxiliares
    public function puedeFirmarPrefecto(): bool
    {
        return $this->estado === 'pendiente';
    }

    public function puedeFirmarTrabajoSocial(): bool
    {
        return $this->estado === 'firmado_prefecto';
    }

    public function estaCompletado(): bool
    {
        return $this->estado === 'completado';
    }
}
