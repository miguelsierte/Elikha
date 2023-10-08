<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Verify;


class VerifyController extends Controller
{
    public function show($id)
{
    $verifies = Verify::findOrFail($id); // Replace 'findOrFail' with your preferred method for fetching data
    return view('verification.show', compact('verifies'));
}
    public function artistVerify()
    {
        return view('artist.verify');
    }
    public function verifstore(Request $request)
{
   // Debugging - Log the incoming request data
   \Log::info($request->all());

   // Rest of your code

   
    // Validate the input data, including file uploads
    $validatedData = $request->validate([
        'identification' => 'required|file|image|mimes:jpeg,png,jpg,gif,svg|max:6048',
        'selfie' => 'required|file|image|mimes:jpeg,png,jpg,gif,svg|max:6048',
        'gcash' => 'required|file|image|mimes:jpeg,png,jpg,gif,svg|max:6048',
        'firstname' => 'required|string|max:255',
        'middlename' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'nationality' => 'required|string|max:255',
        'birthday' => 'required|date',
        'address' => 'required|string|max:255',
        'users_id' => 'required|exists:users,id',
        'idtype_id' => 'required|exists:idtypes,id',
        'age' => 'required|integer', // Add age field validation
        'phonenumber' => 'required|string', // Add phonenumber field validation
        'gender_id' => 'required|in:Male,Female'
    ]);

    $uploadedImagePaths = [];

    // Loop through the three image inputs (e.g., 'identification', 'selfie', 'gcash')
    foreach (['identification', 'selfie', 'gcash'] as $inputName) {
        if ($image = $request->file($inputName)) {
            if ($image->isValid()) {
                $destinationPath = 'verify/';
                $idImage = date('YmdHis') . "_" . $inputName . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $idImage);
                $uploadedImagePaths[] = $destinationPath . $idImage;
            } else {
                // Handle the case where the image is not valid
                return redirect()->back()->withInput()->withErrors(['error' => 'Invalid image file.']);
            }
        } else {
            // Handle the case where the image is missing
            return redirect()->back()->withInput()->withErrors(['error' => 'Image file not found.']);
        }
    }

    // After successfully uploading images, create a Verify record
    $verify = Verify::create([
        'identification' => $uploadedImagePaths[0],
        'selfie' => $uploadedImagePaths[1],
        'gcash' => $uploadedImagePaths[2],
        'firstname' => $request->input('firstname'),
        'middlename' => $request->input('middlename'),
        'lastname' => $request->input('lastname'),
        'nationality' => $request->input('nationality'),
        'birthday' => $request->input('birthday'),
        'address' => $request->input('address'),
        'age' => $request->input('age'),
        'phonenumber' => $request->input('phonenumber'),
        'users_id' => Auth::id(),
        'gender_id' => $request->input('gender_id'), // Add 'gender_id'
        'idtype_id' => $request->input('idtype_id'), // Updated 'IDType' to 'idtype_id'
        'status' => 'pending',
        'remarks' => '',   // Empty remarks initially
    ]);
// Debugging - Log the created Verify model instance
\Log::info($verify);
    // Redirect to the Settings page
    return redirect()->to('artistSettings')->with('success', 'Your verification will be reviewed by our team. Thank you for your patience!');
    }

    
      
}
