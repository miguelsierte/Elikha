<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArtistBuyer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\HomeController;
use App\Models\Artworks;
use App\Models\User;
use App\Models\Ticket;
use Carbon\Carbon; 
use App\Models\Verify;
use Illuminate\Support\Facades\DB;
use App\Models\Bid;
use Chatify\Facades\ChatifyMessenger as Chatify;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;


class UsersController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}
    public function artist()
    {
        return view('users.artist');
    }
    public function profile()
    {
        $user = Auth::user();
        $artwork = Artworks::where('users_id', Auth::id())
    ->where(function ($query) {
        $query->where('status', 'Approved')
              ->orWhere('status', 'Sold');
    })
    ->orderBy('created_at', 'DESC')
    ->get();
    $userId = Auth::user()->id;
    
    // Check if the user has a valid GCash verification request
    $userVerification = Verify::where('users_id', $userId)
        ->where('status', 'Approved')
        ->exists();

        return view('portfolio.profile', compact('user','artwork', 'userVerification'));
    }
    public function editprofile()
    {
        $user = Auth::user();
        return view('portfolio.editprofile', compact('user'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'nullable',
            'bio' => 'nullable',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'twitter' => 'nullable|url'
        ]);
    
        $user = Auth::user();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
    
            // Validate image file type
            $allowedFileTypes = ['jpg', 'jpeg', 'png'];
            $extension = $image->getClientOriginalExtension();
            if (!in_array($extension, $allowedFileTypes)) {
                return redirect()->back()->withErrors(['image' => 'Invalid image file type. Please upload a jpg, jpeg, or png file.']);
            }
    
            // Validate image file size
            $maxFileSize = 1024 * 1024; // 1MB
            $fileSize = $image->getSize();
            if ($fileSize > $maxFileSize) {
                return redirect()->back()->withErrors(['image' => 'The image file size must be less than 1MB.']);
            }
    
            // Upload and save image
            $filename = time() . '.' . $extension;
            $image->move(public_path('images'), $filename);
            $user->image = $filename;
        }
    
        // Update user details
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->mobile = $request->input('mobile');
        $user->bio = $request->input('bio');
        $user->facebook = $request->input('facebook');
        $user->instagram = $request->input('instagram');
        $user->twitter = $request->input('twitter');
        $user->save();

    return redirect()->to('profile')->with('success', 'Profile updated successfully!');
    }

    public function artistHome()
    {
        $activeArtworksCount = Artworks::where('users_id', Auth::id())
        ->where('status', 'Approved')
        ->count();
        $pendingArtworksCount = Artworks::where('users_id', Auth::id())
        ->where('status', 'Pending')
        ->count();
        $soldArtworksCount = Artworks::where('users_id', Auth::id())
        ->where('status', 'Sold')
        ->count();
        $userVerification = Verify::where('users_id', Auth::id())
        ->where('status', 'Approved')
        ->exists();
            return view('artist.home', compact('activeArtworksCount', 'pendingArtworksCount', 'soldArtworksCount', 'userVerification'));
    }
    public function artistAuction(Request $request)
    {
        $artwork = Artworks::where('users_id', Auth::id())
        ->where('status', 'Approved')
        ->orderBy('created_at', 'DESC')
        ->get();

    // Fetch bidders for each artwork
    foreach ($artwork as $artworks) {
        $artworks->bidders = DB::table('bids')
            ->where('artwork_id', $artworks->id)
            ->join('users', 'bids.user_id', '=', 'users.id')
            ->select('users.name as bidder_name', 'bids.amount', 'bids.created_at')
            ->get();
    }

    return view('artist.myauctions', compact('artwork'));
    }
    public function sold(Request $request, $id)
{
    $artwork = Artworks::findOrFail($id);
    $artwork->status = 'Sold';
    $artwork->save();
    return back()->with("success", "Artwork marked as sold!");
}
    public function artistSettings()
    {
        return view('artist.settings');
    }
    public function updateartistSetting(Request $request)
{
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "Old Password Doesn't match!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
}
    public function artistMessage()
    {
        return view('artist.message');
    }
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'title' => 'required',
        'description' => 'required',
    ]);
    $ticket = Ticket::create([
        'title' => $validatedData['title'],
        'description' => $validatedData['description'],
        'users_id' => Auth::id(),
        'status' => false,
        
    ]);

    return back()->with('success', 'Ticket created successfully!');
}
//buyer
public function buyerhome()
{
    $user = Auth::user();

    // Get the current date and time
    $currentDateTime = Carbon::now();

    $artwork = Artworks::where('status', 'Approved')
        ->where('start_date', '>', $currentDateTime) 
        ->where('end_date', '>', $currentDateTime)   
        ->orderBy('start_date', 'ASC')
        ->get();

    return view('buyer.buyerhome', compact('user', 'artwork'));
}

public function updateBuyerSettings(Request $request)
{
    
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "Old Password Doesn't match!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
}

    public function shopbuyer(Request $request)
{
    $user = Auth::user();
    $highlightsData = DB::table('highlights')->first(); 
    $query = Artworks::where('status', 'Approved');

    // Handle sorting by "For Sale" and "For Auction"
    if ($request->has('sort_type')) {
        $sortTypeOption = $request->sort_type;
        if ($sortTypeOption === 'for_sale') {
            $query->whereNull('start_date')->orderBy('id', 'ASC');
        } elseif ($sortTypeOption === 'for_auction') {
            // Prioritize "For Auction" sorting by 'start_price'
            $query->whereNotNull('start_date')->orderBy('id', 'ASC');
        }
    }

    // Handle search query
    if ($request->has('search')) {
        $searchQuery = $request->input('search');   
        $query->where(function ($q) use ($searchQuery) {
            $q->where('title', 'like', '%' . $searchQuery . '%')
                ->orWhereHas('user', function ($u) use ($searchQuery) {
                    $u->where('name', 'like', '%' . $searchQuery . '%');
                });
        });
    }

    // Default sorting if no sorting options are provided
    if (!$request->has('sort_type') && !$request->has('search')) {
        $query->orderBy('created_at', 'DESC');
    }

    $artwork = $query->get();

    return view('buyer.shopbuyer', compact('user', 'artwork', 'highlightsData'));
}
public function popart(Request $request)
{
    $user = Auth::user();
    $highlightsData = DB::table('highlights')->first(); 
    $query = Artworks::where('status', 'Approved')
                    ->where('category_id', 1);

    // Handle sorting by "For Sale" and "For Auction"
    if ($request->has('sort_type')) {
        $sortTypeOption = $request->sort_type;
        if ($sortTypeOption === 'for_sale') {
            $query->whereNull('start_date')->orderBy('id', 'ASC');
        } elseif ($sortTypeOption === 'for_auction') {
            // Prioritize "For Auction" sorting by 'start_price'
            $query->whereNotNull('start_date')->orderBy('id', 'ASC');
        }
    }

    // Handle search query
    if ($request->has('search')) {
        $searchQuery = $request->input('search');
        $query->where(function ($q) use ($searchQuery) {
            $q->where('title', 'like', '%' . $searchQuery . '%')
                ->orWhereHas('user', function ($u) use ($searchQuery) {
                    $u->where('name', 'like', '%' . $searchQuery . '%');
                });
        });
    }

    // Default sorting if no sorting options are provided
    if (!$request->has('sort_type') && !$request->has('search')) {
        $query->orderBy('created_at', 'DESC');
    }

    $artwork = $query->get();

    return view('buyer.popart', compact('user', 'artwork', 'highlightsData'));
}
public function realism(Request $request)
{
    $user = Auth::user();
    $highlightsData = DB::table('highlights')->first(); 
    $query = Artworks::where('status', 'Approved')
                    ->where('category_id', 2);

    // Handle sorting by "For Sale" and "For Auction"
    if ($request->has('sort_type')) {
        $sortTypeOption = $request->sort_type;
        if ($sortTypeOption === 'for_sale') {
            $query->whereNull('start_date')->orderBy('id', 'ASC');
        } elseif ($sortTypeOption === 'for_auction') {
            // Prioritize "For Auction" sorting by 'start_price'
            $query->whereNotNull('start_date')->orderBy('id', 'ASC');
        }
    }

    // Handle search query
    if ($request->has('search')) {
        $searchQuery = $request->input('search');
        $query->where(function ($q) use ($searchQuery) {
            $q->where('title', 'like', '%' . $searchQuery . '%')
                ->orWhereHas('user', function ($u) use ($searchQuery) {
                    $u->where('name', 'like', '%' . $searchQuery . '%');
                });
        });
    }

    // Default sorting if no sorting options are provided
    if (!$request->has('sort_type') && !$request->has('search')) {
        $query->orderBy('created_at', 'DESC');
    }

    $artwork = $query->get();

    return view('buyer.realism', compact('user', 'artwork', 'highlightsData'));
}
public function portrait(Request $request)
{
    $user = Auth::user();
    $highlightsData = DB::table('highlights')->first(); 
    $query = Artworks::where('status', 'Approved')
                    ->where('category_id', 3);

    // Handle sorting by "For Sale" and "For Auction"
    if ($request->has('sort_type')) {
        $sortTypeOption = $request->sort_type;
        if ($sortTypeOption === 'for_sale') {
            $query->whereNull('start_date')->orderBy('id', 'ASC');
        } elseif ($sortTypeOption === 'for_auction') {
            // Prioritize "For Auction" sorting by 'start_price'
            $query->whereNotNull('start_date')->orderBy('id', 'ASC');
        }
    }

    // Handle search query
    if ($request->has('search')) {
        $searchQuery = $request->input('search');
        $query->where(function ($q) use ($searchQuery) {
            $q->where('title', 'like', '%' . $searchQuery . '%')
                ->orWhereHas('user', function ($u) use ($searchQuery) {
                    $u->where('name', 'like', '%' . $searchQuery . '%');
                });
        });
    }

    // Default sorting if no sorting options are provided
    if (!$request->has('sort_type') && !$request->has('search')) {
        $query->orderBy('created_at', 'DESC');
    }

    $artwork = $query->get();

    return view('buyer.portrait', compact('user', 'artwork', 'highlightsData'));
}
public function abstract(Request $request)
{
    $user = Auth::user();
    $highlightsData = DB::table('highlights')->first(); 
    $query = Artworks::where('status', 'Approved')
                    ->where('category_id', 4);

    // Handle sorting by "For Sale" and "For Auction"
    if ($request->has('sort_type')) {
        $sortTypeOption = $request->sort_type;
        if ($sortTypeOption === 'for_sale') {
            $query->whereNull('start_date')->orderBy('id', 'ASC');
        } elseif ($sortTypeOption === 'for_auction') {
            // Prioritize "For Auction" sorting by 'start_price'
            $query->whereNotNull('start_date')->orderBy('id', 'ASC');
        }
    }

    // Handle search query
    if ($request->has('search')) {
        $searchQuery = $request->input('search');
        $query->where(function ($q) use ($searchQuery) {
            $q->where('title', 'like', '%' . $searchQuery . '%')
                ->orWhereHas('user', function ($u) use ($searchQuery) {
                    $u->where('name', 'like', '%' . $searchQuery . '%');
                });
        });
    }

    // Default sorting if no sorting options are provided
    if (!$request->has('sort_type') && !$request->has('search')) {
        $query->orderBy('created_at', 'DESC');
    }

    $artwork = $query->get();

    return view('buyer.abstract', compact('user', 'artwork', 'highlightsData'));
}
public function expressionism(Request $request)
{
    $user = Auth::user();
    $highlightsData = DB::table('highlights')->first(); 
    $query = Artworks::where('status', 'Approved')
                    ->where('category_id', 5);
    // Handle sorting by "For Sale" and "For Auction"
    if ($request->has('sort_type')) {
        $sortTypeOption = $request->sort_type;
        if ($sortTypeOption === 'for_sale') {
            $query->whereNull('start_date')->orderBy('id', 'ASC');
        } elseif ($sortTypeOption === 'for_auction') {
            // Prioritize "For Auction" sorting by 'start_price'
            $query->whereNotNull('start_date')->orderBy('id', 'ASC');
        }
    }

    // Handle search query
    if ($request->has('search')) {
        $searchQuery = $request->input('search');
        $query->where(function ($q) use ($searchQuery) {
            $q->where('title', 'like', '%' . $searchQuery . '%')
                ->orWhereHas('user', function ($u) use ($searchQuery) {
                    $u->where('name', 'like', '%' . $searchQuery . '%');
                });
        });
    }

    // Default sorting if no sorting options are provided
    if (!$request->has('sort_type') && !$request->has('search')) {
        $query->orderBy('created_at', 'DESC');
    }

    $artwork = $query->get();

    return view('buyer.expressionism', compact('user', 'artwork', 'highlightsData'));
}

public function impressionism(Request $request)
{
    $user = Auth::user();
    $highlightsData = DB::table('highlights')->first(); 
    $query = Artworks::where('status', 'Approved')
                    ->where('category_id', 6);
    // Handle sorting by "For Sale" and "For Auction"
    if ($request->has('sort_type')) {
        $sortTypeOption = $request->sort_type;
        if ($sortTypeOption === 'for_sale') {
            $query->whereNull('start_date')->orderBy('id', 'ASC');
        } elseif ($sortTypeOption === 'for_auction') {
            // Prioritize "For Auction" sorting by 'start_price'
            $query->whereNotNull('start_date')->orderBy('id', 'ASC');
        }
    }

    // Handle search query
    if ($request->has('search')) {
        $searchQuery = $request->input('search');
        $query->where(function ($q) use ($searchQuery) {
            $q->where('title', 'like', '%' . $searchQuery . '%')
                ->orWhereHas('user', function ($u) use ($searchQuery) {
                    $u->where('name', 'like', '%' . $searchQuery . '%');
                });
        });
    }

    // Default sorting if no sorting options are provided
    if (!$request->has('sort_type') && !$request->has('search')) {
        $query->orderBy('created_at', 'DESC');
    }

    $artwork = $query->get();

    return view('buyer.impressionism', compact('user', 'artwork', 'highlightsData'));
}

public function photorealism(Request $request)
{
    $user = Auth::user();
    $highlightsData = DB::table('highlights')->first(); 
    $query = Artworks::where('status', 'Approved')
                    ->where('category_id', 7);
    // Handle sorting by "For Sale" and "For Auction"
    if ($request->has('sort_type')) {
        $sortTypeOption = $request->sort_type;
        if ($sortTypeOption === 'for_sale') {
            $query->whereNull('start_date')->orderBy('id', 'ASC');
        } elseif ($sortTypeOption === 'for_auction') {
            // Prioritize "For Auction" sorting by 'start_price'
            $query->whereNotNull('start_date')->orderBy('id', 'ASC');
        }
    }

    // Handle search query
    if ($request->has('search')) {
        $searchQuery = $request->input('search');
        $query->where(function ($q) use ($searchQuery) {
            $q->where('title', 'like', '%' . $searchQuery . '%')
                ->orWhereHas('user', function ($u) use ($searchQuery) {
                    $u->where('name', 'like', '%' . $searchQuery . '%');
                });
        });
    }

    // Default sorting if no sorting options are provided
    if (!$request->has('sort_type') && !$request->has('search')) {
        $query->orderBy('created_at', 'DESC');
    }

    $artwork = $query->get();

    return view('buyer.photorealism', compact('user', 'artwork', 'highlightsData'));
}

    public function buyercart()
    {
        $user = Auth::user();

        return view('buyer.cart', compact('user'));
    }
    public function nav()
    {
        $user = Auth::user();

        return view('buyer.Nav', compact('user'));
    }
    public function buyersetting()
    {
        $user = Auth::user();

        return view('buyer.setting', compact('user'));
    }

public function addToCart(Request $request, $artworkId)
{
    // Retrieve artwork details based on $artworkId
    $artwork = Artworks::find($artworkId);

    // Check if the artwork is "For Sale" or "Auctioned"
    if ($artwork && in_array($artwork->status, ['For Sale', 'Auctioned'])) {
        // Add the artwork to the user's cart (you need to implement this logic)
        // Redirect back to the shop page or cart page
    } else {
        // Artwork is not available for purchase, handle accordingly (e.g., show error message)
    }
}

public function updateCart(Request $request, $artworkId)
{
    // Update the quantity or other details of the artwork in the cart
    // Save the updated cart state to the database or session
    // Redirect back to the cart page
}

public function removeFromCart($artworkId)
{
 // In removeFromCart method
return redirect()->route('cart')->with('success', 'Artwork removed from the cart successfully');

// In placeBid method
return redirect()->back()->with('success', 'Bid placed successfully!');
// or
return redirect()->back()->with('error', 'Failed to place bid. Please try again.');

    
}

    public function portfolio($id)
{
    $user = Auth::user();
    $artist = User::findOrFail($id); // Fetch the artist based on the provided $id
    $artwork = Artworks::where('users_id', $id)
        ->where(function ($query) {
            $query->where('status', 'Approved')
                ->orWhere('status', 'Sold');
        })
        ->orderBy('created_at', 'DESC')
        ->get();

    return view('buyer.portfolio', compact('artist', 'artwork', 'user'));
}
    

    public function buyerVerify()
    {
        return view('buyer.verify');
    }
    //verify
    public function artistVerify()
    {
        return view('artist.verify');
    }
    
    public function verifyupload(Request $request)
    {
        $request->validate([
            'identification'=> 'required',
            'selfie'=> 'required',
            'gcash'=> 'required',
            'firstname'=> 'required',
            'middlename'=> 'required',
            'lastname'=> 'required',
            'nationality'=> 'required',
            'birthday'=> 'required',
            'address'=> 'required',
            'users_id'=> 'required',
            'IDType'=> 'required',
            'status'=> 'required',
            'remarks' => 'required', 
            
        ]);
    
        $user = Auth::user();
        
        $allowedFileTypes = ['jpg', 'jpeg', 'png'];
        $maxFileSize = 1024 * 1024; // 1MB
    
        // Initialize an array to store file paths (if needed).
        $uploadedFilePaths = [];
    
        foreach (['image1', 'image2', 'image3'] as $inputName) {
            if ($request->hasFile($inputName)) {
                $image = $request->file($inputName);
    
                $extension = $image->getClientOriginalExtension();
    
                if (!in_array($extension, $allowedFileTypes)) {
                    return redirect()->back()->withErrors([$inputName => 'Invalid image file type. Please upload a jpg, jpeg, or png file.']);
                }
    
                $fileSize = $image->getSize();
    
                if ($fileSize > $maxFileSize) {
                    return redirect()->back()->withErrors([$inputName => 'The image file size must be less than 1MB.']);
                }
    
                $filename = time() . '_' . $inputName . '.' . $extension;
                $image->move(public_path('images'), $filename);
    
                // Optionally, you can store the file paths in an array.
                $uploadedFilePaths[] = 'images/' . $filename;
            }
         }
    
        // Optionally, you can save the file paths to a database or perform other actions.
    
         // Redirect or return a response as needed.
     return redirect()->to('profile')->with('success', 'Profile updated successfully!');
    }


    public function editProfilePicture()
    {
        $user = Auth::user();
        return view('buyer.editprofilepicture', compact('user'));
    }
    

    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:1024', 
        ]);
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
    
            $allowedFileTypes = ['jpg', 'jpeg', 'png'];
            $maxFileSize = 1024 * 1024; 
    
            $extension = $image->getClientOriginalExtension();
    
            if (!in_array($extension, $allowedFileTypes)) {
                return redirect()->back()->withErrors(['image' => 'Invalid image file type. Please upload a jpg, jpeg, or png file.']);
            }
    
            if ($image->getSize() > $maxFileSize) {
                return redirect()->back()->withErrors(['image' => 'The image file size must be less than 1MB.']);
            }
    
            // Generate a unique filename for the image
            $filename = time() . '.' . $extension;
    
            // Store the image in the public storage directory
            $image->move(public_path('images'), $filename);
    
            // Update the user's image URL in the database
            Auth::user()->update([
                'image' => $filename, // Save only the filename without the path
            ]);
            
            return redirect()->route('buyer.settings')->with('success', 'Profile picture updated successfully!');
        }
    
        return redirect()->back()->withErrors(['image' => 'Failed to update profile picture. Please try again.']);
    }
    public function sendMessageToArtist(Request $request, $id)
{
    $artwork = Artworks::findOrFail($id);

    if (!$artwork) {
        return redirect()->back()->with('error', 'Artwork not found.');
    }

    $attachment = $artwork->image;
    $artworkTitle = $artwork->title;
    $artworkPrice = $artwork->price;

    $sender = auth()->user(); 

    $artistId = $artwork->user->id;
    
        $message = Chatify::newMessage([
            'from_id' => $sender->id,
            'to_id' => $artistId, // Use the artist's ID as the recipient
            'body' => "Hello! I'm interested in buying your artwork,'$artworkTitle' with a price of ₱$artworkPrice. Is it still available?",
            'attachment' => ($attachment) ? json_encode((object)[
                'new_name' => $attachment,
                'old_name' => htmlentities(trim($attachment), ENT_QUOTES, 'UTF-8'),
            ]) : null,
        ]);
    $messageData = Chatify::parseMessage($message);
    if (Auth::user()->id != $request['id']) {
        Chatify::push("private-chatify.".$request['id'], 'messaging', [
            'from_id' => Auth::user()->id,
            'to_id' => $request['id'],
            'message' => Chatify::messageCard($messageData, true)
        ]);
    }
    // Construct the URL
    $chatifyUrl = url('chatify/' . $artwork->user->id);

    // Redirect the user to the URL immediately
    return redirect()->to($chatifyUrl);
}
public function sendGCashImage(Request $request, $id)
{
    $verificationRequest = Verify::findOrFail($id);

    if (!$verificationRequest) {
        return redirect()->back()->with('error', 'Verification request not found.');
    }

    $attachment = $verificationRequest->gcash_image;
    $gcashTitle = $verificationRequest->title;

    $sender = auth()->user();

    $artistId = $verificationRequest->user->id;

    $message = Chatify::newMessage([
        'from_id' => $sender->id,
        'to_id' => $artistId,
        'body' => "Hello! I've uploaded my GCash image for verification. Please review it.",
        'attachment' => ($attachment) ? json_encode((object)[
            'new_name' => $attachment,
            'old_name' => htmlentities(trim($attachment), ENT_QUOTES, 'UTF-8'),
        ]) : null,
    ]);

    $messageData = Chatify::parseMessage($message);

    if (Auth::user()->id != $request['id']) {
        Chatify::push("private-chatify." . $request['id'], 'messaging', [
            'from_id' => Auth::user()->id,
            'to_id' => $request['id'],
            'message' => Chatify::messageCard($messageData, true),
        ]);
    }
    return back();
}


}



    
    // $message = Chatify::newMessage([
    //     'from_id' => Auth::user()->id,
    //     'to_id' => $request['id'],
    //     'body' => htmlentities(trim($request['message']), ENT_QUOTES, 'UTF-8'),
    //     'attachment' => ($attachment) ? json_encode((object)[
    //         'new_name' => $attachment,
    //         'old_name' => htmlentities(trim($attachment_title), ENT_QUOTES, 'UTF-8'),
    //     ]) : null,
    // ]);
    
    