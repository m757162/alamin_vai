<?php 
namespace App\Helpers;

use App\Models\ClientWallet;
use App\Models\AdminWallet;
use App\Models\UserTransaction;
use App\Models\ClientTransaction;
use App\Models\AdminTransaction;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait Helper{

    public function image_store($path, $image)
    {        
        $fileName   = uniqid(). time() . $image->getClientOriginalName();
        return Storage::disk('public')->put($path . $fileName, File::get($image));
        $filePath  = $path . $fileName;

        return $filePath;
    }

    public function image_delete($path)
    { 
        if(Storage::disk('public')->exists($path)){
            Storage::disk('public')->delete($path);
        }else{
            return false;
        }

        return true;
    }

    public function wallet_transaction($type, $client_id = null, $total_amount, $description = null)
    {       

        if($type == 'client_wallet'){
            $client_wallet = ClientWallet::where('client_id', $client_id)->first();

            $admin_wallet = AdminWallet::first();
            $admin_wallet->balance += $total_amount;
            $admin_wallet->save();                        

            $client_wallet->balance -= $total_amount;
            $client_wallet->save();

            if($client_wallet){
                self::client_transaction($client_id, 'credit', $total_amount, $description);
            }

            if($admin_wallet){
                self::admin_transaction($client_id, $freelancer_id = NULL, $client_id, 'debit', $total_amount, $description);
            }

        }elseif($type = 'client_sslcommercz'){

            $admin_wallet = AdminWallet::first();
            $admin_wallet->balance += $total_amount;
            $admin_wallet->save();
            
            self::client_transaction($client_id, 'credit', $total_amount, $description);

            if($admin_wallet){
                self::admin_transaction($client_id, $freelancer_id = NULL, $client_id, 'debit', $total_amount, $description);
            }
        }
        
    }

    public function freelancer_transaction($freelancer_id, $type, $amount, $description = null)
    {
        UserTransaction::create([
            'freelancer_id' => $freelancer_id,
            'type' => $type,
            'amount' => $amount,
            'description' => $description,
        ]);
        
        return true;
    }

    public function client_transaction($client_id, $type, $amount, $description = null)
    {
        ClientTransaction::create([
            'client_id' => $client_id,
            'type' => $type,
            'amount' => $amount,
            'description' => $description,
        ]);
        
        return true;
    }

    public function admin_transaction($admin_id, $freelancer_id = NULL, $client_id = NULL, $type, $amount, $description = null)
    {
        AdminTransaction::create([
            'admin_id' => $admin_id,
            'freelancer_id' => $freelancer_id != NULL ? $freelancer_id : NULL,
            'client_id' => $client_id != NULL ? $client_id : NULL,
            'type' => $type,
            'amount' => $amount,
            'description' => $description,
        ]);
        
        return true;
    }


}