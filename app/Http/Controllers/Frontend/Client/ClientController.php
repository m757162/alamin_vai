<?php

namespace App\Http\Controllers\Frontend\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClientTransaction;
use Auth;
use App\Models\Favourite;

class ClientController extends Controller
{
    public function transaction()
    {
        $data['transactions'] = ClientTransaction::where('client_id', Auth::guard('web')->user()->id)
        ->simplePaginate(10);
        return view('frontend.pages.clients.transaction', $data);
    }
    public function favourite()
    {
        $data['favourite']=Favourite::with('gig')->where('user_id',Auth::id())->get();
         return view('frontend.pages.clients.favourite', $data);
    }
    //End
}
