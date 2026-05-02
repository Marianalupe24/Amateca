<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'apellido',
        'email',
        'telefono',
        'password',
        'rol',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->rol === 'admin';
    }

    public function isEmpleado(): bool
    {
        return $this->rol === 'empleado';
    }

    public function isStaff(): bool
    {
        return in_array($this->rol, ['admin', 'empleado']);
    }

    public function scopeEmployees($query)
    {
        return $query->where('rol', 'empleado');
    }

    public function scopeAdmins($query)
    {
        return $query->where('rol', 'admin');
    }

    public function cart()
    {
        return $this->hasOne(\App\Models\Cart::class, 'id_usuario');
    }

    public function comments()
    {
        return $this->hasMany(\App\Models\Comment::class, 'id_usuario');
    }

    public function ratings()
    {
        return $this->hasMany(\App\Models\Rating::class, 'id_usuario');
    }

    public function facturas()
    {
        return $this->hasMany(\App\Models\Factura::class, 'id_usuario');
    }
}