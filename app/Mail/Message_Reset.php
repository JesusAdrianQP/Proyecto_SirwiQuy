<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Message_Reset extends Mailable
{
    use Queueable, SerializesModels;

    public $objUser;
    public $ide;

    public $subject = '[SIRWIYQUY] - Cambio de contraseña';
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($objUser, $ide)
    {
        $this->objUser = $objUser;
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
