<?php

namespace App\Http\Controllers\Frontend\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rate;

class RateController extends Controller
{
    public function rate(Request $request)
    {
        $request->validate([
            'rate' => 'required',
            'feedback' => 'required'           
        ]);

        if($request->type == 'client'){
            $rate = new Rate;
            $rate->freelancer_id = $request->freelancer_id;
            $rate->client_id = $request->client_id;
            $rate->order_id = $request->order_id;
            $rate->freelancer_rate = $request->rate;
            $rate->freelancer_feedback = $request->feedback;
            $rate->save();
            return $rate;
        }elseif($request->type == 'freelancer'){
            $rate = Rate::find($request->rate_id);
            $rate->client_rate = $request->rate;
            $rate->client_feedback = $request->feedback;
            $rate->save();
            return $rate;
        }

        
    }
    
    //End
}
