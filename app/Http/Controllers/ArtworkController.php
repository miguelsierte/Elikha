<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artworks;
use Illuminate\Support\Facades\Auth;

class ArtworkController extends Controller
{
    public function postitem()
    {
        return view('portfolio.postitem');
    }
    public function store(Request $request)
    {
    // Validate the input data
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:6048',
        'dimension' => 'required|string|max:255',
        'start_price' => 'nullable|numeric',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date',
        'category_id' => 'required|exists:category,id'
    ]);

    if ($image = $request->file('image')) {
        $destinationPath = 'artworks/';
        $artworkImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        $image->move($destinationPath, $artworkImage);
        $input['image'] = "$artworkImage";
    }
    $artwork = Artworks::create([
        'title' => $validatedData['title'],
        'description' => $validatedData['description'],
        'image' => $artworkImage,
        'dimension' => $validatedData['dimension'],
        'start_price' => $validatedData['start_price'],
        'start_date' => $validatedData['start_date'],
        'end_date' => $validatedData['end_date'],
        'users_id' => Auth::id(),
        'category_id' => $validatedData['category_id'],
        'status' => false,
        
    ]);

    // Redirect to the artwork page
    return redirect()->to('profile')->with('success', 'Your artwork will be reviewed by our team before it is uploaded. Thank you for your patience!');;
    }
    
    public function forsale()
    {
        return view('portfolio.forsale');
    }

    public function forsalePost(Request $request)
    {
    // Validate the input data
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:6048',
        'dimension' => 'required|string|max:255',
        'price' => 'nullable|numeric',
        'category_id' => 'required|exists:category,id'
    ]);

    if ($image = $request->file('image')) {
        $destinationPath = 'artworks/';
        $artworkImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        $image->move($destinationPath, $artworkImage);
        $input['image'] = "$artworkImage";
    }
    $artwork = Artworks::create([
        'title' => $validatedData['title'],
        'description' => $validatedData['description'],
        'image' => $artworkImage,
        'dimension' => $validatedData['dimension'],
        'price' => $validatedData['price'],
        'users_id' => Auth::id(),
        'category_id' => $validatedData['category_id']
        
    ]);

    // Redirect to the artwork page
    return redirect()->to('profile')->with('success', 'Your artwork will be reviewed by our team before it is uploaded. Thank you for your patience!');
    }
    

}
