<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auteur extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'prenom'];
    protected $primaryKey = 'id_auteur';

    public function ouvrages()
    {
        return $this->belongsToMany(Ouvrage::class, "auteur_ouvrage", "id_ouvrage", "id_auteur")
                    ->withTimestamps();
    }

    public static function enregistrerAuteur($data_auteurs)
    {
        $auteurs = [];
        foreach ($data_auteurs as $info_auteur){
            try {
                //dd($info_auteur);
                $nom = empty($info_auteur[0]) ? null : trim($info_auteur[0]) ;
                $prenom = empty($info_auteur[1]) ? null : trim($info_auteur[1]) ;

                if (is_array($info_auteur) && $nom && $prenom){
                    //dump($info_auteur);
                    $auteur = self::auteur_exist($nom, $prenom);
                    if (! $auteur){
                        $auteur = Auteur::Create([
                            "nom"=>trim(strtolower($nom)),
                            "prenom"=>trim(strtolower($prenom)),
                        ]);
                    }
                    array_push($auteurs, $auteur);
                }
            } catch(Exception $e) {
                //echo $e;
            }
        }
        //dd($auteurs);
        //dd("Auteur error");
        return $auteurs;
    }

    public static function auteur_exist(String $nom, string $prenom)
    {
        $auteur = Auteur::all()->where("nom", trim(strtolower($nom)))->where("prenom", trim(strtolower($prenom)))->first();
        return $auteur ;
    }

}
