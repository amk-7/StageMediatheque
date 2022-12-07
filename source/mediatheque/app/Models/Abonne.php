<?php

namespace App\Models;

use Carbon\Carbon;
use Date;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Abonne extends Model
{
    use HasFactory;
    protected $fillable = ['date_naissance', 'niveau_etude', 'profession', 'contact_a_prevenir', 'numero_carte', 'type_de_carte', 'id_utilisateur'];
    protected $primaryKey = 'id_abonne';
    protected $dates = ['date_naissance'];

    public function utilisateur(){
        return $this->belongsTo('App\Models\User', 'id_utilisateur');
    }

    public function restitutions(){
        return $this->hasMany(Restitution::class, 'id_abonne');
    }

    public function registrations(){
        return $this->hasMany('App\Models\Registration', 'id_abonne');
    }

    public function reservations(){
        return $this->hasMany(Reservation::class, 'id_abonne');
    }

    public function emprunts(){
        return $this->hasMany('App\Models\Emprunt', 'id_abonne');
    }

    public function telechargements(){
        return $this->hasMany('App\Models\Telechargement', 'id_telechargement');
    }

    public function reservationValide()
    {
        $reservation = $this->reservations;
        return $reservation;
    }

    public function isRegistrate()
    {
        $liste = $this->registrations;
        foreach ($liste as $l)
        {
            $date1 = $l->date_fin;
            $date2 = Carbon::now();
            if ($date1->gte($date2))
            {
               return true;
            }
        }
        return false;
    }

    public function getEmpruntsEnCours()
    {
        $empuntNonRestitue = array();
        $listesEmprunts = Emprunt::all()->where('id_abonne', $this->id_abonne);

        foreach ($listesEmprunts as $emprunt) {
            if (Restitution::all()->where('id_emprunt', $emprunt->id_emprunt)->first() == null) {
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

    public function abonnementEnCours(){
        //liste des registrations de l'obonne courant
        //Pour chaque registration virifier si la registration est valide.
        // Si une registration est valide alors return true;
        // si aucune registration n'est valide alors return false;
        return "";
    }
}
