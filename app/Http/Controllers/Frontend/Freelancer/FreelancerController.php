<?php

namespace App\Http\Controllers\Frontend\Freelancer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserTransaction;
use App\Models\Gig;
use Auth;

class FreelancerController extends Controller
{
    public function transaction()
    {
        $data['transactions'] = UserTransaction::where('freelancer_id', Auth::guard('web')->user()->id)->paginate(10);
        return view('frontend.pages.freelancer.transaction', $data);
    }

    public function gigs()
    {
        // $data['gigs']
        $data['gigs']= Gig::with('count_gig')->where('user_id', Auth::guard('web')->user()->id)->orderBy('id', 'desc')->paginate(6);
      
      return view('frontend.pages.freelancer.gigs', $data);
    }

    public function refer_program()
    {
        return view('frontend.pages.freelancer.refer-program');
    }
    
    //End
}
