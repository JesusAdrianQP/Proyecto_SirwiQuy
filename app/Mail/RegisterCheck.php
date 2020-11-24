<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;

class RegisterCheck extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $email;
    public $pass;

    public $subject = '[SIRWIYQUY] - Registro de usuario';
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $email, $pass)
    {
        $this->user = $user;
        $this->email = $email;
        $this->pass = $pass;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.Registercheck');
    }
}
