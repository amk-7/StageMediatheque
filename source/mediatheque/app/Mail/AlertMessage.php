<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AlertMessage extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $emprunt;
    public function __construct($emprunt)
    {
        //
        $this->emprunt = $emprunt;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mailEmprunt = $this->emprunt;
        return $this->subject('Alerte')
                    ->view('emails.message_alerte', compact('mailEmprunt'));
    }
}
