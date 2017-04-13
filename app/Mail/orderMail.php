<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class orderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $order_products;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $order_products)
    {
        $this->order = $order;
        $this->order_products = $order_products;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.mymail');
    }
}
