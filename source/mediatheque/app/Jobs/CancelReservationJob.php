<?php

namespace App\Jobs;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CancelReservationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $id_reservation;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $id_reservation)
    {
        $this->id_reservation = $id_reservation;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $reservation = Reservation::all()->where('id_reservation', $this->id_reservation)->first();
        if ($reservation->etat == 1){
            $reservation->etat = 0;
            $reservation->save();
        }
    }
}
