<?php

namespace App\Mail;

use App\Models\Cliente;
use App\Models\Visita;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionClienteMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $cliente;
    public $visita;

    public function __construct(Cliente $cliente, Visita $visita)
    {
        $this->cliente = $cliente;
        $this->visita = $visita;
    }

    public function build()
    {
        return $this->subject('📅 ¡Tienes una visita programada!')
                    ->view('emails.notificacion_cliente');
    }
}
