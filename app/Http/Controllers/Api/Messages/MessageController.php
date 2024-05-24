<?php

namespace App\Http\Controllers\Api\Messages;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest\SendMessageRequest;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function sendMessage(SendMessageRequest $request)
    {
         return $request->saveMessage($request);
    }
}
