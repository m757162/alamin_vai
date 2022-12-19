<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Carbon\Carbon;

class SendMessageController extends Controller
{

    public function messages()
    {
        $messages = Message::with(['client' => function($client){
            $client->select('name', 'image')->first();
        },
        'employee' => function($employee){
            $employee->select('name', 'avatar')->first();
        }])->orderBy('id', 'asc')->get();
        return $messages;
    }

    public function send_message(Request $request)
    {
        $message = new Message;

        if($request->type == 'client'){
            $message->type = 'client';
            $message->client_id = $request->sender_id;
        }elseif($request->type == 'employee'){
            $message->type = 'employee';
            $message->employee_id = $request->sender_id;
        }        
        $message->created_at = Carbon::now();
        $message->message = $request->message;
        $message->save();

        event(new \App\Events\ChatEvent($request->message, $request->sender_id, $request->type));
        return 'Message sent successfully';
    }
    //End
}
