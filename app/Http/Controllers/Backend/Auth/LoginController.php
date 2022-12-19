<?php

namespace App\Http\Controllers\Backend\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('backend.pages.auth.login');
    }

    public function login_action(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if(Auth::guard('admin')->attempt($credentials, $request->remember)){
            toastr()->success('Logged in success!', 'Login', ['timeOut' => 5000]);
            return redirect()->intended('/admin');
        }else{
            toastr()->warning('Invalid credentials!', 'Login', ['timeOut' => 5000]);
            return back();
        }

    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        toastr()->success('Logout success!', 'Login', ['timeOut' => 5000]);
        return redirect()->route('admin.login');
    }
    
    //End
}
