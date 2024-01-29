<?php

namespace App\Exports;

use App\Models\Abonne;
use Maatwebsite\Excel\Concerns\FromCollection;

class AbonnesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $id_abonnes = collect(session('abonnes_key'));
        $liste = Abonne::whereIn('id_abonne', $id_abonnes)->get();

        if (session('paye') !== null) {
            $payeFilter = session('paye') === "oui" ? true : false;
            $abonnes = $liste->filter(function ($abonne) use ($payeFilter) {
                return $abonne->isRegistrate() === $payeFilter;
            });
        } else {
            $abonnes = $liste;
        }

        $liste_surcharger = AbonnesExport::formatAbonneListForExport($abonnes);

        $abonnesData = [
            [
                "nombre_abonnne",
                "nombre_abonnne_masculin",
                "nombre_abonnne_feminin",
                "nombre_de_non_paye",
            ],
            [
                "nombre_abonnne" => count($liste),
                "nombre_abonnne_masculin" => str($liste_surcharger[1]),
                "nombre_abonnne_feminin" => str($liste_surcharger[2]),
                "nombre_de_non_paye" => str($liste_surcharger[3]),
            ],
            [
                'id', 'nom', 'prenom', 'nomUtilisateur', 'sexe', 'email', 'contact', 'ville',
                'quartier', 'numéro_maison', 'profession', 'cntact_a_prevenir', 'type_carte',
                'numero_carte', 'a_payer', 'nombre_emprunts', 'nombre_restitutions',
                'nombre_emprunt_non_restituer',
            ],
            $liste_surcharger[0],
        ];

        return collect($abonnesData);
    }


    public static function formatAbonneListForExport($result)
    {
        $abonnes = [];
        $nombre_abonnne_masculin = 0;
        $nombre_abonnne_feminin = 0;
        $nombre_de_non_paye = 0;

        foreach ($result as $p) {
            $utilisateur = $p->utilisateur;

            $sexe = strtolower($utilisateur->sexe);
            $isRegistrate = $p->isRegistrate();

            $personne = [
                'id' => $p->id_abonne,
                'nom' => $utilisateur->nom,
                'prenom' => $utilisateur->prenom,
                'nomUtilisateur' => $utilisateur->nom_utilisateur,
                'sexe' => $sexe,
                'email' => $utilisateur->email,
                'contact' => $utilisateur->contact,
                'ville' => $utilisateur->adresse['ville'],
                'quartier' => $utilisateur->adresse['quartier'],
                'numéro_maison' => $utilisateur->adresse['numero_maison'],
                'profession' => $p->profession,
                'cntact_a_prevenir' => $utilisateur->cntact_a_prevenir,
                'type_carte' => $p->type_de_carte == "1" ? "Identité" : "Scolaire",
                'numero_carte' => $p->numero_carte,
                'a_payer' => $isRegistrate ? 'Oui' : 'Non',
                'nombre_emprunts' => $p->getNombreEprunt() ?: '0',
                'nombre_restitutions' => $p->getNombreRestitution() ?: '0',
                'nombre_emprunt_non_restituer' => count($p->getEmpruntsEnCours()) ?: '0',
            ];

            if ($sexe == "masculin") {
                $nombre_abonnne_masculin++;
            } else {
                $nombre_abonnne_feminin++;
            }

            if (!$isRegistrate) {
                $nombre_de_non_paye++;
            }

            $abonnes[] = $personne;
        }

        return [$abonnes, $nombre_abonnne_masculin, $nombre_abonnne_feminin, $nombre_de_non_paye];
    }
}
