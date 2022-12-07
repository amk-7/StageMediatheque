<?php

namespace App\Service;

use App\Helpers\UtilisateurHelper;
use App\Models\User;
use Illuminate\Http\Request;

class UserService
{
    public static function enregistrerUtilisateur(Request $request){

        //récuperation de l'image
        $image = $request->file('photo_profil');

        if ($image != null){
            //enregistrement de l'image
            $chemin_image = strtolower($request->nom).strtolower($request->prenom).'.'.$image->extension();
            $image->storeAs('public/images/image_utilisateur', $chemin_image);
        }
        else{
            $chemin_image = "personne.jpg";
        }
        $utilisateur = User::create([
            'nom' => strtoupper($request->nom),
            'prenom' => strtolower($request->prenom),
            'nom_utilisateur' => $request->nom_utilisateur,
            'email' => $request->email,
            'password' => \Hash::make($request->password),
            'confirmation_password' => \Hash::make($request->confirmation_password),
            'contact' => $request->contact,
            'photo_profil' => $chemin_image,
            'adresse' => $request->adresse,
            'sexe' => $request->sexe
        ]);

        return $utilisateur;
    }

    public static function modifierUtilisateur(Request $request, $id_utilisateur){
        $utilisateur = User::find($id_utilisateur);
        $utilisateur->nom = strtoupper($request->nom);
        $utilisateur->prenom = strtolower($request->prenom);
        $utilisateur->nom_utilisateur = $request->nom_utilisateur;
        $utilisateur->email = $request->email;
        //$utilisateur->password = $request->password;
        //$utilisateur->confirmation_password = $request->confirmation_password;
        $utilisateur->contact = $request->contact;
        $utilisateur->adresse = $request->adresse;
        $utilisateur->sexe = $request->sexe;

        //récuperation de l'image
        $image = $request->file('photo_profil');

        if ($image != null){
            //enregistrement de l'image
            $chemin_image = strtolower($request->nom).strtolower($request->prenom).'.'.$image->extension();
            $image->storeAs('public/images/image_utilisateur', $chemin_image);
            $utilisateur->photo_profil = $chemin_image;
        }

        $utilisateur->save();
        return $utilisateur;
    }

}

?>
