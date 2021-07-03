<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PreOrderInvoiceMail extends Mailable
{
    protected $order;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
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
        return
            $this->attach(('backend/orders/invoices/'.$this->order->order_id.'.pdf'))
                ->subject('Pre Order Confirmation!')
                ->from($address = 'newroz@newroz.com', $name = 'Newroz e- shop')
                ->view('backend.pages.preOrders.mail.invoice_mail')
                ->with(['order'=> $this->order]);
    }
}
