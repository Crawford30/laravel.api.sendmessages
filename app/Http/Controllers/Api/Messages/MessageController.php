<?php

namespace App\Http\Controllers\Api\Messages;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest\SendMessageRequest;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{


    public function getAllMessages() {
        $allMessages = Message::with('contact', 'user')->get();
        return apiResponse([$allMessages], 201);
    }

    public function sendMessage(SendMessageRequest $request)
    {
         return $request->saveMessage($request);
    }
}
