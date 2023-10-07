<?php
 
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Artworks;
use App\Models\Category;
use App\Models\Ticket;
use App\Notifications\ArtworkRejected;
use Illuminate\Support\Facades\Mail;
use App\Mail\ArtworkRejectedMail;
use App\Mail\ArtworkApprovedMail;
use App\Mail\ArtistApproved;
use App\Mail\ArtistRejected;
use App\Models\Verify;
use Illuminate\Support\Facades\Storage;


class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $sold = Artworks::where('status', 'Sold')->count();
        $arts = Artworks::where('status', 'Approved')->count();
        $categories = Category::withCount(['artworks' => function ($query) {
            $query->where('status', 'Approved');
        }])
                    ->orderBy('artworks_count', 'desc')
                    ->get();
        return view('admin.dashboard', compact('arts', 'categories', 'sold'));
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
    public function verifyartists(Request $request)
    {

        $verified = Verify::where('status', 'Approved')->count();
        $pending = Verify::where('status', 'Pending')->count();
        $query = DB::table('verification_requests')
        ->select('verification_requests.*', 'idtypes.IDType as IDType')
        ->leftJoin('idtypes', 'verification_requests.idtype_id', '=', 'idtypes.id');
        
        if ($request->has('status_filter')) {
            $statusFilter = $request->input('status_filter');
            if ($statusFilter !== 'all') {
                $query->where('verification_requests.status', $statusFilter);
            }
        }
        $verify = $query->paginate(5);
        
        return view('admin.verify', compact('verified', 'verify', 'pending'));
    }
    public function approveartists(Request $request, $id)
{
    $artist = Verify::findOrFail($id);

    $artistUserId = $artist->users_id;

    $artistUser = User::findOrFail($artistUserId);

    $artistEmail = $artistUser->email;

    Mail::to($artistEmail)->send(new ArtistApproved($artist));

    $artist->status = 'Approved';
    
    $artist->save();

    return back()->with('success', 'Artist verified successfully.');
}

    public function rejectartists(Request $request)
{
    $id = $request->input('id');
    $artist = Verify::findOrFail($id);
    $remarks = $request->input('remarks');

    $artistUserId = $artist->users_id;

    $artistUser = User::findOrFail($artistUserId);

    $artistEmail = $artistUser->email;

    Mail::to($artistEmail)->send(new ArtistRejected($remarks, $artist));

    $artist->status = 'Rejected';
    $artist->remarks = $remarks;
    $artist->save();

    return back()->with('reject', 'Artist verification rejected.');
}
    public function posts(Request $request)
{
    $pendingPost = Artworks::where('status', 'Pending')->count();
    $approvedPost = Artworks::where('status', 'Approved')->count();
    
    $query = Artworks::leftJoin('category', 'artworks.category_id', '=', 'category.id')
    ->leftJoin('users', 'artworks.users_id', '=', 'users.id')
    ->select('artworks.*', 'category.Category', 'users.name as artist_name');

    if ($request->has('status_filter')) {
        $statusFilter = $request->input('status_filter');
        if ($statusFilter !== 'all') {
            $query->where('artworks.status', $statusFilter);
        }
    }
    
    if ($request->has('search')) {
        $searchTerm = $request->input('search');
        $query->where(function ($query) use ($searchTerm) {
            $query->where('artworks.title', 'like', '%' . $searchTerm . '%')
                ->orWhere('category.Category', 'like', '%' . $searchTerm . '%')
                ->orWhere('users.name', 'like', '%' . $searchTerm . '%');
        });
    }
    
    $artworks = $query->paginate(5);
    
    return view('admin.posts', compact('pendingPost', 'approvedPost', 'artworks'));
}

    public function approve(Request $request, $id)
    {

        $artwork = Artworks::findOrFail($id);

$artistUserId = $artwork->users_id;

    $artistEmail = User::findOrFail($artistUserId)->email;

    Mail::to($artistEmail)->send(new ArtworkApprovedMail($artwork));


        $artwork->status = 'Approved';
        $artwork->save();
        return back()->with('success', 'Artwork approved successfully.');
    }
    
    public function reject(Request $request)
{
    $id = $request->input('id');
    $artwork = Artworks::findOrFail($id);
$remarks = $request->input('remarks');

$artistUserId = $artwork->users_id;

    $artistEmail = User::findOrFail($artistUserId)->email;

    Mail::to($artistEmail)->send(new ArtworkRejectedMail($remarks, $artwork));


$artwork->status = 'rejected';
$artwork->remarks = $remarks;
$artwork->save();

return back()->with('reject', 'Artwork rejected with remarks.');
}
public function highlights()
    {
        $highlightsData = DB::table('highlights')->first(); // Assuming there's only one set of highlights

        return view('admin.highlights', compact('highlightsData'));
    }

    public function highlightsstore(Request $request)
{
    // Validate the request
    $request->validate([
        'highlight1' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'highlight2' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'highlight3' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Define the path for storing images
    $imagePath = 'public/images';

    // Initialize an array to store the paths of the uploaded images
    $highlightPaths = [];

    // Loop through and upload each image
    foreach (['highlight1', 'highlight2', 'highlight3'] as $highlightField) {
        if ($request->hasFile($highlightField)) {
            $image = $request->file($highlightField);

            // Generate a unique filename
            $filename = time() . '_' . $image->getClientOriginalName();

            // Store the image in the specified directory
            $image->storeAs($imagePath, $filename);

            // Add the image path to the array
            $highlightPaths[$highlightField] = $filename;
        }
    }

    // Retrieve the existing highlights
    $existingHighlights = DB::table('highlights')->first(); // Assuming there's only one set of highlights

    if ($existingHighlights) {
        // Delete the old images if they exist
        foreach (['highlight1', 'highlight2', 'highlight3'] as $highlightField) {
            if (isset($highlightPaths[$highlightField])) {
                Storage::delete($imagePath . '/' . $existingHighlights->$highlightField);
            }
        }

        // Update the existing record with the new image paths
        DB::table('highlights')
            ->where('id', $existingHighlights->id)
            ->update($highlightPaths);
    } else {
        // Insert a new record with the new image paths
        DB::table('highlights')->insert($highlightPaths);
    }

    // Redirect back with a success message
    return back()->with('success', 'Highlights uploaded successfully.');
}

    public function support()
    {
        $pendingTicketCount = Ticket::where('status','0')->count();
        $closedTicketCount = Ticket::where('status','1')->count();
        $pendingTicket = Ticket::where('status', '0')->paginate(10);
        return view('admin.support', compact('pendingTicket', 'pendingTicketCount', 'closedTicketCount'));
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
        $pendingTicketCount = Ticket::where('status','0')->count();
        $closedTicketCount = Ticket::where('status','1')->count();
        $closedTicket = Ticket::where('status', '1')->paginate(10);
        return view('admin.supportClosed', compact('closedTicket', 'pendingTicketCount', 'closedTicketCount'));
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
