<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailInscription extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $abonne;
    public function __construct($abonne)
    {
        //
        $this->abonne = $abonne;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('view.name');
        $mailAbonne = $this->abonne; // Les données du mail à envoyer
        return $this->subject('Confirmation')
                    ->view('emails.message_confirmation', compact('mailAbonne'));
    }
}
