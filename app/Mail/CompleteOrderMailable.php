<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;  

class CompleteOrderMailable extends Mailable
{
    use Queueable, SerializesModels;

    private $products;
    private $total_price;

    /**
     * Create a new message instance.
     */
    public function __construct($data){
        $this->products = $data['items'];
        $this->total_price = $data['total_price'];
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('complete_order@foodnow.com', 'Nick Ivanov'),
            subject: 'Успрешно завършване на поръчката',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail_components.template-checkout',
            with: ['products' => $this->products, 'total_price' => $this->total_price],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
