<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Carbon\Carbon;
use App\Models\UserWallet;

class GoogleController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
        
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
      
            $user = Socialite::driver('google')->user();
       
            $finduser = User::where('google_id', $user->id)->first();
            
            if($finduser){
       
                Auth::login($finduser);
      
                return redirect()->intended('user/dashboard');
       
            }else{

                $newUser = new User;
                $newUser->user_type = 'freelancer';
                $newUser->name = $user->name;
                $newUser->email = $user->email;
                $newUser->email_verified_at = Carbon::now();
                $newUser->google_id = $user->id;
                $newUser->password = encrypt('google123456dummy');
                $newUser->refer_code = uniqid().time();
                $newUser->save();

                $UserWallet = new UserWallet;
                $UserWallet->user_id = $newUser->id;
                $UserWallet->save();
      
                Auth::login($newUser);
      
                return redirect()->intended('user/dashboard');
            }
      
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
