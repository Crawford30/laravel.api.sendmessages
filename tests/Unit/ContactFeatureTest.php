<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactTest extends TestCase {
    use RefreshDatabase;

    public function testMessageCreation() {
        $user = User::factory()->create();

        $contact = Contact::create([
            'user_id' => $user->id,
            'name' => 'Joel',
            'email' => 'joelcrawford30@gmail.com',
            'phone' => '077899094',
        ]);

        $this->assertDatabaseHas('contacts', [
            'user_id' => $user->id,
            'name' => 'Joel',
            'email' => 'joelcrawford30@gmail.com',
            'phone' => '077899094',
        ]);
    }
}
