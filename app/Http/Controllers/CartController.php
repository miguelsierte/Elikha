<?php

namespace App\Http\Controllers;

use App\Models\Artworks;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Method to add artwork to the cart
    public function addItemToCart(Request $request)
{
    // Validate the request data
    $request->validate([
        'artwork_id' => 'required|exists:artworks,id',
    ]);

    // Retrieve artwork details by ID
    $artwork = Artworks::find($request->input('artwork_id'));

    // Check if the artwork exists
    if (!$artwork) {
        return redirect()->route('shopbuyer')->with('error', 'Artwork not found!');
    }

    // Check if the artwork is already in the cart
    $existingCartItem = Cart::where('user_id', Auth::user()->id)
                            ->where('artwork_id', $artwork->id)
                            ->first();

    // If the artwork is already in the cart, you can update the quantity or prevent adding it again
    if ($existingCartItem) {
        // For example, you can update the quantity of the existing item like this:
        // $existingCartItem->increment('quantity');
        
        // Or you can simply return a message indicating that the artwork is already in the cart
        return redirect()->route('shopbuyer')->with('error', 'Artwork is already in the cart!');
    }

    // Add artwork to the cart
    Cart::create([
        'user_id' => Auth::user()->id,
        'artwork_id' => $artwork->id,
        'price' => $artwork->price,
        'type' => $artwork->start_price ? 'auction' : 'sale',
        // Add other details as needed
    ]);

    return redirect()->route('shopbuyer')->with('success', 'Artwork added to cart successfully!');
}


    // Method to show the cart
    public function showCart()
    {
        $user = Auth::user();
        $cartItems = Cart::with('artwork.bids')->where('user_id', $user->id)->get();
        
    
        $auctionItems = $cartItems->filter(function ($cartItem) {
            return $cartItem->artwork->start_price !== null;
        });
    
        $saleItems = $cartItems->filter(function ($cartItem) {
            return $cartItem->artwork->start_price === null;
        });
    
        // Calculate total price for both auctioned and for sale items
        $totalPrice = 0;
    
        // Add prices of artworks for sale
        $totalPrice += $saleItems->sum(function ($cartItem) {
            return $cartItem->artwork->price;
        });
    
        // Add leading bid amounts for auctioned artworks
        foreach ($auctionItems as $cartItem) {
            $leadingBid = $cartItem->artwork->bids->max('amount');
            if ($leadingBid) {
                $totalPrice += $leadingBid;
            }
        }
    
        return view('buyer.cart', compact('auctionItems', 'saleItems', 'totalPrice', 'user'));
    }
    



    // Method to remove an item from the cart
    public function removeFromCart(Request $request, $artworkId)
    {
        // Find the cart item by artwork ID and user ID
        $cartItem = Cart::where('artwork_id', $artworkId)
            ->where('user_id', auth()->user()->id)
            ->first();

        // If the cart item exists, delete it
        if ($cartItem) {
            $cartItem->delete();

            // Redirect back to the cart page with a success message
            return redirect()->route('cart.index')->with('success', 'Artwork removed from the cart successfully');
        }

        // If the cart item does not exist, redirect back with an error message
        return redirect()->route('cart.index')->with('error', 'Artwork not found in the cart');
    }

    // Method to view the cart page
    public function index(Request $request)
    {
        $sortType = $request->input('sort_type', 'for_sale');
    
        // Fetch cart items based on sort type
        $cartItems = Cart::with('artwork')->where('user_id', auth()->id())
                        ->orderBy('created_at', 'desc')
                        ->get();
    
        // ... (other logic)
    
        return view('buyer.cart', compact('cartItems', 'totalPrice'));
    }
    public function placeBid(Request $request, $artworkId)
{
    // Validate request data here if needed

    // Your bid placement logic
    // ...

    // Redirect back with success message or any response you want
    return redirect()->back()->with('success', 'Bid placed successfully!');
}

    
}
