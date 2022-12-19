<?php

namespace App\Http\Controllers\Frontend\Client;

use App\Helpers\Helper;
use App\Models\User;
use App\Models\Order;
use App\Models\UserWallet;
use App\Models\AdminWallet;
use App\Models\AffiliateCommission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class OrderController extends Controller
{
    use Helper;
    
    public function accept_order(Request $request)
    {
        $order_id = $request->order_id;
        $status = $request->status;

        $order = Order::with(['hire', 'hire.gig'])->find($order_id);
        
        if($order->is_delivered == 'accept_delivery'){
            if($status == 'accept_delivery'){
                toastr()->warning('Already accept!', 'Order', ['timeOut' => 5000]);
                return back();
            }
        } 

        $order->is_delivered = $status;

        try{
            $order->save();           

            //Transaction to Freelancer from admin wallet escrow amount
            if($status == 'accept_delivery'){
                $order->delivery_status = 'completed';
                $order->save();

                $admin_wallet = AdminWallet::first();
                $freelancer_wallet = UserWallet::where('user_id', $order->hire->gig->user_id)->first();

                $freelancer_wallet->balance = $freelancer_wallet->balance + $order->freelancer_amount;
                $freelancer_wallet->save();

                $this->freelancer_transaction($order->hire->gig->user_id, 'debit', $order->freelancer_amount, $order->hire->gig->title);

                $admin_wallet->commission_amount = $admin_wallet->commission_amount + $order->commission_amount;
                $admin_wallet->total_income = $admin_wallet->total_income + $order->commission_amount;
                $admin_wallet->balance = $admin_wallet->balance - $order->total_amount;
                $admin_wallet->save();

                $affilicate_commission = AffiliateCommission::where('order_id', $order_id)->first();
                //Affilicate commission added to refer account
                if($affilicate_commission != null){
                    $freelancer_wallet->balance = $freelancer_wallet->balance + $affilicate_commission->amount;
                    $freelancer_wallet->save();

                    $affilicate_commission->status = 'done';
                    $affilicate_commission->save();

                    $freelancer = User::find($order->hire->gig->user_id);
                    $freelancer->total_refer_claim = $freelancer->total_refer_claim - 1;
                    $freelancer->save();
                }
                
            }

            
            DB::commit();

            //toastr()->warning('Order status '.$status.' successfully!', 'Order', ['timeOut' => 5000]);
            return [
                'success' => true,
                'data' => $status,
                'message' => 'Successfully update'
            ];

        }catch(\Exception $e){
            DB::rollback();
            \Log::info($e->getMessage());
            toastr()->warning($e->getMessage() .'. Line no '.$e->getLine().'!', 'Order', ['timeOut' => 5000]);
            return back(); 
        }       

       
        
    }
    
    //End
}
