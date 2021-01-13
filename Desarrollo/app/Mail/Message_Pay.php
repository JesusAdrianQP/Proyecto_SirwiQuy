<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Message_Pay extends Mailable
{
    use Queueable, SerializesModels;

    public $pay;

    public $subject = '[SIRWIYQUY] - Servicio pagado exitosamente';
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pay)
    {
        $this->pay = $pay;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.Message_Pay');
    }
}
