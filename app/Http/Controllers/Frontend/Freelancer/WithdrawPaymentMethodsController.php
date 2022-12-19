<?php

namespace App\Http\Controllers\Frontend\Freelancer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WithdrawPaymentMethod;
use Auth;

class WithdrawPaymentMethodsController extends Controller
{
    public function payment_methods()
    {
        $data['withdraw_pay_method'] = WithdrawPaymentMethod::where('freelancer_id', Auth::guard('web')->user()->id)->first();
        return view('frontend.pages.freelancer.payment-methods', $data);
    }

    public function update(Request $request)
    {
        if($request->has('bkash_account')){
            $bkash = WithdrawPaymentMethod::updateOrCreate([
                'freelancer_id' => Auth::guard('web')->user()->id
            ],[
                'bkash_account' => $request->bkash_account,
                'bkash_account_type' => $request->bkash_account_type,
                'bkash_status' => $request->bkash_status,
            ]);

            toastr()->success('Update Successfully!', 'Payment Method', ['timeOut' => 5000]);
            return back();
        }

        if($request->has('nagad_account')){
            $bkash = WithdrawPaymentMethod::updateOrCreate([
                'freelancer_id' => Auth::guard('web')->user()->id
            ],[
                'nagad_account' => $request->nagad_account,
                'nagad_account_type' => $request->nagad_account_type,
                'nagad_status' => $request->nagad_status,
            ]);

            toastr()->success('Update Successfully!', 'Payment Method', ['timeOut' => 5000]);
            return back();
        }

        if($request->has('rocket_account')){
            $bkash = WithdrawPaymentMethod::updateOrCreate([
                'freelancer_id' => Auth::guard('web')->user()->id
            ],[
                'rocket_account' => $request->rocket_account,
                'rocket_account_type' => $request->rocket_account_type,
                'rocket_status' => $request->rocket_status,
            ]);

            toastr()->success('Update Successfully!', 'Payment Method', ['timeOut' => 5000]);
            return back();
        }

        if($request->has('cellfin_account')){
            $bkash = WithdrawPaymentMethod::updateOrCreate([
                'freelancer_id' => Auth::guard('web')->user()->id
            ],[
                'cellfin_account' => $request->cellfin_account,
                'cellfin_holder' => $request->cellfin_holder,
                'cellfin_status' => $request->cellfin_status,
            ]);

            toastr()->success('Update Successfully!', 'Payment Method', ['timeOut' => 5000]);
            return back();
        }

        if($request->has('dbbl_ac_account')){
            $bkash = WithdrawPaymentMethod::updateOrCreate([
                'freelancer_id' => Auth::guard('web')->user()->id
            ],[
                'dbbl_ac_account' => $request->dbbl_ac_account,
                'dbbl_holder' => $request->dbbl_holder,
                'dbbl_branch' => $request->dbbl_branch,
                'dbbl_status' => $request->dbbl_status,
            ]);

            toastr()->success('Update Successfully!', 'Payment Method', ['timeOut' => 5000]);
            return back();
        }

        if($request->has('ibbl_ac_account')){
            $bkash = WithdrawPaymentMethod::updateOrCreate([
                'freelancer_id' => Auth::guard('web')->user()->id
            ],[
                'ibbl_ac_account' => $request->ibbl_ac_account,
                'ibbl_holder' => $request->ibbl_holder,
                'ibbl_branch' => $request->ibbl_branch,
                'ibbl_status' => $request->ibbl_status,
            ]);

            toastr()->success('Update Successfully!', 'Payment Method', ['timeOut' => 5000]);
            return back();
        }

        if($request->has('bank_asia_ac_account')){
            $bkash = WithdrawPaymentMethod::updateOrCreate([
                'freelancer_id' => Auth::guard('web')->user()->id
            ],[
                'bank_asia_ac_account' => $request->bank_asia_ac_account,
                'bank_asia_holder' => $request->bank_asia_holder,
                'bank_asia_branch' => $request->bank_asia_branch,
                'bank_asia_status' => $request->bank_asia_status,
            ]);

            toastr()->success('Update Successfully!', 'Payment Method', ['timeOut' => 5000]);
            return back();
        }

        if($request->has('dhaka_ac_account')){
            $bkash = WithdrawPaymentMethod::updateOrCreate([
                'freelancer_id' => Auth::guard('web')->user()->id
            ],[
                'dhaka_ac_account' => $request->dhaka_ac_account,
                'dhaka_bank_holder' => $request->dhaka_bank_holder,
                'dhaka_bank_branch' => $request->dhaka_bank_branch,
                'dhaka_bank_status' => $request->dhaka_bank_status,
            ]);

            toastr()->success('Update Successfully!', 'Payment Method', ['timeOut' => 5000]);
            return back();
        }


    }
    
    //End
}
