<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminTransaction;

class TransactionController extends Controller
{
    
    public function transactions()
    {
        $data['transactions'] = AdminTransaction::with(['freelancer', 'client'])
        ->where('admin_id', 1)
        ->orderBy('id','desc')
        ->whereNull('deleted_at')
        ->simplePaginate(20);

        return view('backend.pages.transactions.index', $data);
    }
    
    //End
}
