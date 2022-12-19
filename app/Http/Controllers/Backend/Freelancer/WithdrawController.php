<?php

namespace App\Http\Controllers\Backend\Freelancer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WithdrawRequest;
use App\Models\WithdrawPaymentMethod;
use App\Models\UserWallet;
use DB;

class WithdrawController extends Controller
{
    public function withdraw_requests(Request $request)
    {
        $withdraw_requests = WithdrawRequest::query();

        if($request->status == 'all'){
            $data['withdraw_requests'] = $withdraw_requests->with(['freelancer'])->orderBy('id', 'desc')->simplePaginate();
        }elseif($request->status == 'pending'){
            $data['withdraw_requests'] = $withdraw_requests->with(['freelancer'])->where('status', 'pending')->orderBy('id', 'desc')->simplePaginate();
        }elseif($request->status == 'inprogress'){
            $data['withdraw_requests'] = $withdraw_requests->with(['freelancer'])->where('status', 'inprogress')->orderBy('id', 'desc')->simplePaginate();
        }elseif($request->status == 'completed'){
            $data['withdraw_requests'] = $withdraw_requests->with(['freelancer'])->where('status', 'completed')->orderBy('id', 'desc')->simplePaginate();
        }elseif($request->status == 'reject'){
            $data['withdraw_requests'] = $withdraw_requests->with(['freelancer'])->where('status', 'reject')->orderBy('id', 'desc')->simplePaginate();
        }

        return view('backend.pages.withdraw.index', $data);
    }

    public function withdraw_status_update(Request $request, $id, $status)
    {
        $id = decrypt($id);

        $withdraw_request = WithdrawRequest::find($id);

        DB::beginTransaction();

        try{
            if($withdraw_request->status == 'reject'){
                toastr()->success('Already Reject!', 'Withdraw', ['timeOut' => 5000]);
                return back();
            }
    
            $withdraw_request->status = $status;
            $withdraw_request->save();
    
            if($status == 'reject'){
                
                $freelancer_id = $withdraw_request->freelancer_id;
    
                $freelancer_wallet = UserWallet::where('user_id', $freelancer_id)->first();
                $freelancer_wallet->balance = $freelancer_wallet->balance + $withdraw_request->amount;
                $freelancer_wallet->save();
            }

            DB::commit();
    
            if($withdraw_request){
                toastr()->success('Status update successfully!', 'Withdraw', ['timeOut' => 5000]);
                return back();
            }else{
                toastr()->success('Something went to wrong!', 'Withdraw', ['timeOut' => 5000]);
                return back();
            }
        }catch(\Exception $e){
            DB::rollback();

            dd(['error' => $e->getMessage(), 'line' => $e->getLine()]);
        }
    }

    public function withdraw_payment_method(Request $request)
    {
        $withdraw_request = WithdrawRequest::find($request->withdraw_request_id);
        $freelancer_id = $withdraw_request->freelancer_id;
        $payment_method = WithdrawPaymentMethod::where('freelancer_id', $freelancer_id)->first();
        
        if($withdraw_request->payment_method == 'Bkash'){
            $response = [
                'name' => 'Bkash',
                'bkash_account' => $payment_method->bkash_account,
                'bkash_account_type' => $payment_method->bkash_account_type,
                'bkash_status' => $payment_method->bkash_status,
            ];
        }elseif($withdraw_request->payment_method == 'Nagad'){
            $response = [
                'name' => 'Nagad',
                'nagad_account' => $payment_method->nagad_account,
                'nagad_account_type' => $payment_method->nagad_account_type,
                'nagad_status' => $payment_method->nagad_status,
            ];
        }elseif($withdraw_request->payment_method == 'Rocket'){
            $response = [
                'name' => 'Rocket',
                'rocket_account' => $payment_method->rocket_account,
                'rocket_account_type' => $payment_method->rocket_account_type,
                'rocket_status' => $payment_method->rocket_status,
            ];
        }elseif($withdraw_request->payment_method == 'Cellfin'){
            $response = [
                'name' => 'Cellfin',
                'cellfin_account' => $payment_method->cellfin_account,
                'cellfin_holder' => $payment_method->cellfin_holder,
                'cellfin_status' => $payment_method->cellfin_status,
            ];
        }elseif($withdraw_request->payment_method == 'DBBL'){
            $response = [
                'name' => 'DBBL',
                'dbbl_ac_account' => $payment_method->dbbl_ac_account,
                'dbbl_holder' => $payment_method->dbbl_holder,
                'dbbl_branch' => $payment_method->dbbl_branch,
                'dbbl_status' => $payment_method->dbbl_status,
            ];
        }elseif($withdraw_request->payment_method == 'IBBL'){
            $response = [
                'name' => 'IBBL',
                'ibbl_ac_account' => $payment_method->ibbl_ac_account,
                'ibbl_holder' => $payment_method->ibbl_holder,
                'ibbl_branch' => $payment_method->ibbl_branch,
                'ibbl_status' => $payment_method->ibbl_status,
            ];
        }elseif($withdraw_request->payment_method == 'Bank Asia'){
            $response = [
                'name' => 'Bank Asia',
                'bank_asia_ac_account' => $payment_method->bank_asia_ac_account,
                'bank_asia_holder' => $payment_method->bank_asia_holder,
                'bank_asia_branch' => $payment_method->bank_asia_branch,
                'bank_asia_status' => $payment_method->bank_asia_status,
            ];
        }elseif($withdraw_request->payment_method == 'Dhaka Bank'){
            $response = [
                'name' => 'Dhaka Bank',
                'dhaka_ac_account' => $payment_method->dhaka_ac_account,
                'dhaka_bank_holder' => $payment_method->dhaka_bank_holder,
                'dhaka_bank_branch' => $payment_method->dhaka_bank_branch,
                'dhaka_bank_status' => $payment_method->dhaka_bank_status,
            ];
        }
        
        return $response;
    }
    
    //End
}
