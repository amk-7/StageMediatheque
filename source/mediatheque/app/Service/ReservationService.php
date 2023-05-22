<?php

namespace App\Service;

use App\Models\Reservation;
use Carbon\Carbon;

class ReservationService
{
    public static function reservationExpirer(Reservation $reservation)
    {
        if ($reservation->etat == 0){
            return 0;
        }
        $dateExpiration = $reservation->date_reservation->addHour(24);
        $durreRestante = $dateExpiration->diffInMinutes(Carbon::now());
        return $durreRestante;
    }

    public static function annulerReservation(Reservation $reservation)
    {
        return false;
    }

}
