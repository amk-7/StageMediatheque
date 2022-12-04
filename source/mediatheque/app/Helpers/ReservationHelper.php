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
}
?>
