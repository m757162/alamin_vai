<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Models\User;
use App\Models\UserWallet;
use App\Models\ClientWallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Cookie;
use Session;

class AuthController extends Controller
{
    public function register()
    {
        return view('frontend.pages.auth.register');
    }

    public function register_action(Request $request)
    {        
        $validated = $request->validate([
            'name' => 'required',
            'user_type' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);
        
        $request['password'] = bcrypt($request->password);
        $request['refer_code'] = uniqid().time();
        

        if(Session::get('refer') != null){
            $refer_user = User::where('refer_code', Session::get('refer'))->first();
            
            $request['referral_id'] = $refer_user->id;
            $request['total_refer_claim'] += 1;

            $refer_user->total_refers += 1; 
            $refer_user->total_refer_claim += 1; 
            $refer_user->save();
        }

        $user = User::create($request->all());
        
        //Refer

        if(self::login($user)){

            if($request->user_type == 'client'){
                ClientWallet::create([
                    'client_id' => $user->id,
                ]);
            }else{
                UserWallet::create([
                    'user_id' => $user->id,
                ]);
            }
            
            toastr()->success('Logged in!', 'Authentication', ['timeOut' => 5000]);
            return redirect()->intended('user/dashboard');
        }

        toastr()->warning('Registration successfull!!', 'Authentication', ['timeOut' => 5000]);
        return redirect()->route('user.login');
        
    }

    private function login($user)
    {
        Auth::guard('web')->login($user);
        return true;
    }

    public function login_form()
    {       
       return view('frontend.pages.auth.login');
    }

    public function login_action(Request $request)
    {
        $validated = $request->validate([          
            'email' => 'required|email',
            'password' => 'required',
        ]);
   
        if(Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])){
            $request->session()->regenerate();

            toastr()->success('Logged in!', 'Authentication', ['timeOut' => 5000]);
            return redirect()->intended('user/dashboard');
        }

        toastr()->warning('Invalid credentials!', 'Authentication', ['timeOut' => 5000]);
        return redirect()->route('user.login');

    }
    
    
    //End
}
