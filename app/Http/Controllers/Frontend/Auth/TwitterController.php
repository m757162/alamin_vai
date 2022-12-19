<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Models\User;
use App\Models\UserWallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Carbon\Carbon;

class TwitterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }
          
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleTwitterCallback()
    {
        try {
        
            $user = Socialite::driver('twitter')->user();
         
            $finduser = User::where('twitter_id', $user->id)->first();
         
            if($finduser){
         
                Auth::login($finduser);
        
                return redirect()->intended('user/dashboard');
         
            }else{

                $newUser = new User;
                $newUser->user_type = 'freelancer';
                $newUser->name = $user->name;
                $newUser->email_verified_at = Carbon::now();
                $newUser->twitter_id = $user->id;
                $newUser->password = encrypt('twitter123456dummy');
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
