<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'rfc',
        'curp',
        'sexo',
        'theme',
        'nivel',
        'puesto',
        'estatus',
        'profile_photo_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the URL to the user's profile photo.
     *
     * @return string
     */
    public function getProfilePhotoUrlAttribute()
    {
        // Si tenemos una foto personalizada y existe el archivo
        if ($this->profile_photo_path && file_exists(public_path($this->profile_photo_path))) {
            return asset($this->profile_photo_path);
        }
        
        // Fallback a avatar con iniciales usando UI Avatars
        return "https://ui-avatars.com/api/?name=" . urlencode($this->name) . "&color=7F9CF5&background=EBF4FF";
    }

    /**
     * Get the reportes where this user is the profesor.
     */
    public function reportesComoProfesor()
    {
        return $this->hasMany(ReporteAlumno::class, 'profesor_id');
    }

    /**
     * Get the reportes where this user is the prefecto.
     */
    public function reportesComoPrefecto()
    {
        return $this->hasMany(ReporteAlumno::class, 'prefecto_id');
    }

    /**
     * Get the reportes where this user is the trabajador social.
     */
    public function reportesComoTrabajadorSocial()
    {
        return $this->hasMany(ReporteAlumno::class, 'trabajo_social_id');
    }

    /**
     * Check if user is a profesor.
     */
    public function esProfesor(): bool
    {
        return $this->puesto === 'DOCENTE';
    }

    /**
     * Check if user is a prefecto.
     */
    public function esPrefecto(): bool
    {
        return $this->puesto === 'PREFECTURA';
    }

    /**
     * Check if user is a trabajador social.
     */
    public function esTrabajadorSocial(): bool
    {
        return $this->puesto === 'TRABAJO SOCIAL';
    }
}
