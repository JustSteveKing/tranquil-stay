<?php

declare(strict_types=1);

namespace App\Mail\Reservations;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

final class BookingIsPending extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your stay at Tranquil Stay is pending confirmation',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.reservations.booking-pending',
        );
    }
}
