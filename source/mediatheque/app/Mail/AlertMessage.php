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
    public $data;
    public function __construct($_data)
    {
        //
        $this->data = $_data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $datas = $this->data;
        return $this->subject('Alerte')
                    ->view('emails.message_alerte', compact('datas'));
    }
}
