<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Events\MessagingEvent;
use App\Models\Message;
class ChattingController extends Controller
{
    //

    public function index()
    {

        $messages = Message::all();
        return view("chatting.index", [
            'messages' => $messages
        ]);
    }


    public function send(Request $request)
    {

        $save = new Message();
        $message = $request->input('message');
        $user = Auth::user();

        $save->name = $user->name;
        $save->message = $message;
        $save->save();
        event(new MessagingEvent($message, $user));

    }
}
