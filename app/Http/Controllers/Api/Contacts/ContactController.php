<?php

namespace App\Http\Controllers\Api\Contacts;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest\CreateContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function getAllContacts() {
        $allContacts = Contact::with('messages', 'user')->get();
        return apiResponse([$allContacts], 201);
    }

    public function saveContactDetails(CreateContactRequest $request)
    {
         return $request->saveContact($request);
    }
}
