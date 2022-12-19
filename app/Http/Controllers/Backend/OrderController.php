<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function orders(Request $request)
    {
        $orders = Order::query()->with(['hire', 'hire.freelancer', 'hire.client']);

        if($request->status == 'all'){
            $data['orders'] = $orders->paginate(20);
        }elseif($request->status == 'pending'){
            $data['orders'] = $orders->where(['delivery_status' => 'pending'])->paginate(20);
        }elseif($request->status == 'inprogress'){
            $data['orders'] = $orders->where(['is_accept' => 1, 'delivery_status' => 'inprogress'])->paginate(20);
        }elseif($request->status == 'completed'){
            $data['orders'] = $orders->where(['is_accept' => 1, 'delivery_status' => 'completed', 'is_delivered' => 'accept_delivery'])->paginate(20);
        }elseif($request->status == 'cancel'){
            $data['orders'] = $orders->where(['delivery_status' => 'cancel'])->paginate(20);
        }

        return view('backend.pages.orders.index', $data);
    }

    public function show_order($id)
    {
        $data['order'] = Order::with(['hire', 'hire.freelancer', 'hire.client'])->find(decrypt($id));
        return view('backend.pages.orders.show', $data);
    }
    
    //End
}
