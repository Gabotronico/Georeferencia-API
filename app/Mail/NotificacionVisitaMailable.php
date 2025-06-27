<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionVisitaMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $vendedor;
    public $clientes;

    public function __construct($vendedor, $clientes)
    {
        $this->vendedor = $vendedor;
        $this->clientes = $clientes;
    }

    public function build()
    {
        return $this->subject('Visitas asignadas para esta semana')
                    ->view('emails.notificacion_visita');
    }
}
