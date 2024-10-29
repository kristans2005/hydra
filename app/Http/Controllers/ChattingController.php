<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Events\MessagingEvent;
class ChattingController extends Controller
{
    //

    public function index()
    {
        return view("chatting.index");
    }


    public function send(Request $request)
    {
        $message = $request->input("message");
        $user = Auth::user();
        event(new MessagingEvent($message, $user));

    }
}
