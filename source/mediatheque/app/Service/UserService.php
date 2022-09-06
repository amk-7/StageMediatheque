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
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'nom_utilisateur' => $request->nom_utilisateur,
            'numero_maison' => $request->numero_maison,
            'email' => $request->email,
            'password' => $request->password,
            'contact' => $request->contact,
            'photo_profil' => $chemin_image,
            'adresse' => $request->adresse,
            'sexe' => $request->sexe
        ]);

        return $utilisateur;
    }

    public static function modifierUtilisateur(Request $request, $id_utilisateur){
        $utilisateur = User::find($id_utilisateur);
        $utilisateur->nom = $request->nom;
        $utilisateur->prenom = $request->prenom;
        $utilisateur->nom_utilisateur = $request->nom_utilisateur;
        $utilisateur->numero_maison = $request->numero_maison;
        $utilisateur->email = $request->email;
        $utilisateur->password = $request->password;
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