<?php

namespace App\Service;

use App\Models\Reservation;

class ReservationService
{
    public static function reservationExpirer(Reservation $reservation)
    {
        $dateExpiration = $reservation->date_reservation->addDay(1);
        return $dateExpiration->gt(\Carbon\Carbon::now());
    }

    public static function annulerReservation(Reservation $reservation)
    {
        return false;
    }
}
