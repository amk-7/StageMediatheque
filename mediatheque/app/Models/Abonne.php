<?php

namespace App\Models;

use App\Service\EmpruntService;
use Carbon\Carbon;
use Date;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;


class Abonne extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['date_naissance', 'profil_valider','niveau_etude', 'profession', 'contact_a_prevenir', 'numero_carte', 'type_de_carte', 'id_utilisateur'];
    protected $primaryKey = 'id_abonne';

    protected $casts = [
        'date_naissance' => 'date',
    ];

    public function utilisateur(){
        return $this->belongsTo(User::class, 'id_utilisateur');
    }

    public function activitys(){
        return $this->hasMany(Activite::class, 'id_abonne');
    }


    public function restitutions(){
        return $this->hasMany(Restitution::class, 'id_abonne');
    }

    public function registrations(){
        return $this->hasMany(Registration::class, 'id_abonne');
    }

    public function reservations(){
        return $this->hasMany(Reservation::class, 'id_abonne');
    }

    public function emprunts(){
        return $this->hasMany(Emprunt::class, 'id_abonne');
    }

    public function reservationsValide()
    {
        $reservations_valide = [];
        $reservations = $this->reservations;
        foreach($reservations as $reservation){
            if ($reservation->isEnable()){
                array_push($reservations_valide, $reservation);
            }
        }
        return Collect($reservations_valide);
    }

    public function isRegistrate()
    {
        $liste = $this->registrations;
        foreach ($liste as $l)
        {
            if ($l->etat == 1){
                $date1 = $l->date_fin;
                $date2 = Carbon::now();
                if ($date1->gte($date2))
                {
                    return true;
                }
            }
        }
        return false;
    }

    public function getEmpruntsEnCours()
    {
        $empuntNonRestitue = array();
        $listesEmprunts = Emprunt::all()->where('id_abonne', $this->id_abonne);

        foreach ($listesEmprunts as $emprunt) {
            if (! Emprunt::etatEmprunt($emprunt)) {
                array_push($empuntNonRestitue, $emprunt);
            }
        }
        //dd($empuntNonRestitue);

        return $empuntNonRestitue;
    }

    public function getNombreEprunt()
    {
        return Emprunt::all()->where('id_abonne', $this->id_abonne)->count();
    }

    public function getNombreRestitution()
    {
        return Restitution::all()->where('id_abonne', $this->id_abonne)->count();
    }

    public function abonnementEnCours()
    {
        $registrations = $this->registrations;
        //Pour chaque registration vérifier si la registration est valide
        foreach ($registrations as $r)
        {
            if ($r->estValide())
            {
                return true;
            }
        }
        return false;
    }

    public static function formatAbonneList(Collection $result){
        $abonnes = array();

        foreach ($result as $p){
            $personne = array(
                'id'=>$p->id_abonne,
                'nom'=>$p->utilisateur->nom,
                'prenom'=>$p->utilisateur->prenom,
                'estEligible'=>count($p->getEmpruntsEnCours()) == 0 ? 'true' : 'false',
                'pas_abonnement' => $p->abonnementEnCours() == true ? 'true' : 'false',
                'niveau' => $p->profession == "Elève" ? '1' : '0',
            );
            /*dump($p->profession);
            dump($personne['niveau']);*/
            array_push($abonnes, $personne);
        }
        return $abonnes;
    }

    public static function getAbonnesWithAllAttribut()
    {
        $result = Abonne::all();
        $abonnes = self::formatAbonneList($result);
        return $abonnes;
    }

    public static function getAbonnesValidateWithAllAttribut()
    {
        $result = Abonne::all()->where('profil_valider', 1);
        $abonnes = self::formatAbonneList($result);
        return $abonnes;
    }

    public static function getAbonnesRegistrateWithAllAttribut()
    {
        $result = self::getAbonnesWithAllAttribut();
        $abonnes = [];
        foreach ($result as $r){
            if (strtolower($r['pas_abonnement']) == "false"){
                array_push($abonnes, $r);
            }
        }
        return $abonnes;
    }


}
