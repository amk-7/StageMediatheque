<?php

namespace App\Helpers;

use App\Models\Emprunt;
use App\Models\Reservation;
use App\Service\EmpruntService;
use App\Service\GlobaleService;

class ReservationHelper
{
    public static function afficherEtat(Reservation $reservation)
    {
        if ($reservation->etat==0){
            return "<td class='fieldset_border alert'>Expiré</td>";
        } else {
            return "<td class='fieldset_border info'>Valide</td>";
        }
    }

    public static function afficherDurreRestante($durre)
    {
        if ($durre == 0){
            return "0 H 0 min";
        }
        $durres = $durre/60;
        $durre = explode('.', $durres) ;
        $heur = $durre[0];
        $minute = explode('.', (($durres-$durre[0])*60))[0]."";
        return $heur." H ".$minute[0].$minute[1]." min ";
    }
}
?>
