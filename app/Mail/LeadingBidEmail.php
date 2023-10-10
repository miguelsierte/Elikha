<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Artworks;
use App\Models\Bid;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class LeadingBidEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $artwork;
    public $leadingBid;
    public $emailId; // Unique identifier for the email
    public $expiresAt; // Expiration date for the email

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
        $this->emailId = uniqid(); // Generate a unique email ID
        $this->expiresAt = Carbon::now()->addDays(3); // Set the expiration time
        // Store the email content in the cache with expiration
        Cache::put('email_' . $this->emailId, $this->render(), $this->expiresAt);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // No need to render the email here since we've already done it in the constructor
        return $this->subject('Winner')
                    ->view('emails.winner');
    }
}
