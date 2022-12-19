<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Models\User;
use App\Models\UserWallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Carbon\Carbon;

class FacebookController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
           
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleFacebookCallback()
    {
        try {
        
            $user = Socialite::driver('facebook')->stateless()->user();
         
            $finduser = User::where('facebook_id', $user->id)->first();
         
            if($finduser){
         
                Auth::login($finduser);
       
                return redirect()->intended('user/dashboard');
         
            }else{

                $newUser = new User;
                $newUser->user_type = 'freelancer';
                $newUser->name = $user->name;
                $newUser->email = $user->email;
                $newUser->email_verified_at = Carbon::now();
                $newUser->facebook_id = $user->id;
                $newUser->password = encrypt('facebook123456dummy');
                $newUser->refer_code = uniqid().time();
                $newUser->save();

                $UserWallet = new UserWallet;
                $UserWallet->user_id = $newUser->id;
                $UserWallet->save();
        
                Auth::login($newUser);
        
                return redirect()->intended('user/dashboard');
            }
       
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
