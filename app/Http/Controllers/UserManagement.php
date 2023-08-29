<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserManagement extends Controller
{
    public function usermanagement(Request $request)
{
    $search = $request->input('search');
    $role_filter = $request->input('role_filter');

    if ($role_filter === null || $role_filter == -1) {
        $users = User::where('name', 'LIKE', "%$search%")
                    ->orWhere('email', 'LIKE', "%$search%")
                    ->paginate(8);
    } else {
        $users = User::where('role', $role_filter)
                    ->where(function ($query) use ($search) {
                        $query->where('name', 'LIKE', "%$search%")
                              ->orWhere('email', 'LIKE', "%$search%");
                    })
                    ->paginate(8);
    }

    return view('admin.usermanagement')->with('users', $users);
}
    public function create()
    {
        return view('admin.create');
    }
    public function createPost(Request $request)
    {
        $user = new User();
 
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->mobile = $request->mobile;
        $user->role = $request->role;
 
        $user->save();
 
        return redirect()->to('usermanagement')->with('success', 'Admin added successfully!');
    }

    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.show', compact('user'));
    }
    
    public function search(Request $request)
{
    $search = $request->input('search');
    $users = User::where('name', 'LIKE', "%$search%")
                ->orWhere('email', 'LIKE', "%$search%")
                ->orWhere('role', 'LIKE', "%$search%")
                ->paginate(8);
    return view('admin.usermanagement')->with('users', $users);
}
  
    public function destroy(string $id): RedirectResponse
    {
        User::destroy($id);
        return back()->with('delete', 'Admin deleted successfully!'); 
    }
}
