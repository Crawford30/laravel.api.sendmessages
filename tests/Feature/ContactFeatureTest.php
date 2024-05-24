<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactFeatureTest extends TestCase {
    use RefreshDatabase;

    public function testContactIndex() {
        $response = $this->get('/api/contact/all-contacts');
        $response->assertStatus(201);
    }

    public function testContactStore() {
        $user = User::factory()->create();

        $response = $this->postJson('/api/contact/save-contact', [
            'user_id' => $user->id,
            'name' => 'Joel',
            'email' => 'joelcrawford30@gmail.com',
            'phone' => '077899094',
        ]);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                    'id', 'user_id', 'name', 'email', 'phone', 'created_at', 'updated_at'
                    ]
                );
    }

    public function testInvalidEmail() {
        $user = User::factory()->create();

        $response = $this->postJson('/api/contact/save-contact', [
            'user_id' => $user->id,
            'name' => 'Joel',
            'email' => 'invalid_emails',
            'phone' => '077899094',
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['email']);
    }
}
