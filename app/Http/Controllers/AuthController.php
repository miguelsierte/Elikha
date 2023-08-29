<?php
 
namespace App\Http\Controllers;
 
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\HomeController;
 
class AuthController extends Controller
{
    function signup(){
        $title = "Sign Up";
        return view('users.signup', compact('title'));
    }

    public function signupPost(Request $request)
    {
        $user = new User();
 
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
 
        $user->save();
 
        return back()->with('success', 'Register successfully');
    }

    function userslogin()
    {
        $title = "Login";
        return view('users.login', compact('title'));
    }
    public function usersloginPost(Request $request)
    {
        $input = $request->all();
       
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
       
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            if (auth()->user()->role == 'Buyer') 
            {
                return redirect()->intended('/buyer');
            }
            else if (auth()->user()->role == 'Artist') 
            {
                return redirect()->intended('/artistHome');
            }
            else if (auth()->user()->role == 'Assistant admin') 
            {
                return redirect()->intended('/assistant');
            }
            else if (auth()->user()->role == 'Admin') 
            {
                return redirect()->intended('/dashboard');
            }
        }
        return back()->with('error', 'Error Email or Password');
    }
    public function login()
    {
        return view('admin.login');
    }
 
    public function loginPost(Request $request)
    {
        $input = $request->all();
       
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
       
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            if (auth()->user()->role == 'Buyer') 
            {
                return redirect()->intended('/buyer');
            }
            else if (auth()->user()->role == 'Artist') 
            {
                return redirect()->intended('/artistHome');
            }
            else if (auth()->user()->role == 'Assistant admin') 
            {
                return redirect()->intended('/assistant');
            }
            else if (auth()->user()->role == 'Admin') 
            {
                return redirect()->intended('/dashboard');
            }
        }
    
        return back()->with('error', 'Error Email or Password');
    }
 
    public function logout()
    {
        Auth::logout();
 
        return redirect()->intended('/');
    }

    public function logouts()
    {
        Auth::logout();
 
        return redirect()->intended('/userslogin');
    }
}