<?php

namespace App\Http\Requests\ContactRequest;

use App\Models\Contact;
use Illuminate\Foundation\Http\FormRequest;

class CreateContactRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
        ];

    }

    public function saveContact($request){
        $contact = Contact::create($request->all());
        return apiResponse($contact, 201);
    }


}
