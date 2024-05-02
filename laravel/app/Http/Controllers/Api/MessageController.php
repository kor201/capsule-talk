<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Entities\Message;
use App\Http\Controllers\Controller;
use App\Services\Api\MessageService;

class MessageController extends Controller
{
    private $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    public function index($roomId)
    {
        $messages = Message::where('room_id', $roomId)->get();
        return response()->json($messages);
    }

    public function store(Request $request, $roomId)
    {
        $param = [
            'room_id' => $roomId,
            'user_id' => optional(Auth::guard('api')->user())->id,
            'message' => $request->message
        ];

        $result = $this->messageService->createPostMessage($param);
        if ($result) {
            return response()->json(['success' => 'Message created successfully.'], 201);
        } else {
            return response()->json(['warning' => 'Could not create or update message.'], 400);
        }
    }
}
