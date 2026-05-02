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
        $search = $request->query('search');
        $myId = Auth::id();

        $query = User::where('user_id', '!=', $myId);

        if ($search) {
            $keyword = strtolower(trim($search));
            $superCleanKeyword = preg_replace('/[^a-z0-9]/', '', $keyword);

            $query->where(function($q) use ($keyword, $superCleanKeyword) {
                if (str_contains('admin', $keyword) || str_contains('administrator', $keyword)) {
                    $q->orWhere('role', 'admin');
                }
                if (str_contains('siswa', $keyword) || str_contains('student', $keyword) || str_contains('siwa', $keyword)) {
                    $q->orWhere('role', '!=', 'admin');
                }

                $q->orWhere('username', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%");

                $q->orWhereRaw("SOUNDEX(username) = SOUNDEX(?)", [$keyword]);

                $q->orWhere(\Illuminate\Support\Facades\DB::raw("LOWER(REGEXP_REPLACE(username, '[^a-zA-Z0-9]', ''))"), 'LIKE', "%$superCleanKeyword%");
            });

            $query->orderByRaw("
                CASE 
                    WHEN username = ? THEN 1
                    WHEN username LIKE ? THEN 2
                    ELSE 3 
                END ASC", [$keyword, "%$keyword%"]);
        } else {
            $query->orderByRaw("CASE WHEN role = 'admin' THEN 1 ELSE 2 END ASC")
                ->orderBy('username', 'asc');
        }

        $users = $query->get();

        return view('Siswa.Chatting', compact('users'));
    }

    public function getMessages($receiverId)
{
    $myId = Auth::id();
    

    $messages = Message::where(function($q) use ($myId, $receiverId) {
        $q->where('sender_id', $myId)->where('receiver_id', $receiverId);
    })->orWhere(function($q) use ($myId, $receiverId) {
        $q->where('sender_id', $receiverId)->where('receiver_id', $myId);
    })
    ->orderBy('created_at', 'asc')
    ->get()
    ->map(function($msg) {
        $sender = User::find($msg->sender_id);
        return [
            'sender_id' => $msg->sender_id,
            'receiver_id' => $msg->receiver_id,
            'message' => $msg->message,
            'type' => $msg->type,
            'file_path' => $msg->file_path,
            'created_at' => $msg->created_at,
            'sender_username' => $sender ? $sender->username : 'User',
            'sender_foto_profile' => $sender ? $sender->foto_profile : null,
        ];
    });

    return response()->json($messages);
}

    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required',
            'message' => 'required_without:file',
            'file' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $path = null;
        $type = 'text';

        if ($request->message && filter_var($request->message, FILTER_VALIDATE_URL)) {
            $type = 'link';
        }

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('chats', 'public');
            $type = 'image';
        } 

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message, 
            'file_path' => $path,
            'type' => $type
        ]);

        return response()->json($message);
    }
}