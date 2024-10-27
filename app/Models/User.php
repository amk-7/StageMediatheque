<?php

namespace App\Models;

use Exception;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public static function enregistrerUtilisateur(Request $request){

        //récuperation de l'image
        $image = $request->file('photo_profil');

        if ($image != null){
            //enregistrement de l'image
            $chemin_image = strtolower($request->nom).strtolower($request->prenom).'.'.$image->extension();
            $image->storeAs('public/images/image_utilisateur', $chemin_image);
        }
        else{
            $chemin_image = "profil.png";
        }

        $utilisateur = User::create([
            'nom' => strtoupper($request->nom),
            'prenom' => strtolower($request->prenom),
            'nom_utilisateur' => $request->nom_utilisateur,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'contact' => $request->contact ?? '',
            'photo_profil' => $chemin_image,
            'adresse' => $request->adresse,
            'sexe' => $request->sexe,

        ]);

        return $utilisateur;
    }

    public static function modifierUtilisateur(Request $request, $id_utilisateur){
        $utilisateur = User::find($id_utilisateur);
        $utilisateur->nom = strtoupper($request->nom);
        $utilisateur->prenom = strtolower($request->prenom);
        $utilisateur->email = $request->email;
        $utilisateur->contact = $request->contact;
        $utilisateur->adresse = $request->adresse;
        $utilisateur->sexe = $request->sexe;

        $image = $request->file('photo_profil');

        if ($image != null){
            try {
                //dd($image);
                //dd($image->getClientOriginalExtension());
                //enregistrement de l'image
                $chemin_image = $utilisateur->nom_utilisateur.'.'.$image->extension();
                //dd($chemin_image);
                $image->storeAs('public/images/image_utilisateur', $chemin_image);
                $utilisateur->photo_profil = $chemin_image;
            } catch(Exception $e){
                
            }
        }

        if ($request->password){
            $utilisateur->password = Hash::make($request->password);
        }
        $utilisateur->save();
        return $utilisateur;
    }
}
