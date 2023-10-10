<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Artworks;
use App\Models\Bid;

class LeadingBidEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $artwork;
    public $leadingBid;

    /**
     * Create a new message instance.
     *
     * @param Artworks $artwork
     * @param Bid $leadingBid
     */
    public function __construct(Artworks $artwork, Bid $leadingBid)
    {
        $this->artwork = $artwork;
        $this->leadingBid = $leadingBid;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Winner')
                    ->view('emails.winner');
    }
}
//     public function content(): Content
//     {
//         return new Content(
//             view: 'emails.winner',
//         );
//     }

//     /**
//      * Get the attachments for the message.
//      *
//      * @return array<int, \Illuminate\Mail\Mailables\Attachment>
//      */
//     public function attachments(): array
//     {
//         return [];
//     }
// }


