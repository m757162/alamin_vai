<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Models\User;
use App\Models\UserWallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
// use Illuminate\Foundation\Auth\ThrottlesLogins;
// use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class LinkedinController extends Controller
{
    // use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo = '/';


    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }


    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }


    public function redirectToLinkedin()
    {
        return Socialite::driver('linkedin')->redirect();
    }


    public function handleLinkedinCallback()
    {
        try {
            $user = Socialite::driver('linkedin')->user();

            $finduser = User::where('linkedin_id', $user->id)->first();

            if($finduser){
                Auth::login($finduser);
      
                return redirect()->intended('user/dashboard');

            }else{

                $newUser = new User;
                $newUser->user_type = 'freelancer';
                $newUser->name = $user->name;
                $newUser->email = $user->email;
                $newUser->email_verified_at = Carbon::now();
                $newUser->linkedin_id = $user->id;
                $newUser->password = encrypt('linkedin123456dummy');
                $newUser->refer_code = uniqid().time();
                $newUser->save();

                $UserWallet = new UserWallet;
                $UserWallet->user_id = $newUser->id;
                $UserWallet->save();

                Auth::login($newUser);

                return redirect()->intended('user/dashboard');
            }
            
        } catch (\Exception $e) {
            dd($e->getMessage(), $e->getLine());

            return redirect('auth/linkedin');
        }
    }
}
