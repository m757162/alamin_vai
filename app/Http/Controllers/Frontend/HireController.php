<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\Helper;
use Carbon\Carbon;
use App\Models\Gig;
use App\Models\Hire;
use App\Models\Order;
use App\Models\User;
use App\Models\UserWallet;
use App\Models\AdminWallet;
use App\Models\ClientWallet;
use App\Models\AffiliateCommission;
use Illuminate\Http\Request;
use App\Models\BusinessSetting;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SslCommerzPaymentController;
use Session;

class HireController extends Controller
{
    use Helper;
    
    public function hire_view(Request $request, $freelancer_id, $gig_id)
    {
        $freelancer_id = decrypt($freelancer_id);
        $gig_id = decrypt($gig_id);

        $data['gig'] = Gig::with(['freelancer'])->find($gig_id);

        return view('frontend.pages.hires.hire', $data);     
        
    }

    public function hire(Request $request)
    {
        $freelancer_id = decrypt($request->freelancer_id);
        $gig_id = decrypt($request->gig_id);

        $hire = [];

        $hire['user_id'] = $freelancer_id;
        $hire['client_id'] = Auth::guard('web')->user()->id;
        $hire['gig_id'] = $gig_id;
        $hire['hire_type'] = 'project_based';    
        $hire['created_at'] = Carbon::now();   

        DB::beginTransaction();
        
        try{      

            $hire_id = DB::table('hires')->insertGetId($hire);

            if($hire_id >= 1){
                $hire = Hire::find($hire_id);

                $gig = Gig::find($gig_id);

                //Calculation
                $grand_total = $request->budget > 0 ? $request->budget : $gig->price;

                /* ================
                    If have refer discount claim
                */
                if(Auth::guard('web')->user()->total_refer_claim > 0){
                    
                    $refer_get_off_percent = BusinessSetting::where('key', 'refer_get_off_percent')->first()->value;
                    
                    $discount_amount = ($refer_get_off_percent/100 ) * $grand_total;
                    $grand_total = $grand_total - $discount_amount;
                  
                    $affiliate_commission = new AffiliateCommission;
                    $affiliate_commission->refer_user_id = Auth::guard('web')->user()->referral_id;
                    $affiliate_commission->amount = $discount_amount;
                    $affiliate_commission->save();

                }
                

                /* ================
                    End If have refer discount claim
                */

                $admin_commission_percentage = BusinessSetting::where('key', '3')->first()->value;
                
                $total_amount = $grand_total;
                $admin_commission_amount = $total_amount * ($admin_commission_percentage /100);
                $freelancer_amount = $total_amount - $admin_commission_amount;

                //Order Insert
                $parse_date = Carbon::parse($hire->created_at);
                $estimate_date = $request->estimate_day != NULL ? $request->estimate_day : $parse_date->addDays($gig->estimate_day);

                $order = new Order;
                $order->hire_id = $hire_id;
                $order->commission_amount = $admin_commission_amount;
                $order->freelancer_amount = $freelancer_amount;
                $order->total_amount = $total_amount;
                $order->is_accept = false;
                $order->estimate_date = $estimate_date;
                $order->save();

                Session::put('order_id', $order->id);

                //Get off and decrease refer claim and affiliate order_id update
                if(Auth::guard('web')->user()->total_refer_claim > 0){

                    $client = User::find(Auth::guard('web')->user()->id);
                    $client->total_refer_claim = $client->total_refer_claim - 1;
                    $client->save();

                    $affiliate_commission->order_id = $order->id;
                    $affiliate_commission->save();

                }

                DB::commit();
                //Order End                

                if($request->payment_method == 'wallet'){

                    $payment_info = [
                        'amount' => $total_amount,
                        'currency' => 'BDT'
                    ];

                    $order->payment_method = 'wallet';
                    $order->payment_status = 'paid';
                    $order->payment_info = json_encode($payment_info);
                    $order->save();

                    $client_wallet = ClientWallet::where('client_id', Auth::guard('web')->user()->id)->first();
                    
                    if($grand_total >= $client_wallet->balance){
                        toastr()->warning('Insufficient balance!', 'Wallet', ['timeOut' => 5000]);
                        return back();
                    }else{

                        $wallet_trans = $this->wallet_transaction('client_wallet', Auth::guard('web')->user()->id, $total_amount, 'Hire freelancer');                        
                        DB::commit();
                    }                    

                    return view('frontend.pages.payment-success');

                }elseif($request->payment_method == 'sslcommercz'){                    

                    $request['budget'] = $total_amount;
                    $request['estimate_date'] = $estimate_date;
                    $request['client_id'] = encrypt(Auth::guard('web')->user()->id);
                    $request['order_id'] = $order->id;

                    $sslcommercz = new SslCommerzPaymentController;
                    $sslcommercz->index($request);
                    DB::commit();
                }               

                DB::commit();
                
            }
        }
        catch(\Exception $e){
            DB::rollback();

            dd($e->getMessage(), $e->getLine());
            }       

    }

    
    //End
}
