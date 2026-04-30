<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected $fillable = [
        'first_name',
        'last_name_father',
        'last_name_mother',
        'ci',
        'ci_extension',
        'birth_date',
        'phone',
        'avatar',
        'username',
        'password',
        'active',
    ];

    //Nombre completo del usuario
    public function getFullNameAttribute(): string{
        return trim("{$this->first_name} {$this->last_name_father} {$this->last_name_mother}");
    }

    //Iniciales para avatar fallback
    public function getInitialsAttribute(): string{
        $parts = array_filter([
            $this->first_name,
            $this->last_name_father,
            $this->last_name_mother
        ]);
        return strtoupper(implode('', array_map(fn($p) => $p[0], $parts)));
    }

}
