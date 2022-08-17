<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom', 
        'prenom', 
        'nom_utilisateur', 
        'email', 
        'password', 
        'contact', 
        'photo_profil', 
        'adresse', 
        'sexe'        
    ];
    protected $primaryKey = 'id_utilisateur';
    protected $cast = ['adresse' => 'array'];

    public function abonne()
    {
        return $this->hasOne('App\Models\Abonne', 'id_abonne');
    }

    public function personnel()
    {
        return $$this->hasOne('App\Models\Personnel', 'id_personnel');
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
    ];
}
