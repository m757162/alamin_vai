<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminWallet;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data['admin_wallet'] = AdminWallet::where('id', 1)->first();
        return view('backend.pages.dashboard', $data);
    }
    //End
}
