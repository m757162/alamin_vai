<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\Helper;
use App\Models\Gig;
use App\Models\Hire;
use App\Models\Order;
use App\Models\User;
use App\Models\Skill;
use App\Models\Certificate;
use App\Models\Social;
use App\Models\UserWallet;
use App\Models\ClientWallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerification;
use Hash;
use Carbon\Carbon;

class ProfileController extends Controller
{
    use Helper;

    public function email_verify()
    {
        return view('frontend.pages.auth.email_verify');
    }

    public function email_verification()
    {
        $user = User::find(Auth::guard('web')->user()->id);      
            
        try{
            if($user->email_verified_at != null){            
                return redirect()->route('user.dashboard');
            }else{
                
                //Send verification link
                Mail::to($user->email)
                ->queue(new EmailVerification($user->id));
                
                toastr()->success('Send a vefication email. Check your inbox!', 'Verification', ['timeOut' => 5000]);
                return back();
            }

        }catch(\Exception $e){
            dd($e->getMessage(), $e->getLine());
        }            
        
    }

    public function email_verification_callback($id)
    {
        $user = User::find($id);
        $user->email_verified_at = Carbon::now();
        $user->save();

        toastr()->success('Email verification successfull!', 'Verification', ['timeOut' => 5000]);
        return redirect()->route('user.dashboard');
    }

    public function profile()
    {                
        if(Auth::guard('web')->user()->user_type == 'freelancer'){
                        
            $skills = Skill::find(Auth::guard('web')->user()->id);
            if($skills != NULL){
                $data['skills'] = explode(',', $skills->skills);
            }else{
                $data['skills'] = [];
            }

            $data['certificates'] = Certificate::where('user_id', Auth::guard('web')->user()->id)->get();
            
            $data['socials'] = Social::where('user_id', Auth::guard('web')->user()->id)->first();
            
            return view('frontend.pages.users.profile', $data);
        }elseif(Auth::guard('web')->user()->user_type == 'client'){  

           // get order count
            $count_order= Order::with('hire')->where('is_accept',1)
            ->whereHas('hire',function($q){
            $q->where('client_id',Auth::id());
            })
            ->get();

            $data['order_count']=$order= count($count_order);
            // if($order == NULL){
            //     $data['order_count']=0;
            // }else{
            //     $data['order_count']=count($order);  
            // }

            $hire=Hire::find(Auth::user()->id);
            if($hire == NULL){
                $data['hire_count']=0;
            }else{
                $data['hire_count']=count($hire);  
            }
                   
            return view('frontend.pages.clients.profile', $data);
        }        
    }

    public function profile_update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $freelancer = User::find(Auth::guard('web')->user()->id);
        $freelancer->name = $request->name;
        $freelancer->email = $request->email;
        
        if($request->has('image')){
            if($freelancer->image !== NULL){
                $this->image_delete($freelancer->image);
            }

            $image_name = $this->image_store('frontend/profile/', $request->file('image'));
            $freelancer->image = $image_name;            
        }    
        
        $freelancer->save();

        toastr()->warning('Profile update successful!', 'Profile', ['timeOut' => 5000]);
        return back();        
    }

    public function password_update(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $freelancer = User::find(Auth::guard('web')->user()->id);

        if(Hash::check($request->old_password, $freelancer->password)){
            $freelancer->password = bcrypt($request->password);
            $freelancer->save();

            toastr()->success('Password update successfully!', 'Profile', ['timeOut' => 5000]);
            return back();  
        }else{
            toastr()->warning('Old password not match!', 'Profile', ['timeOut' => 5000]);
            return back();  
        }

    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        toastr()->success('Logout successfull!', 'Authentication', ['timeOut' => 5000]);
        return redirect()->route('user.login');
    }

    public function dashboard()
    {
        
        if(Auth::guard('web')->user()->user_type == 'freelancer'){
            $data['freelancer_wallet'] = UserWallet::where('user_id', Auth::guard('web')->user()->id)->first();
            
            $data['active_orders'] = Order::with(['hire' => function($query){
                $query->where('user_id',Auth::guard('web')->user()->id)->where('deleted_at', NULL);
            }])
            ->where(['is_accept' => 1, 'delivery_status' => 'inprogess'])            
            ->get()->count();

            $data['completed_orders'] = Order::with(['hire' => function($query){
                $query->where('user_id', Auth::guard('web')->user()->id)->where('deleted_at', NULL);
            }])
            ->where(['is_accept' => 1, 'delivery_status' => 'completed', 'is_delivered' => 'accept_delivery'])            
            ->get()->count();

            return view('frontend.pages.users.dashboard', $data);

        }elseif(Auth::guard('web')->user()->user_type == 'client'){

            $data['client_wallet'] = ClientWallet::where('client_id', Auth::guard('web')->user()->id)->first();
            
            $data['active_orders'] = Order::with(['hire' => function($query){
                $query->where('user_id',Auth::guard('web')->user()->id)->where('deleted_at', NULL);
            }])
            ->where(['is_accept' => 1, 'delivery_status' => 'inprogess'])            
            ->get()->count();

            $data['completed_orders'] = Order::with(['hire' => function($query){
                $query->where('user_id', Auth::guard('web')->user()->id)->where('deleted_at', NULL);
            }])
            ->where(['is_accept' => 1, 'delivery_status' => 'completed', 'is_delivered' => 'accept_delivery'])            
            ->get()->count();

            return view('frontend.pages.clients.dashboard', $data);
        }
        
    }

    public function moto(Request $request)
    {
        $user = User::find($request->id);
        
        $user->moto = $request->moto;
        $user->save();
      
        $response = [
            'success' => true,
            'data' => $user,
            'code' => 200
        ];        

        return $response;
    }

    public function description(Request $request)
    {
        $user = User::find($request->id);
        
        $user->description = $request->description;
        $user->save();
      
        $response = [
            'success' => true,
            'data' => $user,
            'code' => 200
        ];        

        return $response;
    }

    public function skills(Request $request)
    {        
        $skills = Skill::find($request->id);

        if($skills != NULL){
            $skills->user_id = $request->id;
            $skills->skills = $request->skills;
            $skills->save();
        }else{
            $skills = new Skill;

            $skills->user_id = $request->id;
            $skills->skills = $request->skills;
            $skills->save();
        }
      
        $response = [
            'success' => true,
            'data' => $skills,
            'code' => 200
        ];        

        return $response;
    }
    
    //End

    public function store_certificate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'year' => 'required',
            'file' => 'required|file|dimensions:max_height=150,max_width=220',
        ]);

        $certificate = new Certificate;
        $certificate->user_id = Auth::guard('web')->user()->id;
        $certificate->name = $request->name;
        $certificate->year = $request->year;

        if($request->has('file')){
            $image_name = $this->image_store('frontend/certificates/', $request->file('file'));            
        }    

        $certificate->file = $image_name;
        $certificate->save();

        toastr()->success('Certificate added successfully!', 'Certificate', ['timeOut' => 5000]);
        return back();
    }

    public function update_certificate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'year' => 'required',
        ]);

        $certificate = Certificate::find($request->id);
        $certificate->user_id = Auth::guard('web')->user()->id;
        $certificate->name = $request->name;
        $certificate->year = $request->year;

        if($request->has('file')){
            $image_name = $this->image_store('frontend/certificates/', $request->file('file'));            

            if($certificate->file !== NULL){
                $this->image_delete($certificate->file);
            }
        }    

        $certificate->file = $request->has('file') ? $image_name : $certificate->file;
        $certificate->save();

        toastr()->success('Certificate update successfully!', 'Certificate', ['timeOut' => 5000]);
        return back();
    }

    public function get_certificate(Request $request)
    {
        $certificate = Certificate::find($request->id);

        return $certificate;
    }

    public function socials(Request $request)
    {
        $socials = Social::find($request->id);

        if($socials){
            $socials->twitter = $request->twitter;
            $socials->facebook = $request->facebook;
            $socials->instagram = $request->instagram;
            $socials->linkedin = $request->linkedin;
            $socials->save();
        }else{
            $socials = new Social;

            $socials->user_id = $request->id;
            $socials->twitter = $request->twitter;
            $socials->facebook = $request->facebook;
            $socials->instagram = $request->instagram;
            $socials->linkedin = $request->linkedin;
            $socials->save();
        }

        return $socials;
    }
}
