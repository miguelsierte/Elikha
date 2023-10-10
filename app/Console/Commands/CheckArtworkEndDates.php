<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Artworks;
use App\Models\Bid;
use Illuminate\Support\Facades\Mail;
use App\Mail\LeadingBidEmail;
use App\Models\User;


class CheckArtworkEndDates extends Command
{
    protected $signature = 'artwork:end-date-check';
    protected $description = 'Check for artworks with expired end dates and notify leading bidders';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Query artworks with expired end_date
        $expiredArtworks = Artworks::where('end_date', '<=', now())
        ->where('status', 'Approved')
        ->get();

        foreach ($expiredArtworks as $artwork) {
            // Find the maximum bid amount
            $maxBidAmount = $artwork->bids->max('amount');
        
            // Find the bid with the maximum amount
            $leadingBid = $artwork->bids->where('amount', $maxBidAmount)->first();
        
            // Check if there is a leading bid
            if ($leadingBid) {
                $leadingBidder = $leadingBid->user_id;
        
                if ($leadingBidder) {
                    $emailAddress = User::findOrFail($leadingBidder)->email;
        
                    Mail::to($emailAddress)->send(new LeadingBidEmail($artwork, $leadingBid));
                }
            }
        }

        $this->info('Artwork end date check completed.');
    }

}
