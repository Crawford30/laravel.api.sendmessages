<?php

namespace App\Http\Requests\MessageRequest;

use App\Models\Message;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SendMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'contact_id' => 'required|exists:contacts,id',
            'type' => ['required', Rule::in(config('messagetypes.types'))],
            'message_content' => 'required|string',
        ];
    }



    public function saveMessage($request){
        $data = [
         'user_id' => auth()->user()->id,
         'contact_id' => $request->contact_id,
         'type' => $request->type,
         'message_content' => $request->message_content,
        ];

         $messageData = Message::updateOrCreate(
            ['id' => $this->id],
             $data
        );

        //====Send Message Here After Saving It=====


     return apiResponse([$messageData], 201);

 }

}
