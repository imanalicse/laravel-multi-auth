<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest:admin');
    }

    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request){
                
        $this->validate($request, [
            'email' => 'required|email',            
            'password' => 'required|min:6',            
        ]);
        // Attempt to log the user
        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){
            return redirect()->intended('admin');
        }

        // If unsuccesfull, then redirect back to the login with the form data
        return redirect()->back()->with($reqquest->only('email', 'remember'));    
    }
}
