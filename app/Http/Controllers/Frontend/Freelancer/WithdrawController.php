<?php

namespace App\Http\Controllers\Frontend\Freelancer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\UserWallet;
use App\Models\WithdrawRequest;
use App\Models\AdminWallet;
use Auth;
use DB;

class WithdrawController extends Controller
{
    use Helper;

    public function withdraw()
    {
        $data['withdraw_requests'] = WithdrawRequest::orderBY('id', 'desc')->simplePaginate();
        return view('frontend.pages.freelancer.withdraw_request', $data);
    }

    public function withdraw_form()
    {
        $data['balance'] = UserWallet::find(Auth::guard('web')->user()->id)->balance;
        return view('frontend.pages.freelancer.withdraw', $data);
    }

    public function withdraw_action(Request $request)
    {
        $request->validate([
            'balance' => 'required|gte:100',
            'payment_method' => 'required',
            'amount' => 'required|gte:100|lte:10000'
        ]);

        $freelancer_id = Auth::guard('web')->user()->id;

        $user_wallet = UserWallet::find($freelancer_id);

        if($request->amount > $user_wallet->balance){
            toastr()->error('Insuffient Balance!', 'Withdraw', ['timeOut' => 5000]);
            return back();
        }

        DB::beginTransaction();
        try {
            $withdraw_request = WithdrawRequest::create([
                'freelancer_id' => $freelancer_id,
                'amount' => $request->amount,
                'payment_method' => $request->payment_method
            ]); 

            if($withdraw_request){
                $user_wallet->balance = $user_wallet->balance - $request->amount;
                $user_wallet->save();

                $this->freelancer_transaction($freelancer_id, 'credit', $request->amount, 'Withdraw');

            }

            DB::commit();

            toastr()->success('Request sent successfully!', 'Withdraw', ['timeOut' => 5000]);
            return redirect()->route('freelancer.withdraw');

        } catch (\Exception $e) {
            DB::rollback();
            dd(['error' => $e->getMessage(), 'line' => $e->getLine()], 500);
        }

       
    }

    
    
    //End
}
