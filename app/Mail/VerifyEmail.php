<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class VerifyEmail extends Mailable
{
    
    use Queueable, SerializesModels;

    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@prospekt-parts.com', 'Prospekt Parts')
            ->subject('Вы оформили заказ')
            ->view('mail.verify')
            ->with([
                'id' => $this->order['id'],
                'name' => $this->order['name']
            ]);
    }
}
