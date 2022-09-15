<?php

namespace App\Models;

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
        return $this->hasMany(Restitution::class, 'id_restitution');
    }

    public function registrations(){
        return $this->hasMany('App\Models\Registration', 'id_registraton');
    }

    public function reservations(){
        return $this->hasMany('App\Models\Reservation', 'id_reservation');
    }

    public function emprunts(){
        return $this->hasMany('App\Models\Emprunt','id_emprunt');
    }

    public function telechargements(){
        return $this->hasMany('App\Models\Telechargement', 'id_telechargement');
    }

   

    public function getEmpruntsEnCours()
    {
        $empuntNonRestitue = array();
        $listesEmprunts = DB::table('emprunts')
                          ->where('id_abonne', $this->id_abonne)
                          ->get();

        //dump($listesEmprunts);     
        foreach ($listesEmprunts as $emprunt) {
            $model_emprunt = Emprunt::find($emprunt->id_emprunt);
            if ($model_emprunt->restitution == null) {
                //dd(array_push($empuntNonRestitue, $emprunt));
                array_push($empuntNonRestitue, $model_emprunt);
            }
        }
        //dd($empuntNonRestitue);

        return $empuntNonRestitue;
    }
}
