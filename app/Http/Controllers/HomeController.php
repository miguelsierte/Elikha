<?php
 
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Artworks;
use App\Models\Category;
use App\Models\Ticket;
 
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $users = User::count();
        $categories = Category::withCount('artworks')
                    ->orderBy('artworks_count', 'desc')
                    ->get();
        return view('admin.dashboard', compact('users', 'categories'));
    }
    public function subscribers()
    {
        $artist = User::where('role','2')->count();
        $buyer = User::where('role','3')->count();
        $data = DB::table('users')
        ->select(DB::raw('MONTH(created_at) as month'), 'role', DB::raw('count(*) as total'))
        ->where('role', '>=', 2)
        ->where('role', '<=', 3)
        ->groupBy('month', 'role')
        ->get();
        
        $total = $artist + $buyer;
        $artistPercentage = ($artist / $total) * 100;
        $buyerPercentage = ($buyer / $total) * 100;
        $artistPercentage = number_format($artistPercentage, 2);
        $buyerPercentage = number_format($buyerPercentage, 2);

    // Initialize arrays to hold the data for each role
    $artistData = array_fill(0, 12, 0);
    $buyerData = array_fill(0, 12, 0);

    // Loop through the data and populate the arrays
    foreach ($data as $row) {
        $monthIndex = $row->month - 1; // Convert month number to zero-based index
        if ($row->role == 2) {
            $artistData[$monthIndex] = $row->total;
        } elseif ($row->role == 3) {
            $buyerData[$monthIndex] = $row->total;
        }
    }

    // Pass the data to the view
    return view('admin.subscribers', compact('artistData', 'buyerData', 'artist', 'buyer', 'artistPercentage', 'buyerPercentage', 'total'));
    }
    
    public function posts()
    {
        $pendingPost = Artworks::where('status','0')->count();
        $approvedPost = Artworks::where('status','1')->count();
        $pendingArtworks = Artworks::where('status', false)->paginate(5);
        return view('admin.posts', compact('pendingPost', 'approvedPost','pendingArtworks'));
    }
    public function approve(Request $request, $id)
    {
        $artwork = Artworks::findOrFail($id);
        $artwork->status = true;
        $artwork->save();
        return back()->with('success', 'Artwork approved successfully.');
    }
    
    public function reject(Request $request)
    {
        $id = $request->input('id');
        $artwork = Artworks::findOrFail($id);
        $artwork->delete();
        return back()->with('delete', 'Artwork rejected.');
    }
    public function approvePosts()
    {
        $pendingPost = Artworks::where('status','0')->count();
        $approvedPost = Artworks::where('status','1')->count();
        $approved_artwork = Artworks::where('status', true)->get();
        return view('admin.approvePosts', compact('pendingPost', 'approvedPost','approved_artwork'));
    }
    public function support()
    {
        $pendingTicket = Ticket::where('status','0')->count();
        $closedTicket = Ticket::where('status','1')->count();
        $pendingTickets = Ticket::where('status', false)->paginate(5);
        return view('admin.support', compact('pendingTicket', 'closedTicket', 'pendingTickets'));
    }
    public function close(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->status = true;
        $ticket->save();
        return back()->with('success', 'Ticket has been closed');
    }
    public function supportClosed()
    {
        $pendingTicket = Ticket::where('status','0')->count();
        $closedTicket = Ticket::where('status','1')->count();
        $closedTickets = Ticket::where('status', true)->paginate(5);
        return view('admin.supportClosed', compact('pendingTicket', 'closedTicket', 'closedTickets'));
    }
    public function accountsetting()
    {
        return view('admin.accountsetting');
    }
    public function updateSetting(Request $request)
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

    public function assistant()
    {
        $users = User::count();
        $categories = Category::withCount('artworks')
                    ->orderBy('artworks_count', 'desc')
                    ->get();
        return view('assistant.dashboard', compact('users', 'categories'));
    }
    public function assistsubscribers()
    {
        $artist = User::where('role','2')->count();
        $buyer = User::where('role','3')->count();
        $data = DB::table('users')
        ->select(DB::raw('MONTH(created_at) as month'), 'role', DB::raw('count(*) as total'))
        ->where('role', '>=', 2)
        ->where('role', '<=', 3)
        ->groupBy('month', 'role')
        ->get();
        
        $total = $artist + $buyer;
        $artistPercentage = ($artist / $total) * 100;
        $buyerPercentage = ($buyer / $total) * 100;
        $artistPercentage = number_format($artistPercentage, 2);
        $buyerPercentage = number_format($buyerPercentage, 2);

    // Initialize arrays to hold the data for each role
    $artistData = array_fill(0, 12, 0);
    $buyerData = array_fill(0, 12, 0);

    // Loop through the data and populate the arrays
    foreach ($data as $row) {
        $monthIndex = $row->month - 1; // Convert month number to zero-based index
        if ($row->role == 2) {
            $artistData[$monthIndex] = $row->total;
        } elseif ($row->role == 3) {
            $buyerData[$monthIndex] = $row->total;
        }
    }

    // Pass the data to the view
        return view('assistant.subscribers', compact('artistData', 'buyerData', 'artist', 'buyer', 'artistPercentage', 'buyerPercentage', 'total'));
    }
    public function assistsupport()
    {
        return view('assistant.support');
    }
    public function assistaccountsetting()
    {
        return view('assistant.accountsetting');
    }
    public function updateassistSetting(Request $request)
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
public function assistposts()
    {
        $pendingPost = Artworks::where('status','0')->count();
        $approvedPost = Artworks::where('status','1')->count();
        $pendingArtworks = Artworks::where('status', false)->paginate(5);
        return view('assistant.posts', compact('pendingPost', 'approvedPost','pendingArtworks'));
    }
    public function assistapprovePosts()
    {
        $pendingPost = Artworks::where('status','0')->count();
        $approvedPost = Artworks::where('status','1')->count();
        $approved_artwork = Artworks::where('status', true)->get();
        return view('assistant.approvedPosts', compact('pendingPost', 'approvedPost','approved_artwork'));
    }
}