<?php

namespace App\Service;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\registration;


use App\Models\Abonne;

class AbonneService
{
    public static function verifierSiAbonneExist($nom, $prenom){
        Abonne::all()->where('nom', $nom)->where('prenom', $prenom);
        return true;
    }

    public static function formatAbonneListForExport($result){
        $abonnes = array();

        $nombre_abonnne_masculin = 0;
        $nombre_abonnne_feminin = 0;
        $nombre_de_non_paye = 0;

        foreach ($result as $p){
            if ($p->utilisateur->sexe == "Masculin"){
                $nombre_abonnne_masculin++;
            } else {
                $nombre_abonnne_feminin++;
            }
            if (! $p->isRegistrate()){
                $nombre_de_non_paye++;
            }
            $personne = array(
                'id'=>$p->id_abonne,
                'nom'=>$p->utilisateur->nom,
                'prenom'=>$p->utilisateur->prenom,
                'prenom'=>$p->utilisateur->sexe,
                'nomUtilisateur' => $p->utilisateur->nom_utilisateur,
                'email' => $p->utilisateur->email,
                'contact' => $p->utilisateur->contact,
                'ville' => $p->utilisateur->adresse['ville'],
                'quartier' => $p->utilisateur->adresse['quartier'],
                'numéro_maison' => $p->utilisateur->adresse['numero_maison'],
                'profession' => $p->profession,
                'cntact_a_prevenir' => $p->utilisateur->cntact_a_prevenir,
                'type_carte' => $p->type_de_carte,
                'numero_carte' => $p->numero_carte,
                'a_payer' => $p->isRegistrate() ? 'Oui' : 'Non',
                'nombre_emprunts' => $p->getNombreEprunt() != 0 ? $p->getNombreEprunt(): '0',
                'nombre_restitutions' => $p->getNombreRestitution() != 0 ? $p->getNombreRestitution() : '0',
                'nombre_emprunt_non_restituer' => count($p->getEmpruntsEnCours()) != 0 ? count($p->getEmpruntsEnCours()) : '0',
            );
            array_push($abonnes, $personne);
        }
        return array($abonnes, $nombre_abonnne_masculin, $nombre_abonnne_feminin, $nombre_de_non_paye);
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
                'niveau' => $p->profession == "Éleve" ? '1' : '0',
            );
            array_push($abonnes, $personne);
        }
        return $abonnes;
    }

    public static function getAbonnesWithAllAttribut()
    {
        $result = Abonne::all();
        $abonnes = AbonneService::formatAbonneList($result);
        return $abonnes;
    }

    public static function getAbonnesValidateWithAllAttribut()
    {
        $result = Abonne::all()->where('profil_valider', 1);
        $abonnes = AbonneService::formatAbonneList($result);
        return $abonnes;
    }
    public static function getAbonnesRegistrateWithAllAttribut()
    {
        $result = AbonneService::getAbonnesWithAllAttribut();
        $abonnes = [];
        foreach ($result as $r){
            if (strtolower($r['pas_abonnement']) == "false"){
                array_push($abonnes, $r);
            }
        }
        return $abonnes;
    }
    /**
     * @param $etat : restituer ou non restituté
     */
    public static function recherche($etat, $nom){
        $abonnes = Abonne::all()->where('nom', 'like', '%'.$nom.'%');
        $abonnes = AbonneService::formatAbonneList($abonnes);
        return $abonnes;
    }

    public static function getAbonnesId(){
        $abonnes = Abonne::all();
        $abonnesId = array();
        foreach ($abonnes as $abonne){
            array_push($abonnesId, $abonne->id_abonne);
        }
        return $abonnesId;
    }

    public static function setAbonnesLIstInSession(array $liste)
    {
        \session(['abonnes_key' => $liste]);
    }

}





