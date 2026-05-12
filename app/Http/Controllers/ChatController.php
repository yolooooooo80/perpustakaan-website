<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        if ($user->role === 'pengunjung') {
            // Visitors chat with library staff
            $staff = User::whereIn('role', ['pegawai', 'admin'])->get();
            $messages = Message::where(function($q) use ($user) {
                    $q->where('sender_id', $user->id)->orWhere('receiver_id', $user->id);
                })
                ->with(['sender', 'receiver'])
                ->oldest()
                ->get();
            
            return view('chat.index', compact('staff', 'messages'));
        } else {
            // Staff see all active conversations
            $conversations = Message::select('sender_id', 'receiver_id')
                ->where('sender_id', $user->id)
                ->orWhere('receiver_id', $user->id)
                ->get()
                ->map(function($m) use ($user) {
                    return $m->sender_id == $user->id ? $m->receiver_id : $m->sender_id;
                })
                ->unique();

            $users = User::whereIn('id', $conversations)->get();
            
            $activeUser = null;
            $messages = [];
            
            if ($request->user_id) {
                $activeUser = User::find($request->user_id);
                $messages = Message::where(function($q) use ($user, $request) {
                        $q->where('sender_id', $user->id)->where('receiver_id', $request->user_id);
                    })
                    ->orWhere(function($q) use ($user, $request) {
                        $q->where('sender_id', $request->user_id)->where('receiver_id', $user->id);
                    })
                    ->with(['sender', 'receiver'])
                    ->oldest()
                    ->get();
            }

            return view('chat.staff', compact('users', 'activeUser', 'messages'));
        }
    }

    public function send(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Pesan terkirim.');
    }
}
