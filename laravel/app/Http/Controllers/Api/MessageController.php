<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Entities\Message;
use App\Http\Controllers\Controller;
use App\Services\Api\MessageService;

class MessageController extends Controller
{
    public function index($roomId)
    {
        $messages = Message::where('room_id', $roomId)->get();
        return response()->json($messages);
    }

    public function store(Request $request, $roomId)
    {
        $message = Message::create([
            'room_id' => $roomId,
            'user_id' => Auth::guard('api')->user() ? Auth::guard('api')->user()->id : null,
            'message' => $request->message
        ]);
        return response()->json($message, 201);
    }
}
