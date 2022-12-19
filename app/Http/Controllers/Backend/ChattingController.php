<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChattingController extends Controller
{
    public function chatting()
    {
        return view('backend.pages.chat.index');
    }
    
    //End
}
