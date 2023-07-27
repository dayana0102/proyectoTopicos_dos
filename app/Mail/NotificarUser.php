<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificarUser extends Mailable
{
    use Queueable, SerializesModels;
    private $asunto;
    private $cuerpo;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($asunto,$cuerpo)
    {
        $this->asunto=$asunto;
        $this->cuerpo=$cuerpo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return  $this->from('gradosytitulosundac2022@gmail.com', 'Grados y Títulos')
        //->to('orioltunino1234@gmail.com')
        ->view('emails.correo')
        ->subject($this->asunto)
        ->with(['cuerpo'=>$this->cuerpo]);
        
    }
}
