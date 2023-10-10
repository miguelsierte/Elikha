<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class LeadingBidNotification extends Notification
{
    protected $artwork;
    protected $leadingBid;

    public function __construct($artwork, $leadingBid)
    {
        $this->artwork = $artwork;
        $this->leadingBid = $leadingBid;
    }

    public function toMail($notifiable)
    {
        $artworkTitle = $this->artwork->title;
        $bidAmount = $this->leadingBid->amount;

        return (new MailMessage)
            ->line("Congratulations! You have the leading bid for the artwork '{$artworkTitle}'.")
            ->line("Your bid amount: ${$bidAmount}")
            ->action('View Artwork', route('artwork.show', $this->artwork->id))
            ->line('Thank you for participating in the auction.');
    }

    public function toArray($notifiable)
    {
        return [
            // Additional data you want to send as a notification array
        ];
    }
}
