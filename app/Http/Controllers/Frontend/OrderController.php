<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Hire;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function orders()
    {       

        if(Auth::guard('web')->user()->user_type == 'freelancer'){
           $data['hires'] = Hire::with(['order', 'client', 'gig'])
            ->where('user_id', Auth::guard('web')->user()->id)
            ->simplePaginate(10);

            return view('frontend.pages.orders.orders', $data);
        }elseif(Auth::guard('web')->user()->user_type == 'client'){

              $data['hires'] = Hire::with(['freelancer','gig', 'order'])
            ->where('client_id', Auth::guard('web')->user()->id)
            ->orderBy('id', 'desc')->simplePaginate(6);

            return view('frontend.pages.clients.orders.orders', $data);
        }
        
        
    }

    public function order_view($id)
    {
        $id = decrypt($id);

        if(Auth::guard('web')->user()->user_type == 'freelancer'){
            $data['hire'] = Hire::with(['order', 'client', 'gig', 'order.rate'])->find($id);
            return view('frontend.pages.orders.order-view', $data);
        }elseif(Auth::guard('web')->user()->user_type == 'client'){
            $data['hire'] = Hire::with(['order', 'freelancer', 'gig', 'order.rate'])->find($id);
            return view('frontend.pages.clients.orders.order-view', $data);
        }
        
    }

    public function update_order_status(Request $request)
    {
       if($request->type == 'order_status'){
            $order = Order::find($request->order_id);
            $order->is_accept = $request->status == 'accept' ? 1 : 0;
            $order->delivery_status = $request->status == 'accept' ? 'inprogress' : 'pending';
            $order->save();

            toastr()->warning('Order status '.$request->status.' successfully!', 'Order', ['timeOut' => 5000]);
            
       }elseif($request->type == 'delivery_status'){
            
            $order = Order::find($request->order_id);

            if($request->status == 'completed'){
                //Order Delivery by Freelancer
                $order->is_delivered = 'delivered';
                $order->save();
            }else{
               
                $order->delivery_status = $request->status;
                $order->save();
            }

            toastr()->warning('Delivery status '.$request->status.' successfully!', 'Order', ['timeOut' => 5000]);
       }
        return redirect()->back();
    }
    
    //End
}
