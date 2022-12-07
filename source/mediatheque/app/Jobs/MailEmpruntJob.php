<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailEmprunt;
use App\Models\Emprunt;

class MailEmpruntJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $id_emprunt;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $id_emprunt)
    {
        $this->id_emprunt = $id_emprunt;
    
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $emprunt = Emprunt::all()->where('id_emprunt', $this->id_emprunt)->first();
        $emprunt->save();
    }
}
