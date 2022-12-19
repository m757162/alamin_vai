<?php

namespace App\Http\Controllers\Frontend\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class ChatController extends Controller
{
    public function chat(Request $request)
    {
        return view('frontend.pages.clients.chat');
    }

    //End
}
