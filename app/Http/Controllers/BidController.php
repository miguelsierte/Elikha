<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bid; // Import the Bid model
use App\Models\Artworks;
use Illuminate\Support\Facades\Auth;


class BidController extends Controller
{
    public function placeBid(Request $request, $artworkId)
{
    // Validate the bid amount
    $request->validate([
        'amount' => 'required|numeric|min:1',
    ]);

    $user = Auth::user();
    $amount = $request->input('amount');
    $artwork = Artworks::find($artworkId);

    // Check if the artwork exists
    if (!$artwork) {
        return redirect()->back()->with('error', 'Artwork not found.');
    }

    // Check if the bid amount is lower than the current bid or artwork price
    if ($amount < $artwork->start_price || $amount < $artwork->bids->max('amount')) {
        return redirect()->back()->with('error', 'Bid amount must be greater than the current bid and artwork price.');
    }

    // Create and save the bid
    $bid = new Bid();
    $bid->user_id = $user->id;
    $bid->artwork_id = $artworkId;
    $bid->amount = $amount;
    $bid->save();

    // Redirect back with success or error message
    return back()->with('success', 'Bid placed successfully!');
}


}
