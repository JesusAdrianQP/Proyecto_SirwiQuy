<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Message_Reset extends Mailable
{
    use Queueable, SerializesModels;

    public $obj;
    public $ide;

    public $subject = 'Cambio de contraseña - Servicios KUSAWASI';
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($obj, $ide)
    {
        $this->obj = $obj;
        $this->ide = $ide;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.Message_Reset');
    }
}
