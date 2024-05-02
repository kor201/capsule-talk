<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    // chatルーム一覧
    public function index()
    {
        //
    }

    // chat入室
    public function chat(Request $request)
    {
        return response()->json(['message' => 'Access successful.', 'request' => $request], 200);
    }

    // chat発言
    public function talk(Request $request)
    {
        //
    }

}
