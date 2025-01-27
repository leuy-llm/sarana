<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $guest;
    public $payment;

   /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($booking, $guest, $payment)
    {
        //
        $this->booking = $booking;
        $this->guest = $guest;
        $this->payment = $payment;
        
    }

    /**
     * Get the message envelope.
     */
     /**
     * Build the message.
     *
     * @return $this
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Booking Information ',
            //. config('app.name')
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.booking-status',
            with: [
                'booking' => $this->booking,
                'guest' => $this->guest,
                'payment' => $this->payment,
                'rooms' => $this->booking->rooms, // Pass rooms to the view
            ]
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
