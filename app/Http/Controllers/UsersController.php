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
                        ->where('status', true)
                        ->orderBy('created_at', 'DESC')
                        ->get();
    return view('portfolio.profile', compact('user','artwork'));
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
            'mobile' => 'required',
            'bio' => 'required',
            'facebook' => 'required|url',
            'instagram' => 'required|url',
            'twitter' => 'required|url'
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
            return view('artist.home');
    }
    public function artistAuction()
    {
        $artwork = Artworks::where('users_id', Auth::id())
                        ->where('status', true)
                        ->orderBy('created_at', 'DESC')
                        ->get();
        return view('artist.myauctions', compact('artwork'));
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
        'name' => 'required',
        'title' => 'required',
        'description' => 'required',
    ]);
    $ticket = Ticket::create([
        'name' => $validatedData['name'],
        'title' => $validatedData['title'],
        'description' => $validatedData['description'],
        'users_id' => Auth::id(),
        'status' => false,
        
    ]);

    return back()->with('success', 'Ticket created successfully!');
}
    public function buyer()
    {
        return view('users.buyer');
    }
    
}
