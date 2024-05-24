<?php

namespace App\Http\Requests\ContactRequest;

use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
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
            'name' => 'required|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
        ];

    }



    public function saveContact($request){
        $data = [
         'user_id' => auth()->user()->id,
         'name' =>  $request->name,
         'email' =>  $request->email ??  null,
         'phone' => $request->phone ?? null,
        ];

         $contact = Contact::updateOrCreate(
            ['id' => $this->id],
             $data
        );

        return apiResponse($contact, 201);

 }

}
