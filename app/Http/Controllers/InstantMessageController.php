<?php

namespace App\Http\Controllers;

use App\Models\InstantMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InstantMessageController extends Controller
{

    public function users()
    {
        $users = User::where('user_id', '!=', Auth::user()->user_id)
            // ->whereNotBetween('user_last_action', [now()->subSecond(1), now()])
            //  ->orWhere('user_last_action', null)
            ->get();
            foreach ($users as $user) {
                $user->setAttribute('is_online', $user->isOnline());
                $count = InstantMessage::where('instant_message_recipient_user_id',Auth::user()->user_id)
                        ->where('user_id',$user->user_id)
                        ->where('instant_message_read',0)
                        ->count();
                $user->setAttribute('count', $count);

            }
        // dd(Session::get());
        return response()->json($users);
    }

    public function online_users()
    {
        $users = User::where('user_id', '!=', Auth::user()->user_id)
            ->whereBetween('user_last_action', [now()->subSecond(1), now()])
            ->get();
        return response()->json($users);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return $this->refresh($id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $message = new InstantMessage();
        $message->user_id = Auth::user()->user_id;
        $message->instant_message_recipient_user_id = $id;
        $message->instant_message_message = $request->instant_message_message;
        $message->instant_message_time = date("H:i:s");
        $message->instant_message_sent = date("Y-m-d");
        $message->instant_message_read = 0;
        $message->save();
        return $this->refresh($id);
    }

    public function read($id)
    {
        $messages = InstantMessage::where('instant_message_recipient_user_id',Auth::user()->user_id)->where('user_id',$id)->get();
        foreach ($messages as $message) {
            $msg = InstantMessage::where('instant_message_id', $message->instant_message_id)->first();
            $msg->instant_message_read = 1;
            $msg->save();
        }
        return response()->json($messages);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function refresh($id)
    {
        $user_id = Auth::user()->user_id;
        // dd(Auth::user()->user_id);
        $messages = DB::table('instant_messages')
            ->where('user_id', $user_id)->where('instant_message_recipient_user_id', $id)
            ->orWhere(function ($query) use ($id) {
                $query->where('instant_message_recipient_user_id', Auth::user()->user_id)->where('user_id', $id);
            })
            ->get();
        return response()->json($messages);
    }
}
