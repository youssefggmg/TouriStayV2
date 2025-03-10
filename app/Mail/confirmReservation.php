<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class confirmReservation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    private $details;
    private $role;
    public function __construct($details , $role)
    {
        $this->details = $details;
        $this->role = $role;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirm Reservation',
        );
    }
    public function build()
    {
        if ($this->role == "turist") {
            return $this->from("elhoubiyoussef@gmail.com")
                        ->subject("conferm Reservation")
                        ->view("mail.conferm-mail")
                        ->with("details",$this->details);
        }
        elseif($this->role == "owner"){
            return $this->from("elhoubiyoussef@gmail.com")
                        ->subject("Reservation noification")
                        ->view("mail.resrvation-mail")
                        ->with("details",$this->details);
        }
    }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

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
