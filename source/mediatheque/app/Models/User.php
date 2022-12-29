<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'nom_utilisateur',
        'numero_maison',
        'email',
        'password',
        'contact',
        'photo_profil',
        'adresse',
        'sexe'
    ];
    protected $primaryKey = 'id_utilisateur';

    public function getUserFullNameAttribute()
    {
        return $this->nom." ".$this->prenom;
    }

    public function abonne()
    {
        return $this->hasOne('App\Models\Abonne', 'id_utilisateur');
    }

    public function personnel()
    {
        return $$this->hasOne('App\Models\Personnel', 'id_utilisateur');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'adresse' => 'array'
    ];
}
