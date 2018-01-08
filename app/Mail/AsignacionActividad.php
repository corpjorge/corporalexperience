<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AsignacionActividad extends Mailable
{
    use Queueable, SerializesModels;

    public $asunto,$mensaje,$dato;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($correo, $dato)
    {
      $this->correo = $correo;
      $this->asunto = 'Nueva actividad programada';
      $this->mensaje = 'Cordial saludo, Se ha programado la siguiente actividad a realizar';
      $this->dato = $dato;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.actividad.asignacion-actividad')
                    ->from('admin@corporalexperience.com')
                    ->with('name','Nueva actividad programada')
                    ->to($this->correo)
                    ->bcc('admin@corporalexperience.com')
                    ->subject('Nueva actividad programada');

    }
}
