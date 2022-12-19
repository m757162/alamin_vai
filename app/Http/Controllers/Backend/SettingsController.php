<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessSetting;

class SettingsController extends Controller
{
    public function settings()
    {       
        return view('backend.pages.settings.index');
    }

    public function update_settings(Request $request)
    {
        BusinessSetting::updateOrCreate(
            ['key' => 'max_gig'], 
            ['value' => $request->max_gig]
        );

        toastr()->success('Settings update successfully!', 'Settings', ['timeOut' => 5000]);
        return back();
    }
    
    //End
}
