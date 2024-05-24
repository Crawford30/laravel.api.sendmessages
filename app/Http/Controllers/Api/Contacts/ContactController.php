<?php

namespace App\Http\Controllers\Api\Contacts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest\CreateContactRequest;

class ContactController extends Controller
{

    public function saveContactDetails(CreateContactRequest $request)
    {
         return $request->saveContact($request);
    }
}
